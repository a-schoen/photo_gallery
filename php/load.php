<?php 

require_once('config.php');

//prod server path
$path = ROOT . "/php/classes/";

//local server path
//$path = 'classes/';

//get the class definitions
require_once($path . 'main.php');
require_once($path . 'db_connect.php');
require_once($path . 'settings.php');
require_once($path . 'login.php');
require_once($path . 'page.php');
require_once($path . 'photo.php');
require_once($path . 'upload.php');
require_once($path . 'collection.php');
require_once($path . 'gallery.php');
require_once($path . 'email.php');



