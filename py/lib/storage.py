#!/usr/bin/python
###################################################################################################                                                                                              
#                                                                                               
# DEVELOPERS : Luca Sanna                                                                        
# VERSIONE : 0.1                                                                                  
#                                                                                                                    
# E-MAIL: sanluca78@gmail.com                                                                                        
# COPYRIGHT: (c) 2013                                                                       
# PROGRAMMA: Py-Acqua-hw  
#This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.                                                                          
###################################################################################################
import time,sys,math,smtplib#,ablib
from ablib import DS18B20
from threading import Thread
from database_sqlite import *
from tools import *
class MyStorage(Thread):
    db=Mydata()
    lista=[]
    midnight=0
    
    def dallas(self):
        while True:
            try:
                #1-wire pin 32
                sensor = DS18B20("000005a11adb")
                self.actual1 = sensor.getTemp()
                self.actual = "%.02f" %self.actual1
                if self.actual == None:
                    pass
                else:
                    self.db.update_real_time('temp_h2o',float(self.actual))
                    break
            except:
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
            self.lista.append(float(self.actual))
            
            if minute!=0:
                if self.midnight==0:
                    pass
                else:
                    self.midnight=0
            else:
                if self.midnight==0:
                    self.Media(self.lista)
                    temp_h2o="%.02f" % self.media
                    ph=0
                    pulse=0
                    lu = len(self.lista)
                    #self.insert_storage(day,month,year, hour, float(media1), float(minu), float(maxi) ,lu)
                    self.insert_storage(float(temp_h2o), float(ph), pulse,hour,day,month,year,lu)
                    self.lista=[]
                    self.midnight=1

            time.sleep(60)
