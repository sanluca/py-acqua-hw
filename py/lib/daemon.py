#!/usr/local/bin/python
# -*- coding: utf-8 -*-
#----------------------------------------------------------------------
# Name:            daemon.py
# Revision Date:   2006/03/27
# Revision Number: 0.90
#
# Purpose:         Tool for process daemonizing
#
# Author:          Davide Dicerto
#
# Created:         2004 Davide Dicerto
# Copyright:       (c) 2004
# Licence:         GPL
#----------------------------------------------------------------------

import os
import signal
import sys
from tools import *
from signal import SIGTERM

class DaemonApp:
    "A daemon template class"
    SLEEP_TIME = 1

    def deamonize(self, stdout='/dev/null', stderr=None, stdin='/dev/null',
                  startmsg = '**** STARTED WITH PID %s at ****'):
        '''
        This forks the current process into a daemon.
        The stdin, stdout, and stderr arguments are file names that
        will be opened and be used to replace the standard file descriptors
        in sys.stdin, sys.stdout, and sys.stderr.
        These arguments are optional and default to /dev/null.
        Note that stderr is opened unbuffered, so
        if it shares a file with stdout then interleaved output
        may not appear in the order that you expect.
        '''

        # Do first fork.
        try: 
            pid = os.fork() 
            if pid > 0:
                sys.exit(0) # Exit first parent.
        except OSError, e: 
            logmessage("fork #1 failed: (%d) %s\n" % (e.errno, e.strerror))
            sys.exit(1)
        
        # Decouple from parent environment.
        os.chdir("/") 
        os.umask(0) 
        os.setsid() 
       
        # Open file descriptors and print start message
        if not stderr:
            stderr = stdout
        si = file(stdin, 'r')
        so = file(stdout, 'a+')
        se = file(stderr, 'a+', 0)
        pid = str(os.getpid())
        if self.pidfile:
            file(self.pidfile,'w+').write("%s\n" % pid)
    
        # Redirect standard file descriptors.
        os.dup2(si.fileno(), sys.stdin.fileno())
        os.dup2(so.fileno(), sys.stdout.fileno())
        os.dup2(se.fileno(), sys.stderr.fileno())
        #logCritical(breakline)
        #logCritical("%s" % startmsg % pid)

    def startstop(self, stdout='/dev/null', stderr=None, stdin='/dev/null',
                  startmsg = '**** STARTED WITH PID %s ****'):
        if len(sys.argv) > 1:
            action = sys.argv[1]
            try:
                #pf  = file(self.pidfile,'r')
                #pid = int(pf.read().strip())
                #pf.close()
                pid=None
            except IOError:
                pid = None
            if 'stop' == action or 'restart' == action:
                if not pid:
                    mess = "Could not stop, pid file '%s' missing."
                    logmessage(mess % self.pidfile)
                    sys.exit(1)
                try:
                    while 1:
                        os.kill(pid,SIGTERM)
                        time.sleep(1)
                except OSError, err:
                    err = str(err)
                    if err.find("No such process") > 0:
                        if 'stop' == action:
                            sys.exit(0)
                        action = 'start'
                        pid = None
                    else:
                        print str(err)
                        sys.exit(1)
            if 'start' == action:
                if pid:
                    if os.path.exists("/proc/%s" %pid):
                        mess = "Process is already running."
                        logmessage(mess)
                        sys.exit(1)
                    else:
                        mess = "Removing old pidfile: process is dead."
                        logmessage(mess)
                        os.remove(self.pidfile)
                    
                self.deamonize(stdout,stderr,stdin,startmsg)
                return
        print "usage: %s start|stop|restart" % sys.argv[0]
        sys.exit(2)


    def initsignals(self):
        """Register signal handlers
        """
        signal.signal(signal.SIGINT, self.kill_handler)
        signal.signal(signal.SIGQUIT, self.kill_handler)
        #signal.signal(signal.SIGKILL, self.kill_handler)
        signal.signal(signal.SIGTERM, self.kill_handler)
        signal.signal(signal.SIGHUP, self.kill_handler)
        signal.signal(signal.SIGUSR1, self.kill_handler)

    def kill_handler(self, signum, frame):
        """Signal handler for SIGINT, SIGQUIT, and SIGKILL
        """
        if signum == signal.SIGHUP:
            self.restart()
        elif signum== signal.SIGUSR1:
            self.signalUSR1()
        else:
            self.wrapup()
        
    
    def main(self):
        """ A daemon main routine
        """
        
        while 1:
            # do work here
            print time.ctime(),": prova"
            sys.stdout.flush()
            time.sleep(self.SLEEP_TIME)
            
            
    def wrapup(self):
        """Close database connections and other resources, then exit
        """
        os.remove(self.pidfile)
        sys.exit(1)

    def restart(self):
        logmessage("*** Ricevuta richiesta di restart...")
        
    def signalUSR1(self):
        logmessage("*** Ricevuto segnale SIGUSR1(10)")


if (__name__=="__main__"):
    daemon = DaemonApp()
    daemon.pidfile = '/tmp/daemon.pid'
    daemon.startstop(stdout='/tmp/daem.log',stderr='/tmp/daerr.log')
    daemon.initsignals()
    daemon.main()
