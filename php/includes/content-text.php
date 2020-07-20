<?php 
$page = new Page();

$page_info= $page->get_current_page_details(); 
$page_name = $page_info['page_name'];
$page_text = $page_info['page_text'];

if(strlen($page_text) > 200){
	$long = 'class="longtext"';
}else{
	$long = "";
}
?>
<header id="page-title">
	<h2><?php echo $page_info['page_title']; ?></h2>
</header>
<article id="page-content">
	<p <?php echo $long; ?>>
		<?php echo $page_text; ?>
	</p>
	<?php if($is_admin): ?>
		<button class="admin-btn" onclick="window.location.href='<?php echo PUBLIC_DIR . $page_info['page_name']; ?>.php?edit'">Seitentext bearbeiten</button>
	<?php endif; ?>
</article>


