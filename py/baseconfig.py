#!/usr/bin/python
###################################################################################################                                                                                              
#                                                                                               
# DEVELOPERS : Luca Sanna                                                                        
# VERSIONE : 0.1                                                                                  
#                                                                                                                    
# E-MAIL: sanluca78@gmail.com                                                                                        
# COPYRIGHT: (c) 2014                                                                       
# PROGRAMMA: Py-Acqua-hw  
#This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.                                                                          
###################################################################################################
import os,sys

swVer="1.0 Beta"
hwVer="1.0 Beta"

projectName="py-acqua-hw"

foxdir = "/media/data/py-acqua-hw/py/"

errMgsWkdir = """ERROR! Cannot determine working directory!
Please check your config in baseconfig.py..."""

def workingdir():
    wkdir=""
    if os.path.exists("%smain.py" % foxdir):
        wkdir=foxdir

    if not wkdir:
        print errMgsWkdir
        sys.exit(1)
    else: return wkdir

workingDir = workingdir()

pidfile="%svar/run/%s.pid" % (workingDir,projectName)
logfile="%svar/log/%s.log" % (workingDir,projectName)
reinitFile="/tmp/%sReinitRequest" % projectName
requestDir="/tmp/requestDir"