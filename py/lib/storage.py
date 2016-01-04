#!/usr/bin/python
###################################################################################################                                                                                              
#                                                                                               
# DEVELOPERS : Luca Sanna                                                                        
# VERSIONE : 2                                                                                  
#                                                                                                                    
# E-MAIL: sanluca78@gmail.com                                                                                        
# COPYRIGHT: (c) 2015                                                                      
# PROGRAMMA: Py-Acqua-hw  
#This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.                                                                          
###################################################################################################
import time,sys,math,smtplib
from ablib import DS18B20
from threading import Thread
from database import *
from tools import *
class MyStorage(Thread):
    db=Mydata()
    lista=[]
    lista1=[]
    midnight=0
    
    def dallas(self):
        while True:
            try:
                #1-wire pin 35
                sensor = DS18B20("000006286dbc")
                self.actual1 = sensor.getTemp()
                self.actual = "%.02f" %self.actual1
                if self.actual == None:
                    pass
                else:
                    self.db.update_real_time('real_time','temp_h2o',float(self.actual))
                    break
            except Exception,e:
                logCritical("except dallas %s" %e)
                pass
                    
    def phmeter(self):
        #lettura conversione ph
        #10 bit 1024
        x = self.db.view_calph()
        offset=float(x[1])
        VREF=5.089
        VREF_MAX=1.63
        Fattore_conversione=3.13
        volt_per_point=3.3/2**10
        while True:
            try:
                path="/sys/bus/iio/devices/iio:device0/in_voltage0_raw"
                fd = open(path,"r")
                self.ph1 = fd.read()
                fd.close()
                VREF_ADC=volt_per_point*int(self.ph1)
                #logCritical("VREF_ADC %s" %VREF_ADC)
                VREF_PHMETER=VREF_ADC*3.13
                #logCritical("vref_phmeter %s" %VREF_PHMETER)
                self.ph2=offset+(3.5*VREF_PHMETER)
                #logCritical("ph %s" %self.ph)
                #fd.close()
                self.ph = "%.02f" %self.ph2
                #logCritical("ph %s" %self.ph)
                if self.ph == None:
                    pass
                else:
                    self.db.update_real_time('real_time','ph',float(self.ph))
                    break
            except Exception,e:
                logCritical("except phmeter %s" %e)
                pass
    
    def insert_storage(self,temp_h2o, ph, pulse,hour,day,month,year,lu):
        self.db.save_storage(temp_h2o, ph, pulse,hour,day,month,year,lu)
        
    def Media(self,numeri):
        if not numeri:
            return None
        somma = 0
        for num in numeri:
            somma += num
        self.media= float(somma) / len(numeri)
    
    def run(self):
        while True:
            actualTime=time.localtime()
            year=actualTime[0]
            month=actualTime[1]
            day  =actualTime[2]
            hour =actualTime[3]
            minute=actualTime[4]
            self.dallas()
            self.phmeter()
            self.lista.append(float(self.actual))
            self.lista1.append(float(self.ph))
            
            if minute!=0:
                if self.midnight==0:
                    pass
                else:
                    self.midnight=0
            else:
                if self.midnight==0:
                    self.Media(self.lista)
                    temp_h2o="%.02f" % self.media
                    self.Media(self.lista1)
                    ph="%.02f" %self.media
                    pulse=0
                    lu = len(self.lista)
                    #self.insert_storage(day,month,year, hour, float(media1), float(minu), float(maxi) ,lu)
                    self.insert_storage(float(temp_h2o), float(ph), pulse,hour,day,month,year,lu)
                    self.lista=[]
                    self.midnight=1

            time.sleep(60)
