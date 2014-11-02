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

import os,sys,time,copy,string,re
from math import sqrt
from baseconfig import *
sys.path.append("%slib" %workingDir)
from tools import *
import daemon
from database_sqlite import *
from control import *
from button import *
from storage import *

db=Mydata()
#db.create_db()
#db.populate_db()

class mainprogram(daemon.DaemonApp):

    def __init__(self):
        
        if not os.path.isdir(requestDir):
            os.mkdir(requestDir)

    def main(self):
        logCritical("-----")
        logCritical("*** PROGRAM STARTED AT %s WITH PID %s ***" % (time.ctime(),os.getpid()))
        #control.py
        self.ctrl = MyThread()
        self.ctrl.start()
        #button lcd
        self.b = MyButton()
        self.b.start()
        #storage
        self.store=MyStorage()
        self.store.start()

    def restart(self):
        """Effettua la richiesta di reinizializzazione di py-temperature:
        viene eseguita anche nel caso di invio al processo di una SIGHUP"""
        self.reinit=True
        logmessage("*** Ricevuta richiesta di restart...")
                
   # def signalUSR1(self):
    #    logmessage("*** Ricevuto segnale SIGUSR1(10)")
      #  logmessage("*** Richiesta remota di campionamento")
     #   self.takesamplenow = True
        
    def wrapup(self):
        """Richiamata nel caso di stop del processo main"""
        logCritical("*** PROGRAM STOPPED AT %s ***" % (time.ctime()))
        if os.path.exists(self.pidfile):
            os.remove(self.pidfile)
        sys.exit()

    def __del__(self):
        pass

if __name__=="__main__":
      
    initlog(logfile,loglevel=logging.ERROR)
    mainloop = mainprogram()
    mainloop.pidfile = pidfile
    mainloop.startstop(stderr=logfile+".err")
    #mainloop.startstop(stdout=logfile)
    mainloop.initsignals()    
    mainloop.main()
