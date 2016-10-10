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

import sqlite3 as lite
import sys,os,time,ablib
from threading import Thread
from tools import *
from database import *

class MyPwm(Thread):
    db=Mydata()
    
    def __init__(self):
        pass
    
    def pwm_export(self,n):
        
        command="echo %s > /sys/class/pwm/pwmchip0/export" %str(n)
        os.system(command)
        
    def pwm_unexport(self,n):
        
        command=("echo %s > /sys/class/pwm/pwmchip0/unexport" %str(n))
        os.system(command)
        
    def pwm_period(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/period" %(str(p),str(n))
        os.system(command)
        
    def pwm_duty_cycle(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/duty_cycle" %(str(p),str(n))
        os.system(command)
        
    def pwm_enable(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/enable" %(str(p),str(n))
        os.system(command)
        
        
    def view_pwm(self):
        tempo=time.time()
        a=self.db.view_pwm('pwm2')
        self.period_2=a[1]
        self.duty_cycle_2=a[2]
        self.enable_2=a[3]
        self.start_2=a[4]
        self.stop_2=a[5]
        self.on_2=a[6]
        
        b=self.db.view_pwm('pwm3')
        self.period_3=a[1]
        self.duty_cycle_3=a[2]
        self.enable_3=a[3]
        self.start_3=a[4]
        self.stop_3=a[5]
        self.on_3=a[6]
        
    def calc_hour_pwm(self,start,stop,fra,actual):
        pass
    
    
    def run(self):
        self.pwm_export(2)
        self.pwm_period(2,1000000)
        self.pwm_duty_cycle(2,100000)
        self.pwm_enable(2,1)
    
        self.pwm_export(3)
        self.pwm_period(3,1000000)
        self.pwm_duty_cycle(3,100000)
        self.pwm_enable(3,1)
        #da finire bisogna passargli ora start ora stop calcolare quante ore sta acceso e regolare il pwm
        while True:
            tempo=time.time()
            
            self.view_pwm()
            
            minuti=int(hour)*60
            pwm_min=1000000/minuti
            hour=hour * 3600
            stop =tempo + hour
            
            if self.on_2==0:
                self.db.update_pwm('pwm2','start',float(tempo))
                self.db.update_pwm('pwm2','stop',float(stop))
                self.db.update_pwm('pwm2','on',1)
            
            
            time.sleep(60)