<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_TeachPC = "localhost";
$database_TeachPC = "teachpcbd";
$username_TeachPC = "root";
$password_TeachPC = "";
$TeachPC = mysql_pconnect($hostname_TeachPC, $username_TeachPC, $password_TeachPC) or trigger_error(mysql_error(),E_USER_ERROR); 
?>