<?php 
$login = new Login();

$coll = new Collection();

if($is_admin){
	$all_galleries = $coll->get_all_galleries();
}else{
	$all_galleries = $coll->get_public_galleries();
}
?>
<div id="showcase-row">
	<div id="image-group" class="galleries">
	<?php foreach($all_galleries as $gallery_id): ?>
		<?php
			$gallery = new Gallery();
			
			// get random photo
			$photo_id = $gallery->get_random_pics($gallery_id, 1, []);
				
			if(!empty($photo_id)){
				
				$photo_id = $photo_id[0];
						
				//get the random photo's url and alt
				$photo = new Photo();
				$photo_info = $photo->get_single_photo($photo_id);
				
				$photo_alt = $photo_info['photo_alt'];
				$photo_url = THUMBS_DIR . 'tn_' . $photo_info['photo_url'];
				
				$orientation = $photo_info['photo_orient'];

				$gallery_image = '<img class="image-box-img ' . $orientation . '" alt="' . $photo_alt . '" src="' . $photo_url . '">';
			}else{
				$gallery_image = '<p class="image-box-alt">enthält noch keine Fotos</p><br>';
			}
			
			// get gallery title & desc
			$gallery_info = $gallery->get_gallery_details($gallery_id);
			
			$gallery_title = $gallery_info['gallery_title'];
			
			$public = $gallery_info['gallery_public'];
			
			if($public == 1){
				$show_private = '';
			}else{
				$show_private = '<div class="image-box-private"><span>nicht veröffentlicht</span></div>'; 
			}
		?>	
		<div class="image-box has-text">
			<div class="image-box-content">
			<a href="<?php echo PUBLIC_DIR; ?>gallery.php?id=<?php echo $gallery_id; ?>"> 
				<?php echo $gallery_image; ?>
				<div class="image-box-text">
					<h5 class="image-box-title">
						<?php echo $gallery_title; ?>
					</h5>
					<?php echo $show_private; ?>
				</div>	
			</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
