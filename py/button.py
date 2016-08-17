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
import time,sys,os
from threading import Thread
from baseconfig import *
sys.path.append("%slib" %workingDir)
#db
#from database_sqlite import *
from paglcd import *
from ablib import *
from tools import *
#logCritical("")
class MyButton(Thread):
    db=Mydata()
    plcd=Myplcd()
    pos=0
    enter=False
    lcd = ablib.Daisy24(0,0x3F)
    #lcd = ablib.Daisy24()
    ledlcd=False
    press1=False
    menuSet=False
    intro=True
    #input
#PA24 'J4.11'  :  56, #PA24
#PA25 'J4.13'  :  57, #PA25
    in1 = Pin('J4.11','INPUT')
    in2 = Pin('J4.13','INPUT')

    #if lcd.pressed(0):
    def actualTime(self):
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]
        
    def event_in1(self):
        #self.db.update_real_time('status','in1',int(stat))
        self.db.update_real_time('status','in1',1)

    def event_in2(self):
        #self.db.update_real_time('status','in1',int(stat))
        self.db.update_real_time('status','in1',0)

    
    def event_in3(self,stat):
        self.db.update_real_time('status','in2',int(stat))
        
    #in1.set_edge("rising", event_in1)
    #in2.set_edge("both", event_in2)

    def run(self):
        if self.intro==True:
            self.lcd.backlighton()
            self.plcd.pagina(-1,False)
            self.intro=False
            self.ledlcd=True
            time.sleep(20)
            
        self.plcd.pagina(0,True)
        i=0
        z=0
        self.in1.set_edge('rising', self.event_in1)
        self.in1.set_edge('falling', self.event_in2)

        while True:
            
            #verifico i due ingressi esterni alla scheda
            #if self.in1.digitalRead()==0:
                #self.event_in1(1)
            #else:
                #self.event_in1(0)
            #if self.in2.digitalRead()==0:
                #self.event_in2(1)
            #else:
                #self.event_in2(0)
            
            #logCritical("input2 %s" %input2)
            
            self.pos=self.plcd.returnPos()
            time.sleep(0.2)
            z+=1
#pulsante menu avanti
            try:
                if self.lcd.pressed(0):
                    self.ledlcd=True
                    if self.press1==True and self.menuSet==False:
                        if self.pos <=3:
                            self.pos=self.pos+1
                            self.plcd.pagina(self.pos,True)
#pulsante menu indietro
                if self.lcd.pressed(1):
                    self.ledlcd=True
                    if self.press1==True and self.menuSet==False:
                        if self.pos > 0:
                            self.pos=self.pos-1
                            self.plcd.pagina(self.pos,True)
                            
                if self.lcd.pressed(2):
                    self.ledlcd=True
                    if self.pos==3:
                        #time.sleep(5)
                        command=("reboot")
                        os.system(command)
                
                if self.lcd.pressed(2):
                    self.ledlcd=True
                    if self.pos==4:
                        #time.sleep(5)
                        command=("shutdown -h -H now")
                        os.system(command)
                        
                if i==1200:
                    self.plcd.pagina(0,True)
                    self.ledlcd=False
                    self.lcd.backlightoff()
                    i=0
                
                if self.ledlcd==True:
                    i+=1
                    self.lcd.backlighton()
                    self.press1=True
                
                if self.ledlcd==False and z>=1200:
                    self.plcd.pagina(0,True)
                    z=0
                    self.press1=False
            except:
                pass
