<?php 
$id = intval($_GET['id']);

$page = new Page();

$page_type = $page->find_page_name();

if($page_type == 'gallery'){
	
	$gallery = new Gallery();
	
	$delete = $gallery->delete_gallery($id);
	
	$location = "galleries.php";
	
	$print_errors = $gallery->printout();
	
}
elseif($page_type == 'image'){
	
	$photo = new Photo();
	
	$delete = $photo->delete_photo($id);
	
	$print_errors = $photo->printout();
	
	$location = "gallery.php?id=1";
}

if($delete){
	$path = PUBLIC_DIR . $location; 
	echo '<script>window.location.href="' . $path . '";</script>';
}else{
	if($page_type == 'gallery'){
	echo 'here';
		$gallery->printout();
	}
	else if($page_type == 'photo'){
		$photo->printout();
	}
}