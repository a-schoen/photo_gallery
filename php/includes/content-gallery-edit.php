<?php 
$gallery_id = intval($_GET['id']);

$gallery = new Gallery();
$gallery_info = $gallery->get_gallery_details($gallery_id);
?>
<?php if(!isset($_POST['submit'])): ?>
	<?php
		if($gallery_info['gallery_public'] == 1){
			$public = 'selected';
			$private = '';
		}else{
			$public = '';
			$private = 'selected';
		}	
	?>
	<header id="page-title">
		<h2><?php echo $gallery_info['gallery_title']; ?></h2>
	</header>
	<article id="page-content">
		<form class="admin-form" action="" method="post">
			<label for="gallery_title">Galerie-Titel:</label><br>
			<input type="text" name="gallery_title" id="gallery_title" maxlength="50" value="<?php echo $gallery_info['gallery_title']; ?>">
			<br>
			<label for="gallery_desc">Galerie-Beschreibung:</label><br>
			<textarea name="gallery_desc" id="gallery_desc" maxlength="200"><?php echo $gallery_info['gallery_desc']; ?></textarea>
			<br>
			<label for="gallery_public">öffentlich anzeigen:
				<select id="gallery_public" name="gallery_public">
					<option value="1" <?php echo $public; ?>>ja</option>
					<option value="0" <?php echo $private; ?>>nein</option>
				</select>
			</label><br>
			<input class="admin-btn" type="submit" name="submit" value="Daten aktualisieren">
		</form>
	</article>	
<?php else: ?>
	<?php
		$edit = $gallery->edit_gallery($gallery_id, $_POST);
		
		if($edit){
			echo '<script>window.location.href="' . PUBLIC_DIR . 'gallery.php?id=' . $gallery_id . '"</script>';
		}else{
			$gallery->printout();
		}
	?>
<?php endif; ?>
<button class="delete-this admin-btn">Galerie löschen</button>
<button class="sort-this admin-btn">Bilder-Reihenfolge ändern</button>
<button onclick='window.location.href=" <?php echo PUBLIC_DIR; ?>gallery.php?id=<?php echo $gallery_id; ?>"'>Galerie ansehen</button>
