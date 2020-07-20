<?php 
$gallery = new Gallery();
$exclude = [];
$random_pics = $gallery->get_random_pics('1', 10, $exclude);

$photo = new Photo();
$main_id = $random_pics[0];
$photo_info = $photo->get_single_photo($main_id);
$url = IMG_DIR . $photo_info['photo_url'];
$orientation = $photo_info['photo_orient'];
?>
<div id="showcase-img" class="image-display">
	<a href="<?php echo PUBLIC_DIR; ?>image.php?id=<?php echo $main_id; ?>&in_gallery=11"><img class="img-view <?php echo $orientation; ?>" src="<?php echo $url; ?>" alt="<?php echo $photo_info['photo_alt']; ?>"></a>
</div>
<div id="showcase-row">
	<div id="image-group">
	<?php 
		$image_list = $random_pics;
		unset($image_list[0]);
	?>
	<?php foreach($image_list as $image_id): ?>
		<?php
			$img_info = $photo->get_single_photo($image_id);
			$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];	
			$orientation = $img_info['photo_orient'];	
		?>		
		<div class="image-box">
	 		<div class="image-box-content">
			<a href="<?php echo PUBLIC_DIR; ?>image.php?id=<?php echo $image_id; ?>&in_gallery=11"> 
				<img class="image-box-img <?php echo $orientation; ?>" alt="<?php echo $img_info['photo_alt']; ?>" src="<?php echo $url; ?>">
			</a> 
			</div>
	 	</div>
	<?php endforeach; ?>	
	</div>
</div>


