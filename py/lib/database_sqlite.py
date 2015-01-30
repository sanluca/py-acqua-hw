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
import sqlite3 as lite
import sys,os


class Mydata():
    def __init__(self):
        self.db_real_time = '/var/tmp/real_time.db'
        db_is_new = not os.path.exists(self.db_real_time)
        conn = lite.connect(self.db_real_time)
        if db_is_new:
            conn.execute("create table if not exists real_time (Id INTEGER PRIMARY KEY, temp_h2o FLOAT, ph FLOAT, pulse INT);")
            conn.execute("insert into real_time (temp_h2o, ph, pulse) values (%f , %f, %d)" %(0,0,0))
        conn.commit()
        conn.close()
        
        self.db_configure = '/media/data/py-acqua-hw/py/db/configure.db'
        db_is_new = not os.path.exists(self.db_configure)
        conn = lite.connect(self.db_configure)
        if db_is_new:            
            conn.execute("create table if not exists configure (Id INTEGER PRIMARY KEY, label VARCHAR(150), start_hour INT, start_min INT, stop_hour INT, stop_min INT, manual INT, calendar INT, sunrise INT, temperature INT, ph INT, setemp FLOAT, setph INT);")
            conn.execute("create table if not exists sunrise (Id INTEGER PRIMARY KEY, long FLOAT, lat FLOAT, timezone VARCHAR(150), duelamp INT, shifthour INT);")
            conn.execute("create table if not exists calph (Id INTEGER PRIMARY KEY, offset FLOAT, range FLOAT);")
            conn.execute("insert into sunrise (long, lat, timezone,duelamp,shifthour) values ('%s' , '%s' , '%s' , %d , %d)" %('12.6500','45.9500','Europe/Rome',0,0))
            conn.execute("insert into calph (offset, range) values ('%f' , '%f')" %(0,0))
            a=0
            while a<4:
                conn.execute("insert into configure (label, start_hour, start_min, stop_hour, stop_min, manual, calendar, sunrise, temperature, ph,setemp,setph) values ('%s',%d, %d, %d, %d, %d, %d, %d, %d, %d,%f,%d)" %('label',0,0,0,0,0,0,0,0,0,0,0))
                a=a+1
        conn.commit()
        conn.close()
        command=("chmod 777 /media/data/py-acqua-hw/py/db/configure.db")
        os.system(command)
        
        self.db_storage = '/media/data/py-acqua-hw/py/db/storage.db'
        db_is_new = not os.path.exists(self.db_storage)
        conn = lite.connect(self.db_storage)
        if db_is_new:
            conn.execute("create table if not exists storage (Id INTEGER PRIMARY KEY, temp_h2o FLOAT, ph FLOAT, pulse INT, hour INT, day INT, month INT, year INT, lu INT);")
        conn.commit()
        conn.close()
        command=("chmod 777 /media/data/py-acqua-hw/py/db/storage.db")
        os.system(command)
        
        self.db_calendar = '/media/data/py-acqua-hw/luxcal410-calendar/db/mycal.cdb'
        
    def db_con_real(self):
        self.con_real_time = lite.connect(self.db_real_time)
        return self.con_real_time.cursor()
    
    def db_con_conf(self):
        self.con_configure = lite.connect(self.db_configure)
        return self.con_configure.cursor()
    
    def db_con_stor(self):
        self.con_storage = lite.connect(self.db_storage)
        return self.con_storage.cursor()
    
    def db_con_calendar(self):
        self.con_calendar = lite.connect(self.db_calendar)
        return self.con_calendar.cursor()
        
    def database_close(self):
        self.cur_real_time.close()
        self.cur_storage.close()
        self.cur_configure.close()
    
    def riavvio_db(self):
        self.database_close()
        self.database_conn()
        
    def save_real_time(self,temp_h2o,ph):
        cursor = self.db_con_real()
        cursor.execute("insert into real_time values (?,?,?)",(None, temp_h2o, ph))
        self.con_real_time.commit()
        
    def update_real_time(self,par,value):
        cursor = self.db_con_real()
        cursor.execute("update real_time set %s=%f where id = 1" %(par,value))
        self.con_real_time.commit()
        
    def view_real_time(self):
        cursor = self.db_con_real()
        cursor.execute("select * from real_time where id = 1") 
        return cursor.fetchone()
        self.con_real_time.close()
			
        #(pulse, hour, day, month, year)
    def save_storage(self,temp_h2o, ph, pulse,hour,day,month,year,lu):
        cursor = self.db_con_stor()
        cursor.execute("insert into storage (temp_h2o,ph,pulse, hour,day,month,year,lu) values (%f,%f,%d,%d,%d,%d,%d,%d)" %(temp_h2o,ph,pulse, hour,day,month,year,lu))
        self.con_storage.commit()
        
    def update_storage(self,par,value):
        self.con_storage.execute("update storage SET %s=%f where id = 1" %(par,value))
        self.con_storage.commit()
    
    def view_storage(self):
        self.con_storage.execute("select * from storage where id = 1")
        self.con_storage.commit()
        r=self.self.con_storage.store_result() #rende disponibili i risultati
        for x in r.fetch_row(0):
            return x
        self.con_storage.close()

	#(start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise)
    def save_configure(self,start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise):
        self.con_configure.execute("insert into configure values (?,?,?,?,?,?,?,?,?,?,?,?)" %(None, start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise))
        self.con_configure.commit()

    def update_configure(self,par,value):
        self.con_configure.execute("update configure SET %s=%f where id = 1" %(par,value))
        self.con_configure.commit()

    def view_configure(self):
        cursor = self.db_con_conf()
        cursor.execute("select * from configure")
        return cursor.fetchall()
        self.con_configure.close()

    def view_sunrise(self):
        cursor=self.db_con_conf()
        cursor.execute("select * from sunrise where id = 1")
        return cursor.fetchone()
        self.con_configure.close()

    def update_sunrise(self,par,value):
        cursor = self.db_con_conf()
        cursor.execute("update sunrise set %s=%f where id = 1" %(par,value))
        self.con_configure.commit()
    
    def view_calendar(self,sDate,eDate):
        cursor=self.db_con_calendar()
        cursor.execute("select * from events where sDate<='%s' and eDate>='%s'" %(sDate,eDate))
        return cursor.fetchall()
        self.con_calendar.close()
        
    def view_calph(self):
        cursor=self.db_con_conf()
        cursor.execute("select * from calph where id = 1")
        return cursor.fetchone()
        self.con_configure.close()
        
    def update_calph(self,par,value):
        cursor = self.db_con_conf()
        cursor.execute("update calph set %s=%f where id = 1" %(par,value))
        self.con_configure.commit()
