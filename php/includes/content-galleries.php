<?php 
$page = new Page();
$page_info = $page->get_current_page_details();
?>

<header id="page-title">
	<h2>Galerien</h2>
</header>
<article id="page-content">
	<p>
		<?php echo $page_info['page_text']; ?>
	</p>
	<?php if($is_admin): ?>
		<a href="<?php echo PUBLIC_DIR; ?>galleries.php?add"><button class="admin-btn">Neue Galerie</button></a>
	<?php endif; ?>
</article>
