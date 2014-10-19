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
import _mysql


class Mydata():
    def __init__(self):
    
        self.db=_mysql.connect(host="127.0.0.1",db="acqua",user="root",passwd="root")
        
    def database_conn(self):
        self.db=_mysql.connect(host="127.0.0.1",db="acqua",user="root",passwd="root")
        
    def create_db(self):
        self.db.query("""create table if not exists real_time (Id INT PRIMARY KEY AUTO_INCREMENT, temp_h2o FLOAT, ph FLOAT, pulse INT);""")
        self.db.query("""create table if not exists work (Id INT PRIMARY KEY AUTO_INCREMENT, temp_h2o FLOAT, ph FLOAT, pulse INT, hour INT, day INT, month INT, year INT, lu INT);""")
        self.db.query("""create table if not exists configure (Id INT PRIMARY KEY AUTO_INCREMENT, label VARCHAR(150), start_hour INT, start_min INT, stop_hour INT, stop_min INT, rele1 INT, rele2 INT, rele3 INT, rele4 INT, manual INT, calendar INT, sunrise INT);""")
        self.db.query("""create table if not exists email(Id INT PRIMARY KEY AUTO_INCREMENT,email char(40), activ NUMERIC);""")
        self.db.query("""create table if not exists pec_mssgs (id mediumint(5) unsigned NOT NULL auto_increment, uid tinyint(3) unsigned NOT NULL default '0', m tinyint(2) NOT NULL default '0',d tinyint(2) NOT NULL default '0',y smallint(4) NOT NULL default '0',start_time time NOT NULL default '00:00:00',end_time time NOT NULL default '00:00:00',title varchar(50) NOT NULL default '',text text NOT NULL,PRIMARY KEY  (id)) ENGINE=MyISAM; """)
        self.db.query("""create table if not exists pec_users (uid smallint(6) NOT NULL auto_increment,username char(15) NOT NULL default '',password char(32) NOT NULL default '',fname char(20) NOT NULL default '',lname char(30) NOT NULL default '0',userlevel tinyint(2) NOT NULL default '0',email char(40) default NULL,PRIMARY KEY  (uid)) ENGINE=MyISAM; """)
        self.db.query("""create table if not exists calendar_users (user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,username VARCHAR(30) NOT NULL,password VARCHAR(30) NOT NULL,description TEXT,group_id INT(11) NOT NULL ) ENGINE = MYISAM;""")
        self.db.query("""create table if not exists calendar_cat (cat_id int(11) NOT NULL auto_increment,cat_name varchar(150) NOT NULL default '',PRIMARY KEY  (cat_id),UNIQUE KEY cat_id (cat_id)) ENGINE=MyISAM;""")
        self.db.query("""create table if not exists calendar_events (id int(11) NOT NULL auto_increment,timestamp timestamp NOT NULL,title varchar(255) NOT NULL default '',description text NOT NULL,url varchar(100) NOT NULL default '',email varchar(120) NOT NULL default '',cat tinyint(2) NOT NULL default '0',starttime varchar(8) NOT NULL default '',endtime varchar(8) NOT NULL default '',day tinyint(2) NOT NULL default '0',month smallint(2) NOT NULL default '0',year smallint(4) NOT NULL default '0',approved tinyint(1) NOT NULL default '0',priority tinyint(1) NOT NULL default '0',user varchar(30) NOT NULL default '',timezone varchar(5) NOT NULL default '',PRIMARY KEY (id),UNIQUE KEY id (id)) ENGINE=MyISAM;""")
        self.db.query("""create table if not exists calendar_param (name VARCHAR(150) NOT NULL,value VARCHAR(150)) ENGINE = MYISAM; """)

    def populate_db(self):
        self.db.query("insert into real_time (temp_h2o, ph, pulse) values (%f , %f, %d)" %(0,0,0))
        self.db.query("insert into work (temp_h2o, ph, pulse, hour, day, month, year, lu) values (%f, %f, %d, %d, %d, %d, %d, %d)" %(0,0,0,0,0,0,0,0))
        self.db.query("insert into configure (label, start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise) values (%s,%d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d)" %('label',0,0,0,0,0,0,0,0,0,0,0))
        self.db.query("insert into email (email, activ) values ('%s',%d)" %('sanluca78@gmail.com', 0))
        self.db.query("insert into pec_users (username, password, fname, lname, userlevel, email) VALUES ('%s','%s','%s','%s','%s','%s')" %('luca', 'luca', 'default', 'user', 2, ''))
        self.db.query("insert into calendar_users (user_id, username, password, description, group_id) VALUES (null, 'luca', 'wekcBDDymwQBs', '', '0')")
        self.db.query("insert into calendar_cat VALUES (1,'General')")
        self.db.query("insert into calendar_param (name, value) VALUES ('session_timeout', '3600')")
        
    def delete_table(self):
        self.db.query("drop table if exists real_time")
        self.db.query("drop table if exists work")
        self.db.query("drop table if exists configure")
        self.db.query("drop table if exists calendar")
        self.db.query("drop table if exists bluetooth")
        self.db.query("drop table if exists email")
        
    def database_close(self):
        self.db.close()
    
    def riavvio_db(self):
        self.database_close()
        self.database_conn()
        
	
    def save_real_time(self,temp_h2o,ph):
        self.db.query("insert into real_time values (?,?,?)",(None, temp_h2o, ph))
        
    def update_real_time(self,par,value):
        self.db.query("update real_time set %s=%f where id = 1" %(par,value))
        
    def view_real_time(self):
        self.db.query("select * from real_time where id = 1") 
        r=self.db.store_result()
        for row in r.fetch_row(0):
            return row
			
        #(pulse, hour, day, month, year)
    def save_work(self,temp_h2o, ph, pulse,hour,day,month,year,lu):
        self.db.query("insert into work (temp_h2o,ph,pulse, hour,day,month,year,lu) values (%f,%f,%d,%d,%d,%d,%d,%d)" %(temp_h2o,ph,pulse, hour,day,month,year,lu))
		
    def update_work(self,par,value):
        self.db.query("update work SET %s=%f where id = 1" %(par,value))
    
    def view_work(self):
        self.db.query("select * from work where id = 1")
        r=self.db.store_result() #rende disponibili i risultati
        for x in r.fetch_row(0):
            return x

	#(start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise)
    def save_configure(self,start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise):
        self.db.query("insert into configure values (?,?,?,?,?,?,?,?,?,?,?,?)" %(None, start_hour, start_min, stop_hour, stop_min, rele1, rele2, rele3, rele4, manual, calendar, sunrise))

    def update_configure(self,par,value):
        self.db.query("update configure SET %s=%f where id = 1" %(par,value))

    def view_configure(self):
        self.db.query("select * from configure")
        r=self.db.store_result() #rende disponibili i risultati
        #for x in r.fetch_row(0):
        x=r.fetch_row(0)
        return x
		
    def update_email(self,par,value):
        self.db.query("update email SET %s=%d where id = 1" %(par,value))

    def view_email(self):
        self.db.query("select * from email where id = 1")
        r=self.db.store_result() #rende disponibili i risultati
        results=r.fetch_row(0)
        for x in results:
            return x

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
