<?php
$photo_id = intval($_GET['id']);

$photo = new Photo();

$photo_info = $photo->get_single_photo($photo_id);
?>
<?php if(!isset($_POST['submit'])): ?>
	<header id="page-title">
		<h2>Foto bearbeiten</h2>
	</header>
	<article id="page-content">
		<form class="admin-form" action="" method="post">
			<label for="photo_title">Bild-Titel<br>
				<input type="text" name="photo_title" id="photo_title" maxlength="50" value="<?php echo $photo_info['photo_title']; ?>"  required>
			</label><br>
			<label for="photo_desc">Bild-Beschreibung
				<textarea name="photo_desc" id="photo_desc"><?php echo $photo_info['photo_desc']; ?></textarea>
			</label><br>
			<label for="photo_alt">Alt-Text<br>
				<input type="text" name="photo_alt" id="photo_alt" maxlength="50" value="<?php echo $photo_info['photo_alt']; ?>"  required>
			</label><br>
			<label for="photo_public">öffentlich anzeigen:
				<select id="photo_public" name="photo_public">
					<option value="1">ja</option>
					<option value="0">nein</option>
				</select>
			</label><br>
			<label for="gallery_list">Foto in den folgenden Galerien anzeigen:
				<?php $photo->make_checkbox_form($photo_id); ?>
			</label><br>
			<input class="admin-btn" type="submit" name="submit" value="Daten aktualisieren">
		</form>	
	</article>
<?php else: ?>
	<?php	
	//upload picture data
	$edit = $photo->edit_photo($photo_id, $_POST);
	
	if($edit){
		echo '<script>window.location.href ="' . PUBLIC_DIR . 'image.php?id=' . $photo_id . '"</script>';
	}
	else{
		$photo->printout();
	}
	?>
<?php endif; ?>
<button class="btn admin-btn delete-this">Foto löschen</button>
