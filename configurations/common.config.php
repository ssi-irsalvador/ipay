<?php
// Error display
ini_set('error_reporting', E_ALL &~ E_NOTICE);
ini_set('display_errors', true);

/**
 * define the dbconnectivity
 */
  define('SYSCONFIG_ISLOCALCONN',True);

/**
 * @var array Database credentials. Use user/pass/tnsname
 */

if(SYSCONFIG_ISLOCALCONN){
	define('SYSCONFIG_DBUSER', 'root');
	define('SYSCONFIG_DBPASS', '');
	define('SYSCONFIG_DBNAME', 'ipay_db');
	define('SYSCONFIG_DBHOST', 'localhost');
}else{
	define('SYSCONFIG_DBUSER', 'root');
	define('SYSCONFIG_DBPASS', '');
	define('SYSCONFIG_DBNAME', 'orangeipay_db');
	define('SYSCONFIG_DBHOST', '192.168.1.6');
}

/**
 * Define the Project Title
 */
define('SYSCONFIG_TITLE','iPAY');
define('SYSCONFIG_COMPANY','Company ABC - Demo');

/**
 * @var  string Default Theme
 */
define('SYSCONFIG_THEME', 'default');
//define('SYSCONFIG_THEME', 'oldtheme');


function printa($arr = array()){
	print "<pre>";
	print_r($arr);
	print "</pre>";
}
?>