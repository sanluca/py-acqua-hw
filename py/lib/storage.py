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
from database import *
from tools import *
class MyStorage(Thread):
    db=Mydata()
    lista=[]
    listadhtum=[]
    listadhtemp=[]
    midnight=0
    night=0
    
    def dallas(self):
        while True:
            try:
                sensor = DS18B20("000005a11adb")
                self.actual1 = sensor.getTemp()
                self.actual = "%.02f" %self.actual1
                if self.actual == None:
                    pass
                else:
                    self.db.update_real_time('temp_h2o',float(self.actual))
                    break
            except Exception,e:
                logCritical("storage dallas %s" %e)
                if e[0] == 2006:
                    self.db.riavvio_db()
                time.sleep(0.3)
                    
    def insert_work(self,temp_h2o, ph, pulse,hour,day,month,year,lu):
        self.db.save_work(temp_h2o, ph, pulse,hour,day,month,year,lu)
        
    def Media(self,numeri):
        if not numeri:
            return None
        somma = 0
        for num in numeri:
            somma += num
        self.media= float(somma) / len(numeri)
        
    def email(self):
        z= self.db.view_email()
        self.email=z[1]
        self.active=int(z[2])
    
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
                    self.insert_work(float(temp_h2o), float(ph), pulse,hour,day,month,year,lu)
                    self.lista=[]
                    self.midnight=1
            #salvo il funzionamento giornaliero della caldaia        
            if hour==23:
                if minute==59:
                    if self.night==0:
                        y=self.db.view_work()
                        start=float(y[1])
                        stop=float(y[2])
                        tot=float(y[3])
                        days=int(y[4])
                        con=int(y[5])
                        led=int(y[6])
                        totday=float(y[7])
                        if led==0:
                        #Id INT PRIMARY KEY AUTO_INCREMENT, day INT, month INT, year INT, hours FLOAT
                            totday=totday/3600
                            #self.insert_hours_day(day,month,year,totday)
                            #self.db.update_work('totday',0)
                        else:
                            s=time.time()
                            totday=(s-start)+totday
                            totday=totday/3600
                            #day=day-1#giorno precedente da cambiare
                            #self.insert_hours_day(day,month,year,totday)
                            #self.db.update_work('start',s)
                            #self.db.update_work('totday',0)
                    self.night=1  
                else:
                    self.night=0
                

            time.sleep(60)
