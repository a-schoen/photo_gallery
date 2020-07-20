<?php 
$gallery_id = intval($_GET['id']);
$gallery = new Gallery();
$gallery_info = $gallery->get_gallery_details($gallery_id);
?>
<header id="page-title">
	<h2><?php echo $gallery_info['gallery_title']; ?></h2>
</header>
<article id="page-content">
	<p>
		<?php echo $gallery_info['gallery_desc']; ?>
	</p>
	<?php if($is_admin): ?>
		<button class="edit-btn admin-btn">Galerie-Details bearbeiten</button>
	<?php endif; ?>
</article>