<?php 
session_name("ID");
session_start();

// production server
//$php_path = realpath($_SERVER['DOCUMENT_ROOT'] . '/../php') . '/';

//localhost
$php_path = realpath(__DIR__) . "/php" . "/";

include($php_path . 'load.php');

$login = new Login();

$page_access = $login->page_access(); 

if(!$page_access){
	include(INC_DIR . 'login-visitor.php');
}else{
	
	include( INC_DIR . 'pageheader.php' );
	
	include( INC_DIR . 'main.php' );
	
	include( INC_DIR . 'pagefooter.php' );
	
}