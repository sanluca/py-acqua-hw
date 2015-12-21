Readme for ldap integration for LuxCal 410L:
-------------------------------------------

Files:
  ldaptools.php
  - contains tools for ldap setup and user import
  - goes into luxcal410L-toolbox.zip
  - should be handled with same precautions as lctools.php
   
  ldap.php
  - handles ldap authentication for imported users inside 
	  LuxCal
  - goes into the common/ folder
  
  login.php.diff
  - contains the necessary changes to pages/login.php
    to hook into ldap.php

  how_it_works.txt
  - contains a description how ldap integration works

Changes:
  ldaptools.php:
  - Made instructions far more understandable
  - Improved menu logic
  - Added support for querying LDAP servers not
    permitting anonymous queries for user list.
    
Martin Dziobek, HLRS Uni Stuttgart, dziobek@hlrs.de
7/2014
