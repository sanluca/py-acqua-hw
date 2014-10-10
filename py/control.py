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
from database import *
from ablib import Pin
#import ablib
from tools import *
#PA24 'J4.11'  :  56, #PA24
#PA25 'J4.13'  :  57, #PA25
#PA26 'J4.15'  :  58, #PA26
#PA27 'J4.17'  :  59, #PA27

class MyThread(Thread):
    db=Mydata()
    sun=0
    cal=0
    man=0
    array=[]
    array1=[]
    array2=[]
    array3=[]
    array4=[]
    rel1=0
    rel2=0
    rel3=0
    rel4=0
    rele1 = Pin('J4.13','OUTPUT')
    rele2 = Pin('J4.15','OUTPUT')
    rele3 = Pin('J4.17','OUTPUT')
    rele4 = Pin('J4.19','OUTPUT')
    
    def actualtime(self):
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]
        
    def status(self,status_id):
        self.actualtime()
        x = self.db.view_configure()
        for b in x:
            id=int(b[0])
            label=b[1]
            man=int(b[10])
            calendar=int(b[11])
            sunrise=int(b[12])
            
            if id==status_id:
                #logCritical("status idd %s" %idd)
                #pass
                if man == 1 and calendar == 0 and sunrise == 0:
                    #self.man=1
                    #logCritical("manual %s" %idd)
                    self.manual(id)
                    #logCritical("manual %s" %idd)
                if man == 0 and calendar == 1 and sunrise == 0:
                    #self.cal=1
                    self.db_calendar(id,label)
                    #logCritical("calendar %s %s" %idd,self.label)
                if man == 0 and calendar == 0 and sunrise == 1:
                    pass
            
                
    def manual(self,manual_id):
        #logCritical("id 1 %s" %iddd)
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
                    #logCritical("dentro b in x manual")
                    #logCritical("id 2 %s" %iddd)
                    #logCritical("idd %s" %self.idd)
                    if id==manual_id:
                        self.array.append([start_hour,start_min,stop_hour,stop_min,man])
                        #logCritical("idddddd %s" %iddd)

                for interval in self.array:
                    #logCritical("for interval")
                    if interval[4]==1:
                        #logCritical("if interval")
                        actual= (int(self.hour)*60)+int(self.minute)
                        #logCritical("actual %s" %actual)
                        minon= (int(interval[0])*60)+int(interval[1])
                        #logCritical("minon %s" %minon)
                        minoff=(int(interval[2])*60)+int(interval[3])
                        #logCritical("minoff %s" %minoff)
                        if actual >= minon and actual <= minoff:
                            #logCritical("dentro interval %s" %iddd)
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
                pass
    def sunrise(self,id):
        pass
        
    def db_configure(self):
        while True:
            try:
                self.actualtime()
                x = self.db.view_configure()
                self.array1=[]
                self.array2=[]
                self.array3=[]
                self.array4=[]
                for b in x:
                    self.id=int(b[0])
                    self.start_hour=int(b[2])
                    self.start_min=int(b[3])
                    self.stop_hour=int(b[4])
                    self.stop_min=int(b[5])
                    self.rele11=int(b[6])
                    self.rele22=int(b[7])
                    self.rele33=int(b[8])
                    self.rele44=int(b[9])
                    self.manual=int(b[10])
                    self.calendar=int(b[11])
                    self.sunrise=int(b[12])
                    
                    if self.id==1:
                        self.array1.append([self.start_hour,self.start_min,self.stop_hour,self.stop_min,self.manual,self.calendar,self.sunrise])
                        
                    if self.id==2:
                        self.array2.append([self.start_hour,self.start_min,self.stop_hour,self.stop_min,self.manual,self.calendar,self.sunrise])
                        
                    if self.id==3:
                        self.array3.append([self.start_hour,self.start_min,self.stop_hour,self.stop_min,self.manual,self.calendar,self.sunrise])
                        
                    if self.id==4:
                        self.array4.append([self.start_hour,self.start_min,self.stop_hour,self.stop_min,self.manual,self.calendar,self.sunrise])
                        
                for interval in self.array1:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        if actual >= minon and actual <= minoff:
                            self.rel1=1
                        else:
                            self.rel1=0
                            
                for interval in self.array2:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        if actual >= minon and actual <= minoff:
                            self.rel2=1
                        else:
                            self.rel2=0
                            
                for interval in self.array3:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        if actual >= minon and actual <= minoff:
                            self.rel3=1
                        else:
                            self.rel3=0
                            
                for interval in self.array4:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        if actual >= minon and actual <= minoff:
                            self.rel4=1
                        else:
                            self.rel4=0
                break
            except Exception,e:
                logCritical("db configure control %s" %e)
                time.sleep(0.5)
                if e[0] == 2006:
                    time.sleep(5)
                    command=("/etc/init.d/mysql restart")
                    os.system(command)
                    time.sleep(5)
            	    self.db.riavvio_db()
                    try:
                        host=smtplib.SMTP ("127.0.0.1")
                        ret=host.sendmail("luca@example.com", "sanluca78@gmail.com", "reboot mysql")
                    except:
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
            #self.db_configure()
            self.actualtime()
            self.status(int(z))
            #logCritical("z %s" %z)
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
