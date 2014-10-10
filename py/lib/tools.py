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
#from pysqlite2 import dbapi2 as sqlite
from string import *
import os,sys,time
import logging, logging.handlers
import tempfile

maxlogline=280

logger=None
debug=True

breakline="----------------MARK----------------"

weekdayname = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']

monthname = [None,
             'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
             'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

#TimeZone Functions

def getTimeZone():
    fname="/etc/timezone"
    if os.path.exists(fname):
        f=file(fname)
        timeZone=f.readline().strip().split("/")
        f.close()
    return timeZone

def getTimeZoneName():
    return time.tzname[time.daylight]

def setTimeZone(timeZone="Europe/Rome"):
    zoneFile="/usr/share/zoneinfo/%s" % timeZone
    
    if os.path.exists(zoneFile):
        os.symlink(zoneFile, "/etc/localtime.tmp")
        fname="/etc/timezone"
        f=file(fname,"w")
        f.write(timeZone)
        f.close()
        os.rename("/etc/localtime.tmp","/etc/localtime")

def getCountries(zone="Europe"):
    zoneDir="/usr/share/zoneinfo/%s" %zone
    countries = os.listdir(zoneDir)
    return countries

def isHolyday():
    #aggiungere pasqua natale etc 
    if time.localtime()[6]==6:
        result=True
    else: result=False
    return result
        
def date_time_string():
    """Return the current date and time formatted for a message header."""
    now = time.time()
    year, month, day, hh, mm, ss, wd, y, z = time.gmtime(now)
    s = "%s, %02d %3s %4d %02d:%02d:%02d GMT" % (
            self.weekdayname[wd],
            day, monthname[month], year,
            hh, mm, ss)
    return s

def createReinitFile(reinitFile):
    rf=file(reinitFile,"w")
    rf.close()
    
def createExternalRequest(requestDir,*args):
    requestFileBase = tempfile.mktemp(prefix="request",dir=requestDir)
    requestFileTmp=requestFileBase+".tmp"
    requestFile=requestFileBase+".req"
    if len(args):
        try:
            outfile = open(requestFileTmp,"w")
        except:
            logmessage("Errore nella creazione del file temporaneo")
        else:
            for i in range(len(args)):
                outfile.write("%s " % args[i])
            outfile.write("\n")
            outfile.close()
            os.rename(requestFileTmp,requestFile)

def initlog(filename,loglevel=logging.DEBUG):
    global logger
    logger = logging.getLogger("")
    logger.setLevel(loglevel)
    h1=logging.handlers.RotatingFileHandler(filename,mode="a",maxBytes=1048576,backupCount=5)
    logger.addHandler(h1)
    
def logDebug(message):
    global logger
    logger.debug(message)

def logInfo(message):
    global logger
    logger.info(message)

def logWarn(message):
    global logger
    logger.warn(message)

def logError(message):
    global logger
    logger.error(message)

def logCritical(message):
    global logger
    logger.critical(message)
    
def logmessage(message,level=logging.NOTSET):
    global logger
    logger.log(level,message)
        
def findNumber(stringa):
    number=""
    for i in stringa:
        if i in digits or i ==".":
            number+=i
        elif number:
            break
    return number

def parseDataline(stringa):
    """restituisce un dizionario con l'elenco dei valori
    stringa = rappresenta la linea dati ottenuta dal campionatore
    nosdi12 = flag che settato a 1(default) rimuove il numero
    della sonda sdi-12 dall'intestazione del campo di valore"""
    dati = {}
    elenco = split(stringa,",")
    for i in range (1,len(elenco)+1):
        if (i%2):
            parametro = elenco[i-1]
            dati[elenco[i-1]] = elenco[i]
    return dati

def toDataline(dizionario):
    """converte il dizionario passato in una stringa del tipo
    \"campo-1,valore-1,campo-2,valore-2,...,...,campo-n,valore-n\"
    ricalcolando il valore di checksum della stringa"""
    dataline=""
    for elemento  in dizionario.keys():
        if elemento == "CS":
            pass
        else:
            dataline += "%s,%s," %(elemento,dizionario[elemento])
    dataline+="CS,"
    dataline+="%s" % iscoChkSum(dataline)
    return dataline

def checkDataline(dataline):
    check = False
    try:
        dati = parseDataline(dataline,0)
        if dati.has_key("CS"):
            dataline = dataline[0:-len(dati["CS"])]
            checksum = iscoChkSum(dataline)
            try:
                validator = int(dati["CS"])
            except Exception, e:
                logmessage(str(e))
            if checksum == validator:
               check = True
        else:
            pass
    except Exception, e:
        logmessage(str(e))
    return check

def iscoChkSum(stringa):
    chksum = 0
    for char in stringa:
        chksum += ord(char)
    return chksum

def waitForZeroSec():
    while 1:
        if time.localtime()[5]==0:
            return
        else:
            time.sleep(0.20)


