<header id="page-title">
	<h2>Foto hochladen</h2>
</header>
<article id="page-content">

<?php if(!isset($_POST['submit'])): ?>
	
	<?php
		//get allowed file size
		$settings = new Settings();
		$allowed_size = $settings->get_current_settings()['max_file_size'];

		$coll = new Collection();	
	?>	
	<form class="admin-form" action="" method="post" enctype="multipart/form-data">
		<label for="title">Bild hinzufügen:</label><br>
		<div class="input-wrapper">
			<input id="upload_file" type="file" id="new_file" name="new_file" data-max-size="<?php echo $allowed_size; ?>" required>
		</div>
		<p id="show_file"></p>
		<br>
		<label for="photo_title">Bild-Titel</label><br>
			<input type="text" name="photo_title" id="photo_title"  maxlength="50" required>
		<br>
		<label for="photo_desc">Bild-Beschreibung:</label><br>
			<textarea name="photo_desc" id="photo_desc" maxlength="200"></textarea>
		<br>
		<label for="photo_alt">Alt-Text:</label><br>
			<input type="text" name="photo_alt" id="photo_alt" maxlength="50" required>
		<br>
		<label for="photo_public">öffentlich anzeigen:</label><br>
			<select id="photo_public" name="photo_public">
				<option value="1">ja</option>
				<option value="0">nein</option>
			</select>
		<br>
		<label for="gallery_list">Foto in den folgenden Galerien anzeigen:</label><br>
			<?php $coll->new_checkbox_form(); ?>
		<br>
		<input class="admin-btn" type="submit" name="submit" value="Foto hochladen"><br>
	</form>
<?php else: ?>	
	<?php 	
		$upload = new Upload($_POST, $_FILES['new_file']);
		
		$error = $_FILES['new_file']['error'];
		
		if($error == 0){	
			$upload_pic = $upload->upload_photo();
			
			if($upload_pic){
				echo 'Foto wird hochgeladen';
				echo '<script>window.location.href="' . PUBLIC_DIR . 'gallery.php?id=1"</script>';	
			}else{
				$upload->printout();
				
			?>
				<button class="admin-btn" onclick="window.location.href='<?php echo PUBLIC_DIR; ?>gallery.php?id=1'">zurück</button>
			<?php 
			}
		}else{
			$upload->show_upload_error($error);	
		}	
	?>
	<?php endif; ?>
</article>
