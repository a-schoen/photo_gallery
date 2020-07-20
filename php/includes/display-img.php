<?php
ini_set('display_errors', 1);
$main_id = intval($_GET['id']);

if(isset($_GET['in_gallery']) && $_GET['in_gallery'] == intval($_GET['in_gallery'])){ 
	
	$in_gallery = true;
	$gallery_id = intval($_GET['in_gallery']);
	
	$gallery = new Gallery();
	
	$get_gallery = $gallery->get_photo_ids($gallery_id);
	$ordered_gallery = $gallery->order_display($gallery_id, $get_gallery);
	
	$slider_list = $gallery->get_slider_data($gallery_id);
	
	//get the main photos relative place in the gallery 
	$absolute_pos_array = array_values($ordered_gallery);
	$main_order_nr = array_keys($absolute_pos_array, $main_id)[0] + 1;
		
}else{
	$in_gallery = false;
	$gallery_id = "";
	$main_order_nr ="";
}

$photo= new Photo();

$photo_info = $photo->get_single_photo($main_id);

$url = IMG_DIR . $photo_info['photo_url'];

$orientation = $photo_info['photo_orient'];
?>
<div class="image-display" data-gallery-id="<?php echo $gallery_id; ?>">
	<img data-start-id="<?php echo $main_id; ?>" data-order-nr="<?php echo $main_order_nr; ?>" class="slider-img img-view <?php echo $orientation; ?>" src="<?php echo $url; ?>" alt="<?php echo $photo_info['photo_alt']; ?>">
	<?php if($in_gallery): ?>
		<div id="image-click-text" class="showing">
			Vollbild-Slider öffnen
		</div>
		<button class="fullview-btn slide-btn slide-forward">&gt;</button>
		<button class="fullview-btn slide-btn slide-back">&lt;</button>
		<button id="play" class="fullview-btn">Slideshow</button>
	<?php endif; ?>
	<button class="fullview-btn gallery-back-btn">X</button>
</div>
<?php if($in_gallery): ?>
	<?php $gallery_remaining = array_diff($ordered_gallery, [$main_id]); ?>
	<div id="showcase-row">
		<div id="image-group">
			<?php foreach($gallery_remaining as $image_id): ?>
				<?php
					$img_info = $photo->get_single_photo($image_id);
					$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];
					$orientation = $img_info['photo_orient'];
					$order_nr = array_keys($ordered_gallery, $image_id)[0] + 1;
				?>		
				<div class="image-box">
					<a href="<?php echo PUBLIC_DIR; ?>image.php?id=<?php echo $image_id; ?>&amp;in_gallery=<?php echo $gallery_id; ?>">
						<img data-order-nr="<?php echo $order_nr; ?>" class="image-box-img <?php echo $orientation; ?>" alt="<?php echo $img_info['photo_alt']; ?>" src="<?php echo $url; ?>">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

