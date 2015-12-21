<?php
/*
=== LDAP FUNCTIONS ===

<A9> Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

/* this function tries to authenticate against
   an LDAP server given in the settings (use ldaptool.php to change).
   If sucessful, username and password are changed to those of the
   local calendar db, so a subsequent local auth succeeds, too.
*/

function auth_ldap(&$login,&$pass){
   global $set;

   $lpw='LDAP|'.$login;
   $stH = stPrep("SELECT `ID`,`name` FROM `users` WHERE `password` LIKE ?  AND `status` >= 0");
   stExec($stH,array($lpw));
   $row = $stH->fetch(PDO::FETCH_ASSOC); //fetch user details
   $stH = null;
   if ($row){                 
      // authenticate with ldap
      if($set['ldapEnv'] != ''){
         putenv($set['ldapEnv']);
      }
      if(!$conn=@ldap_connect($set['ldapURI'],$set['ldapPort'])){
         return("LDAP connection to ".$set['ldapURI']." Port ".$set['ldapPort']." failed");
      }
      ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, $set['ldapProto']);
      $binddn=$set['ldapUID'].'='.$login.','.$set['ldapDN'];
      if(!$ret=@ldap_bind($conn,$binddn,$pass)){
         return("LDAP bind using $binddn failed");
      }
      $pass= $lpw;
      $login=$row['name'];
   }
   return('');
}

?>
