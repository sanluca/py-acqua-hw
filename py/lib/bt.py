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
import os,sys,time
from threading import Thread
from bluetooth import *
from database import *
from tools import *

class btscan(Thread):
    db=Mydata()
    
    def db_man(self):
        try:
            x = self.db.view_manual()
            self.bt = int(x[6])
            self.scandevice= int(x[7])

        except Exception,e:
    	    if e[0] == 2006:
                self.db.database_close()
                self.db.database_conn()
            logCritical("bt db man %s" %e)
            time.sleep(2)
    
    def scan(self):
        try:
            devices = discover_devices(duration=30, lookup_names = True)

            if (devices!=None):
                for addr,name in devices:
                    self.db.insert_bt(str(name),str(addr),0)
                    time.sleep(1)
                  
            self.db.update_manual('scan',0)
            
        except Exception,e:
                logCritical("bt scan %s" %e)
                time.sleep(0.5)

    def ping(self):
        try:
            bb=self.db.view_bt()
            s=False
            for b in bb:
                mc=str(b[2])
                scan=int(b[3])
                if scan==1:
                    command=("l2ping -c 1 %s > /dev/shm/output.txt") % mc
                    os.system(command)
                    time.sleep(1)        
                    f = open('/dev/shm/output.txt','r').read()
                    if "bytes from" in f:
                        s=True
                        
            if s==True:
               self.db.update_manual('cel',1)
            else:
               self.db.update_manual('cel',0)

        except Exception,e:
            logCritical("ping bluetooth %s" %e)
            time.sleep(0.4)
            
    def run(self):
        while True:
            self.db_man()
            if self.scandevice==1:
                self.scan()
            if self.bt==1:
                time.sleep(600)
                self.ping()
            time.sleep(2)