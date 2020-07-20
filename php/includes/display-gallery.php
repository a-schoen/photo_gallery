<?php 
$gallery_id = intval($_GET['id']);
	
$gallery = new Gallery();

$all_photos = $gallery->get_photo_ids($gallery_id);

$public_photos = $gallery->only_public_photos($all_photos);

?>
<?php if(!empty($public_photos)): ?>
	<?php $ordered = $gallery->order_display($gallery_id, $public_photos); ?>
	<div id="showcase-row">
		<div id="image-group">
		<?php foreach($ordered as $image_id): ?>	
			<?php
				$image = new Photo();
				$img_info = $image->get_single_photo($image_id);
				$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];
				$orientation = $img_info['photo_orient'];
			?>		
			<div class="image-box">
				<div class="image-box-content">
					<a href="<?php echo PUBLIC_DIR; ?>image.php?id=<?php echo $image_id; ?>&amp;in_gallery=<?php echo $gallery_id; ?>">
						<img class="image-box-img gallery-img <?php echo $orientation; ?>" alt="<?php echo $img_info['photo_alt']; ?>" src="<?php echo $url; ?>">
					</a>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
<?php else: ?>
	<span>Empty gallery</span>
<?php endif; ?>