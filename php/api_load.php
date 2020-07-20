<?php
//production server 
//$load_path = $_SERVER['DOCUMENT_ROOT'] . '/../php/classes/';
//$load_path = realpath($load_path) . '/';

//localhost
$load_path = realpath(__DIR__) . "/classes/";

//get the class definitions
require_once($load_path . 'main.php');
require_once($load_path . 'db_connect.php');
require_once($load_path . 'settings.php');
require_once($load_path . 'login.php');
require_once($load_path . 'page.php');
require_once($load_path . 'photo.php');
require_once($load_path . 'upload.php');
require_once($load_path . 'collection.php');
require_once($load_path . 'gallery.php');
require_once($load_path . 'email.php');