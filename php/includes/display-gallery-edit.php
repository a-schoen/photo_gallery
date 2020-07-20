<?php 
//get gallery id
$gallery_id = intval($_GET['id']);

//get all images
$coll = new Collection();
$image_list = $coll->get_all_photos();

//get images currently included in this gallery
$gallery = new Gallery();
$current_photos = $gallery->get_photo_ids($gallery_id);
?>
<?php if(!isset($_POST['update_gallery'])): ?>
	<form class="gallery-images" action="" method="POST">
		<div id="image-group">
			<div class="instruction">
				<small>Häkchen setzen oder entfernen, um Fotos zur Galerie hinzuzufügen bzw. herauszunehmen</small>
			</div>
			<?php foreach($image_list as $image_id): ?>	
				<?php
					$image = new Photo();
					$img_info = $image->get_single_photo($image_id);
					$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];
					
					if(!empty($current_photos) && in_array($image_id, $current_photos)){
						$checked = "checked";
					}else{
						$checked = "";
					}
					
					$orientation = $img_info['photo_orient'];
				?>		
				<div class="image-box has-text">
					<div class="image-box-content">
						<img class="image-box-img <?php echo $orientation; ?>" alt="<?php echo $img_info['photo_alt']; ?>" src="<?php echo $url; ?>">
						
						<div class="img-form img-checkbox-gallery">
							<input type="checkbox" name="photos[]" value="<?php echo $image_id; ?>" <?php echo $checked; ?> >
						</div>				
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<input  class="display-submit admin-btn" type="submit" name="update_gallery" value="Galerie aktualisieren">
	</form>	
<?php else: ?>
	<?php
		if(isset($_POST['photos'])){
			$updated_photos = $_POST['photos'];
		
		}else{
			$updated_photos = [];
		}
		
		$update_bridge = $gallery->edit_gallery_contents($gallery_id, $current_photos, $updated_photos);
		
		if(!$update_bridge){
		echo 'here';
			$gallery->printout();
		}else{
			$path = PUBLIC_DIR . 'gallery.php?id=' . $gallery_id;
			echo '<script>window.location.href="' . $path . '";</script>';
		}
	?>
<?php endif; ?>

