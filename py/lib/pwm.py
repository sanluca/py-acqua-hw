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
from tools import *

class Mypwm():
    
    def __init__(self):
        pass
    
    def pwm_export(self,n):
        
        command="echo %s > /sys/class/pwm/pwmchip0/export" %str(n)
        os.system(command)
        
        #f = open('/sys/class/pwm/pwmchip0/export','w')
        #f.write(str(n))
        #f.close()
        
    def pwm_unexport(self,n):
        
        command=("echo %s > /sys/class/pwm/pwmchip0/unexport" %str(n))
        os.system(command)
        
        #f = open('/sys/class/pwm/pwmchip0/unexport','w')
        #f.write(str(n))
        #f.close()
        
    def pwm_period(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/period" %(str(p),str(n))
        os.system(command)
        
        #f = open('/sys/class/pwm/pwmchip0/pwm%s/period' %str(n),'w')
        #f.write(str(p))
        #f.close()
        
    def pwm_duty_cycle(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/duty_cycle" %(str(p),str(n))
        logCritical("command %s" %command)
        os.system(command)
        
        #f = open('/sys/class/pwm/pwmchip0/pwm%s/duty_cycle' %str(n),'w')
        #f.write(str(p))
        #f.close()
        
    def pwm_enable(self,n,p):
        
        command= "echo %s > /sys/class/pwm/pwmchip0/pwm%s/enable" %(str(p),str(n))
        os.system(command)
        
        #f = open('/sys/class/pwm/pwmchip0/pwm%s/enable' %str(n),'w')
        #f.write(str(p))
        #f.close()
        
    