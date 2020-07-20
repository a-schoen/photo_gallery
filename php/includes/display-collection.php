<?php 
$coll = new Collection();
$image_list = $coll->get_all_photos();
?>
<?php if(!isset($_POST['update_gallery'])): ?>
	<form class="image-collection-form" action="" method="POST">
		<div id="image-group">
			<?php foreach($image_list as $image_id): ?>	
				<?php
					$image = new Photo();
					$img_info = $image->get_single_photo($image_id);
					$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];
					
					if($img_info['photo_public'] == '1'){
						$public = "selected";
						$not_public = "";
					}else{
						$public = "";
						$not_public = "selected";
					}

					$orientation = $img_info['photo_orient'];
				?>		
				<div class="image-box has-text">
				<div class="image-box-content">
					<a href="<?php echo PUBLIC_DIR; ?>image.php?id=<?php echo $image_id; ?>">
						<img class="image-box-img <?php echo $orientation; ?>" alt="<?php echo $img_info['photo_alt']; ?>" src="<?php echo $url; ?>">
					</a>
						<div class="img-form img-checkbox-delete">
							<label>Löschen
								<input type="checkbox" name="to_delete[]" value="<?php echo $image_id;?>" >
							</label>
						</div>
						<select class="img-form img-select-public" name="public[]">
							<option value="1" <?php echo $public; ?> >sichtbar</option>
							<option value="0" <?php echo $not_public; ?> >privat</option>
						</select>
					</div>
				</div>
			<?php endforeach; ?>
		</div>	
		<input type="submit" name="update_gallery" value="Sammlung aktualisieren">			
	</form>	
<?php else: ?>
	<?php
		//assemble array of public/private settings
		$new_public_array = $_POST['public'];
		
		//assemble array of photos to delete
		if(!isset($_POST['to_delete'])){
			$delete_array = [];
		}else{
			$delete_array = $_POST['to_delete'];
		}
		//call update collection function
		$update = $coll->update_collection($image_list, $new_public_array, $delete_array);
		
		if($update){
			echo 'Sammlung wird aktualisiert';
			echo '<script>window.location.href = "' . PUBLIC_DIR . 'gallery.php?id=1"</script>';
		}else{
			//print out errors
			$coll->printout();
		}
	?>
<?php endif; ?>
