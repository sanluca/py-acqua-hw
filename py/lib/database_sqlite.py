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
import sqlite3 as lite
import sys,os


class Mydata():
    def __init__(self):
        self.db_real_time = '/var/tmp/real_time.db'
        db_is_new = not os.path.exists(self.db_real_time)
        conn = lite.connect(self.db_real_time)
        conn.close()
        
        self.db_configure = '/media/data/py-acqua-hw/py/db/configure.db'
        db_is_new = not os.path.exists(self.db_configure)
        conn = lite.connect(self.db_configure)
        conn.close()
        
        self.db_storage = '/media/data/py-acqua-hw/py/db/storage.db'
        db_is_new = not os.path.exists(self.db_storage)
        conn = lite.connect(self.db_storage)
        conn.close()
        
    def db_con_real(self):
        self.con_real_time = lite.connect(self.db_real_time)
        return self.con_real_time.cursor()
    
    def db_con_conf(self):
        self.con_configure = lite.connect(self.db_configure)
        return self.con_configure.cursor()
    
    def db_con_stor(self):
        self.con_storage = lite.connect(self.db_storage)
        return self.con_storage.cursor()
    
    def create_db(self):
        
        cursor=self.db_con_real()
        cursor.execute("create table if not exists real_time (Id INTEGER PRIMARY KEY, temp_h2o FLOAT, ph FLOAT, pulse INT);")
        cursor.execute("insert into real_time (temp_h2o, ph, pulse) values (%f , %f, %d)" %(0,0,0))
        self.con_real_time.commit()
        cursor=self.db_con_stor()
        cursor.execute("create table if not exists storage (Id INTEGER PRIMARY KEY, temp_h2o FLOAT, ph FLOAT, pulse INT, hour INT, day INT, month INT, year INT, lu INT);")
        self.con_storage.commit()
        cursor=self.db_con_conf()
        cursor.execute("create table if not exists configure (Id INTEGER PRIMARY KEY, label VARCHAR(150), start_hour INT, start_min INT, stop_hour INT, stop_min INT, rele1 INT, rele2 INT, rele3 INT, rele4 INT, manual INT, calendar INT, sunrise INT);")
        self.con_configure.commit()
        
    def populate_db(self):
        self.con_real_time.execute("insert into real_time (temp_h2o, ph, pulse) values (%f , %f, %d)" %(0,0,0))
        self.con_storage.execute("insert into storage (temp_h2o, ph, pulse, hour, day, month, year, lu) values (%f, %f, %d, %d, %d, %d, %d, %d)" %(0,0,0,0,0,0,0,0))
        self.con_configure.execute("insert into configure (label, start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise) values (%s,%d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d)" %(0,0,0,0,0,0,0,0,0,0,0,0))
        self.con_real_time.commit()
        self.con_storage.commit()
        self.con_configure.commit()
        
    def delete_table(self):
        self.con_real_time.execute("drop table if exists real_time")
        self.con_storage.execute("drop table if exists storage")
        self.con_configure.execute("drop table if exists configure")
        
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
        #r=self.con_real_time.store_result()
        self.con_real_time.close()
        #for row in r.fetch_row(0):
            #return row
			
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
        #r=self.con_configure.store_result() #rende disponibili i risultati
        self.con_configure.close()
        #for x in r.fetch_row(0):
        #x=r.fetch_row(0)
        #return x
        

    #id, uid , m ,d ,y ,start_ '00:00:00',end '00:00:00',title ,text       
    def view_calendar(self,m,d,y):
        self.db.query("select * from pec_mssgs where m='%s' and d='%s' and y='%s'" %(m,d,y))
        r=self.db.store_result()
        results=r.fetch_row(0)
        return results
    
    def view_calendarix(self,month,day,year):
        self.db.query("select * from calendar_events where month='%s' and day='%s' and year='%s'" %(month,day,year))
        r=self.db.store_result()
        results=r.fetch_row(0)
        return results
    
    def delete_row_calendar(self,day,month,year):
        self.db.query("delete from calendar where day=%d and month=%d and year=%d" % (day,month,year))
