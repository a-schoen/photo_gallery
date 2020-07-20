<?php 
$photo_id = intval($_GET['id']);
$photo = new Photo();
$photo_info = $photo->get_single_photo($photo_id);
?>
<header id="page-title">
	<h2><?php echo $photo_info['photo_title']; ?></h2>
</header>
<article id="page-content">
	<p>
		<?php echo $photo_info['photo_desc']; ?>
	</p>
	<?php if($is_admin): ?>
		<button class="admin-btn edit-btn">Foto-Details bearbeiten</button>
	<?php endif; ?>
</article>