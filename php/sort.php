<?php 
ini_set('display_errors',1);
require_once('config.php');
require_once('api_load.php');

$json = file_get_contents('php://input');
$data = json_decode($json);

$new_list = $data->list;

$gallery_id = $data->gallery;

$gallery = new Gallery();

$update = $gallery->change_img_order($new_list, $gallery_id);

if($update){
	echo "Reihenfolge aktualisiert";
}else{
	echo "ung&uuml;ltige Eingabe";
}
