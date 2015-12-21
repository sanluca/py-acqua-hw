#!/usr/bin/python
# Copyright (c) 2013 Roger Light <roger@atchoo.org>
#
# All rights reserved. This program and the accompanying materials
# are made available under the terms of the Eclipse Distribution License v1.0
# which accompanies this distribution. 
#
# The Eclipse Distribution License is available at 
#   http://www.eclipse.org/org/documents/edl-v10.php.
#
# Contributors:
#    Roger Light - initial implementation
# This example shows how you can use the MQTT client in a class.
import sys,time
from threading import Thread
from database import *
from tools import *
import paho.mqtt.client as mqtt

class MyMQTTClass(Thread):
    db=Mydata()
    x=db.view_name()
    nome=str(x[1])
    power2=0
    power1=0
    
    def status_in(self):
        y = self.db.view_configure()
        for b in y:
            id=int(b[0])
            power=b[2]
            if id==1:
                self.power1=power
            if id==2:
                self.power2=power
    
    def mqtt_on_connect(self, mqttc, obj, flags, rc):
        #pass
        self._mqttc.subscribe("home/%s/luce" %self.nome)
        self._mqttc.subscribe("home/%s/posizione" %self.nome)
        self._mqttc.subscribe("home/%s/temperatura" %self.nome)
        self._mqttc.subscribe("home/%s/temperatura/impostata" %self.nome)
        self._mqttc.subscribe("home/%s/temperatura/minima" %self.nome)
        self._mqttc.subscribe("home/%s/ore/continue" %self.nome)
        self._mqttc.subscribe("home/%s/umidita" %self.nome)
        self._mqttc.subscribe("home/%s/vento" %self.nome)
        self._mqttc.subscribe("home/%s/enel" %self.nome)
    
    def mqtt_on_message(self, mqttc, obj, msg):
        #logCritical("topic %s mes %s" %(msg.topic,msg.payload))
        self.status_in()
        #logCritical("power1 %s power2 %s" %(self.power1,self.power2))
                    
        if msg.topic=="home/%s/luce" %self.nome:
            if str(msg.payload)=="1":
                if self.power1==0:
                    self.db.update_configure('power',1,1)
                else:
                    self.db.update_configure('power',0,1)
            elif str(msg.payload)=="2":
                if self.power2==0:
                    self.db.update_configure('power',1,2)
                else:
                    self.db.update_configure('power',0,2)
            
            else:
                self.db.update_configure('power',0,1)
                self.db.update_configure('power',0,2)
                    
        elif msg.topic=="home/%s/posizione" %self.nome:
            #logCritical("topic %s mes %s" %(msg.topic,msg.payload))
            if str(msg.payload)=="APRI":
                self.db.update_tent('mode',0)
                self.db.update_configure('power',1,1)
                self.db.update_configure('power',1,3)
                
            elif str(msg.payload)=="CHIUDI":
                #logCritical("dentrochiudi")
                self.db.update_tent('mode',0)
                self.db.update_configure('power',1,2)
                
            elif str(msg.payload)=="META":
                self.db.update_tent('mode',1)
                self.db.update_configure('power',1,1)
                self.db.update_configure('power',1,3)
            else:
                pass
        else:
            pass
        
        if msg.topic=="home/%s/temperatura/impostata" %self.nome:
            self.db.update_boiler('temp_imp',int(msg.payload))
            
        elif msg.topic=="home/%s/temperatura/minima" %self.nome:
            self.db.update_boiler('temp_min',int(msg.payload))
        
        elif msg.topic=="home/%s/ore/continue" %self.nome:
            self.db.update_boiler('hour_cont', int(msg.payload))
        else:
            pass
        
         
                
    def mqtt_on_publish(self, mqttc, obj, mid):
        pass
    
    def mqtt_on_subscribe(self, mqttc, obj, mid, granted_qos):
        pass
    
    def mqtt_on_log(self, mqttc, obj, level, string):
        pass
    
    def run(self):
        #logCritical("name %s" %self.nome)
        #clientid=None
        while True:
            try:
                self._mqttc = mqtt.Client()
                self._mqttc.on_message = self.mqtt_on_message
                self._mqttc.on_connect = self.mqtt_on_connect
                self._mqttc.on_publish = self.mqtt_on_publish
                self._mqttc.on_subscribe = self.mqtt_on_subscribe
                self._mqttc.connect("192.168.1.60", 1883, 60)
                self._mqttc.loop_forever()
            except:
                time.sleep(2)
