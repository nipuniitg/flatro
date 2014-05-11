<?php 
 // Connects to Our Database 
 $host = '127.0.0.1';
 $username = 'root';
 $passwd = '';
 $con = mysql_connect($host, $username, $passwd) or die(mysql_error()); 
 mysql_select_db("tryncee") or die(mysql_error()); 
 
 ?> 