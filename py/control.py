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
import time,sys,smtplib
from datetime import *
from threading import Thread
from baseconfig import *
sys.path.append("%slib" %workingDir)
#db
from database_sqlite import *
from ablib import Pin
#import ablib
from tools import *
#PA24 'J4.11'  :  56, #PA24
#PA25 'J4.13'  :  57, #PA25
#PA26 'J4.15'  :  58, #PA26
#PA27 'J4.17'  :  59, #PA27

class MyThread(Thread):
    db=Mydata()
    array=[]
    rel1=0
    rel2=0
    rel3=0
    rel4=0
    rele1 = Pin('J4.13','OUTPUT')
    rele2 = Pin('J4.15','OUTPUT')
    rele3 = Pin('J4.17','OUTPUT')
    rele4 = Pin('J4.19','OUTPUT')
    
    def actualtime(self):
        logCritical("time")
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]
        
    def status(self,status_id):
        self.actualtime()
        x = self.db.view_configure()
        #logCritical("status %s" %x)
        for b in x:
            id=int(b[0])
            label=b[1]
            man=int(b[10])
            calendar=int(b[11])
            sunrise=int(b[12])
            
            if id==status_id:

                if man == 1 and calendar == 0 and sunrise == 0:
                    self.manual(id)
                if man == 0 and calendar == 1 and sunrise == 0:
                    self.db_calendar(id,label)
                if man == 0 and calendar == 0 and sunrise == 1:
                    pass
            
                
    def manual(self,manual_id):
        while True:
            try:
                self.actualtime()
                x = self.db.view_configure()
                self.array=[]
                for b in x:
                    id=int(b[0])
                    start_hour=int(b[2])
                    start_min=int(b[3])
                    stop_hour=int(b[4])
                    stop_min=int(b[5])
                    man=int(b[10])
                    if id==manual_id:
                        self.array.append([start_hour,start_min,stop_hour,stop_min,man])

                for interval in self.array:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        if actual >= minon and actual <= minoff:
                            if manual_id==1:
                                self.rel1=1
                            if manual_id==2:
                                self.rel2=1
                            if manual_id==3:
                                self.rel3=1
                            if manual_id==4:
                                self.rel4=1
                        else:
                            if manual_id==1:
                                self.rel1=0
                            if manual_id==2:
                                self.rel2=0
                            if manual_id==3:
                                self.rel3=0
                            if manual_id==4:
                                self.rel4=0
                break
            except:
                #logCritical("except")
                pass
    def sunrise(self,id):
        pass
     #id, uid , m ,d ,y ,start_ '00:00:00',end '00:00:00',title ,text 
     #(id,timestamp,title,description,url,email,cat,starttime,endtime,day,month,year,approved,priority,user,timezone   
     #il titolo deve avere i nomi rele1 rele2 rele3 rele4
    def db_calendar(self,id,label):
        try:
            self.actualtime()
            x = self.db.view_calendarix(self.month,self.day,self.year)
            self.arrayy=[]
            for b in x:
                m=int(b[10])
                d=int(b[9])
                y=int(b[11])
                start=b[7]
                end=b[8]
                title=str(b[2])
                text=int(b[3])
                campistart=start.split(':')
                campiend=end.split(':')
                ho,mo=campiend
                hh,mm=campistart
                if title== "%s" %label :
                    #minuti in 24H 1440
                    minon= (int(hh)*60)+int(mm)
                    minoff=(int(ho)*60)+int(mo)
                    self.arrayy.append([minon,minoff,text])
                    
            minact=(int(self.hour)*60)+int(self.minute)
            power=False
        
            for interval in self.arrayy:
                if minact>=interval[0] and minact <=interval[1]:
                    power=True
                    intervall=interval[2]

            if power==True:
                if id==1:
                    self.rel1=1
                if id==2:
                    self.rel2=1
                if id==3:
                    self.rel3=1
                if id==4:
                    self.rel4=1
                
            elif power==False:
                if id==1:
                    self.rel1=0
                if id==2:
                    self.rel2=0
                if id==3:
                    self.rel3=0
                if id==4:
                    self.rel4=0
                
        except Exception,e:
            logCritical("control calendar %s" %e)
            time.sleep(0.5)

            
    def run(self):
        z=1
        while True:
            #logCritical("while")
            self.actualtime()
            self.status(int(z))
            z+=1
            if z==4:
                z=1
            
            if self.rel1==1:
                self.rele1.on()
            else:
                self.rele1.off()
                
            if self.rel2==1:
                self.rele2.on()
            else:
                self.rele2.off()
                
            if self.rel3==1:
                self.rele3.on()
            else:
                self.rele3.off()
                
            if self.rel4==1:
                self.rele4.on()
            else:
                self.rele4.off()

            time.sleep(10)
