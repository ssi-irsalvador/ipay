<?php
include_once(SYSCONFIG_CLASS_PATH."admin/application.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/appauth.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/sync.class.php");

Application::app_initialize();
$dbconn = Application::db_open();

$sync = new clsSync($dbconn);


$sync->synchronize();