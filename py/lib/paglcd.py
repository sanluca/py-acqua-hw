#!/usr/bin/python
###################################################################################################                                                                                              
#                                                                                               
# DEVELOPERS : Luca Sanna                                                                        
# VERSIONE : 2.0                                                                                  
#                                                                                                                    
# E-MAIL: sanluca78@gmail.com                                                                                        
# COPYRIGHT: (c) 2015                                                                      
# PROGRAMMA: Py-Acqua-hw  
#This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.                                                                          
###################################################################################################
import time,sys,os,ablib
from database import *
from tools import *

class Myplcd():
    pos=0
    db=Mydata()
    try:
        lcd = ablib.Daisy24(0,0x3E)
    except:
        pass
    
    def actualTime(self):
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]
        
    def view_real_time(self):
        z=self.db.view_real_time()
        self.temp=z[1]
        self.ph=z[2]
        
    def view_label(self,idd):
        x = self.db.view_configure()
        for b in x:
            self.id=int(b[0])
            self.label=b[1]
            self.manual=int(b[10])
            self.calendar=int(b[11])
            self.sunrise=int(b[12])
            
            if self.id==idd:
                self.label=self.label
            

    def pagina(self,pos,font):
        self.view_real_time()
        self.actualTime()
        self.lcd.clear()
        self.lcd.setcontrast(5)
        
        if font == True:
            self.lcd.setsinglefont()
        else:
            self.lcd.setdoublefont()
            
        if pos==-1:
            self.lcd.putstring("Py-Acqua")
            
        if pos==0:
            
            self.lcd.putstring(time.strftime("%d-%m-%Y-%H:%M"))
            self.lcd.setcurpos(0,1)
            self.lcd.putstring("%s gradi" %self.temp)
            self.pos=0
        
        elif pos==1:
            self.lcd.putstring("PH %s " %(self.ph))
            self.pos=1
            
        elif pos==2:
            self.lcd.putstring("Stato")      
                    
            #view_label(1)
            #self.lcd.putstring("%s" %(self.label))
            self.pos=2
            
        elif pos==3:
            self.lcd.putstring("Riavvia")
            self.pos=3
            
        elif pos==4:
            self.lcd.putstring("Spegni")
            self.pos=4
        
    def returnPos(self):
        return self.pos
    
    
    