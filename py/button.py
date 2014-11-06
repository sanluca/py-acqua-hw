#!/usr/bin/python
###################################################################################################                                                                                              
#                                                                                               
# DEVELOPERS : Luca Sanna                                                                        
# VERSIONE : 0.1                                                                                  
#                                                                                                                    
# E-MAIL: sanluca78@gmail.com                                                                                        
# COPYRIGHT: (c) 2013                                                                       
# PROGRAMMA: Py-Temperature  
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
import ablib
from tools import *
#logCritical("")
class MyButton(Thread):
    db=Mydata()
    plcd=Myplcd()
    pos=0
    enter=False
    try:
        lcd = ablib.Daisy24(0,0x3F)
    except:
        pass
    #lcd = ablib.Daisy24()
    ledlcd=False
    press1=False
    menuSet=False
    intro=True

    #if lcd.pressed(0):
    def actualTime(self):
        actualTime=time.localtime()
        self.year=actualTime[0]
        self.month=actualTime[1]
        self.day=actualTime[2]
        self.hour=actualTime[3]
        self.minute=actualTime[4]


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
        
        #while True:
            #self.plcd.pagina(0,True)
            #time.sleep(20)

        while True:
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
                        command=("shutdown -h now")
                        os.system(command)
            #except:
                #pass

#            if self.lcd.pressed(2):
#                if self.pos==2:
#                    self.menuSet=True
#                    self.plcd.pagina(2,False)

#                if self.enter==True:
#                    self.menuSet=False
#                    self.plcd.pagina(self.pos,True)

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