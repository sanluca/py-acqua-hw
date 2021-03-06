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
import time,sys,smtplib,ephem,datetime,pytz
from threading import Thread
from baseconfig import *
sys.path.append("%slib" %workingDir)
#db
from database import *
from ablib import Pin
from tools import *
from pwm import *
#output
#'J4.25'  :  40, #PA8
#'J4.27'  :  38, #PA6
#'J4.29'  : 124, #PC28
#'J4.31'  : 100, #PC4

class MyThread(Thread):
    db=Mydata()
    pwm=MyPwm()
    array=[]
    rel1=0
    rel2=0
    rel3=0
    rel4=0
    expwm=False
    rele1 = Pin('J4.25','OUTPUT')
    rele2 = Pin('J4.27','OUTPUT')
    rele3 = Pin('J4.29','OUTPUT')
    rele4 = Pin('J4.31','OUTPUT')
    #pwm
    #pwm.pwm_export(2)
    #pwm.pwm_period(2,1000000)
    #pwm.pwm_duty_cycle(2,100000)
    #pwm.pwm_enable(2,1)
    
    #pwm.pwm_export(3)
    #pwm.pwm_period(3,1000000)
    #pwm.pwm_duty_cycle(3,100000)
    #pwm.pwm_enable(3,1)
    #p=0
    
    def actualtime(self):
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]

    def power_rele_on(self,id):
        if id==1:
            self.rel1=1
        if id==2:
            self.rel2=1
        if id==3:
            self.rel3=1
        if id==4:
            self.rel4=1
    
    def power_rele_off(self,id):
        if id==1:
            self.rel1=0
        if id==2:
            self.rel2=0
        if id==3:
            self.rel3=0
        if id==4:
            self.rel4=0
        
    def status(self,status_id):
        self.actualtime()
        x = self.db.view_configure()
        #logCritical("status %s" %x)
        for b in x:
            id=int(b[0])
            label=b[1]
            man=int(b[6])
            calendar=int(b[7])
            sunrise=int(b[8])
            temperature=int(b[9])
            ph=int(b[10])
            pwm=int(b[11])
            
            if id==status_id:

                if man == 1 and calendar == 0 and sunrise == 0 and temperature == 0 and ph == 0:
                    self.manual(id)
                if man == 0 and calendar == 1 and sunrise == 0 and temperature == 0 and ph == 0:
                    self.db_calendar(id,label)
                if man == 0 and calendar == 0 and sunrise == 1 and temperature == 0 and ph == 0:
                    self.sunrise(id,pwm)
                
                if temperature== 1:
                    self.temperature(id)
                if ph==1:
                    self.ph(id)
                
                #if pwm==1:
                    #self.pwm.calc_hour_pwm()
                
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
                    man=int(b[6])
                    pwm_led=int(b[11])
                    if id==manual_id:
                        self.array.append([start_hour,start_min,stop_hour,stop_min,man])

                for interval in self.array:
                    if interval[4]==1:
                        actual= (int(self.hour)*60)+int(self.minute)
                        minon= (int(interval[0])*60)+int(interval[1])
                        minoff=(int(interval[2])*60)+int(interval[3])
                        
                        if pwm_led==0:
                            if actual >= minon and actual <= minoff:
                                self.power_rele_on(manual_id)

                            else:
                                self.power_rele_off(manual_id)
                                
                        else:
                            minfra=0
                            #self.pwm.calc_hour_pwm(minon,minoff,minfra,actual)
                            self.db.update_pwm('pwm2','start',minon)
                            self.db.update_pwm('pwm2','stop',minoff)
                            self.db.update_pwm('pwm2','mezza',minfra)
                            
                break
            except Exception,e:
                logCritical("control manual %s" %e)
                time.sleep(1)
    def sunrise(self,sunrise_id,led_pwm):
        try:
            x = self.db.view_sunrise()
            llong=x[1]
            llat=x[2]
            zone1=x[3]
            duelamp = x[4]
            shifthour = x[5]
            shift_hour= int(shifthour)*60
            
            zone='%s' %zone1
        
            my_date = datetime.datetime.now(pytz.timezone(zone))
        
            o=ephem.Observer()
            o.lat= '%s' %llat
            o.long= '%s' %llong
            #logCritical("olat %s olong %s" %(o.lat,o.long))
            s=ephem.Sun()
            s.compute()
        
            fmt = "%H:%M"
        
            utc_sun= o.previous_rising(ephem.Sun()).datetime().replace(tzinfo=pytz.utc)
            utc_noon= o.previous_transit(ephem.Sun()).datetime().replace(tzinfo=pytz.utc)
            utc_set=o.previous_setting(ephem.Sun()).datetime().replace(tzinfo=pytz.utc)
        
            sunrise= utc_sun.astimezone(pytz.timezone(zone))
            noon=utc_noon.astimezone(pytz.timezone(zone))
            sunset= utc_set.astimezone(pytz.timezone(zone))
        
            newsunrise=sunrise.strftime(fmt)
            newnoon=noon.strftime(fmt)
            newsunset=sunset.strftime(fmt)

            actual=my_date.strftime(fmt)
            #logCritical("utc noon %s" %newnoon)
            #sunrise 2014-11-01 06:49:09.000005 noon 2014-11-01 11:52:59.000005 sunset 2014-11-01 16:56:13.000005
            campistart=newsunrise.split(':')
            campifra=newnoon.split(':')
            campiend=newsunset.split(':')
            campiactual=actual.split(':')
            ho,mo=campiend
            hme,mme=campifra
            hh,mm=campistart
            ha,ma=campiactual
            minon= (int(hh)*60)+int(mm)+int(shift_hour)
            minfra= (int(hme)*60)+int(mme)+int(shift_hour)
            minoff=(int(ho)*60)+int(mo)+int(shift_hour)
            minact=(int(ha)*60)+int(ma)+int(shift_hour)
            #logCritical("minon %s minoff %s minact %s" %(minon,minoff,minact))
            power=False
            #verifico se si usano due lampade differenti
            if led_pwm==0:
                if duelamp==0:
                
                    if minact >= minon and minact <= minoff:
                        power=True
                    #la prima lampada si accendera dal mattino al mezzogiorno, la seconda dal mezzogiorno alla sera     
                else:
                    if minact >= minon and minact <= (minfra+60):
                        if sunrise_id==1:
                            power=True
                    if minact >= minfra and minact <= minoff:
                        if sunrise_id==2:
                            power=True
            
            #if led_pwm==0:
                if power==True:
                    self.power_rele_on(sunrise_id)
                
                elif power==False:
                    self.power_rele_off(sunrise_id)
                    
            else:
                #self.pwm.calc_hour_pwm(minon,minoff,minfra,minact)
                self.db.update_pwm('pwm2','start',minon)
                self.db.update_pwm('pwm2','stop',minoff)
                self.db.update_pwm('pwm2','mezza',minfra)
                
        except Exception,e:
            logCritical("control sunrise %s" %e)
            time.sleep(1)

     #il titolo deve avere le label
     #2014-0-30 formata data 15:00 formato ora
    def db_calendar(self,id,label):
        try:
            self.actualtime()
            
            indata=time.strftime("%Y-%m-%d")
            #logCritical("indata %s" %indata)
            zerodata="9999-00-00"
            x = self.db.view_calendar(str(indata),str(zerodata))
            #logCritical("x %s" %x)
            self.arrayy=[]
            for b in x:
                title=str(b[3])
                sdate=(b[15])
                edate=(b[16])
                stime=(b[18])
                etime=(b[19])
                
                #logCritical("sdate %s edate %s" %(sdate,edate))
                            
                if (sdate == indata) or (sdate <= indata and edate >= indata):
                    #logCritical("sdate edate calendar")
                    campistart=stime.split(':')
                    campiend=etime.split(':')
                    ho,mo=campiend
                    hh,mm=campistart
                    if title== "%s" %label :
                    #minuti in 24H 1440
                        minon= (int(hh)*60)+int(mm)
                        minoff=(int(ho)*60)+int(mo)
                        self.arrayy.append([minon,minoff])
                    
            minact=(int(self.hour)*60)+int(self.minute)
            power=False
        
            for interval in self.arrayy:
                if minact>=interval[0] and minact <=interval[1]:
                    power=True

            if power==True:
                self.power_rele_on(id)
                
            elif power==False:
                self.power_rele_off(id)
                
        except Exception,e:
            logCritical("control calendar %s" %e)
            time.sleep(1)
    
    def temperature(self,temp_id):
        e=self.db.view_real_time()
        temp_real=e[1]
        
        x = self.db.view_configure()
        for b in x:
            id=int(b[0])
            temp = b[11]
            if temp_id==id:
                if temp_real >= temp:
                    power =False
                else:
                    power = True
            
            if power==True:
                self.power_rele_on(temp_id)
                
            elif power==False:
                self.power_rele_off(temp_id)
         
    def ph(self,ph_id):
        e=self.db.view_real_time()
        ph_real=e[2]
        
        x = self.db.view_configure()
        for b in x:
            id=int(b[0])
            ph = b[12]
            if ph_id==id:
                if ph_real>=ph:
                    power=False
                else:
                    power=True
            if power==True:
                self.power_rele_on(ph_id)
                
            elif power==False:
                self.power_rele_off(ph_id)
                
    def run(self):
        z=1
        while True:
            self.actualtime()
            self.status(int(z))
            z+=1
            if z==5:
                z=1
            
            if self.rel1==1:
                self.rele1.on()
                self.db.update_real_time('status','rel1',1)
            else:
                self.rele1.off()
                self.db.update_real_time('status','rel1',0)
                
            if self.rel2==1:
                self.rele2.on()
                self.db.update_real_time('status','rel2',1)
            else:
                self.rele2.off()
                self.db.update_real_time('status','rel2',0)
                
            if self.rel3==1:
                self.rele3.on()
                self.db.update_real_time('status','rel3',1)
            else:
                self.rele3.off()
                self.db.update_real_time('status','rel3',0)
                
            if self.rel4==1:
                self.rele4.on()
                self.db.update_real_time('status','rel4',1)
            else:
                self.rele4.off()
                self.db.update_real_time('status','rel4',0)

            time.sleep(0.5)
