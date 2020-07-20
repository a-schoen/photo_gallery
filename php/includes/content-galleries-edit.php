<?php if(!isset($_POST['submit'])): ?>
	<header id="page-title">
		<h2>Galerie hinzufügen:</h2>
	</header>
	<article id="page-content">
		<form class="admin-form" action="" method="post">
			<label for="gallery_title">Galerie-Titel:</label><br>
			<input type="text" name="gallery_title" id="gallery_title" maxlength="50">
			<br>
			<label for="gallery_desc">Galerie-Beschreibung:</label><br>
			<textarea name="gallery_desc" id="gallery_desc" maxlength="200"></textarea>
			<br>
			<label for="gallery_public">öffentlich anzeigen:
				<select id="gallery_public" name="gallery_public">
					<option value="1">ja</option>
					<option value="0">nein</option>
				</select>
			</label><br>
			<input class="admin-btn" type="submit" name="submit" value="Daten aktualisieren">
		</form>
	</article>
<?php else: ?>
	<?php
		$gallery = new Gallery();
		
		$add = $gallery->add_new_gallery($_POST);
			
		if(!$add){
			$gallery->printout();
		}else{
			echo '<script>window.location.href="' . PUBLIC_DIR . 'galleries.php?add"</script>';
		}
	?>
<?php endif; ?>

