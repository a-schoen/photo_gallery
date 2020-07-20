<?php
ini_set('display_errors', 1);

require_once('config.php');
require_once('api_load.php');

if(isset($_GET['gallery_id'])){
	
	$gallery_id = $_GET['gallery_id'];
	
	$gallery = new Gallery();
	
	$data = $gallery->get_slider_data($gallery_id);
	
	echo $data;
	
} else {
	echo 'failed to fetch data. Gallery id missing';
}