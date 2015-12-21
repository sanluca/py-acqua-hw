# -*- coding: utf-8 -*-
import paho.mqtt.client as mqtt

class MyPub():
    
    def pub(self,topic,comando):
        
        try:
            mqttc = mqtt.Client()#("python_pub")
            mqttc.connect("192.168.1.60", 1883)
            mqttc.publish(topic, comando)
            mqttc.loop(2) #timeout = 2s
            mqttc.loop_stop()  #stop loop
            mqttc.disconnect()
            
        except:
            pass
