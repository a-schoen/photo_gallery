<?php
//prod server
//$php_path = $_SERVER['DOCUMENT_ROOT'] . '/../php/';
//$php_path = realpath($php_path) . '/';

//local server
$php_path = $_SERVER['DOCUMENT_ROOT'] . 'php/';

include($php_path . 'get_slider_data.php');
