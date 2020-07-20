<?php
$page = new Page();

$page_info= $page->get_current_page_details(); 

$page_name = $page_info['page_name'];
$page_title = $page_info['page_title']; 
$page_text = $page_info['page_text'];
?>
<?php if(!isset($_POST['submit'])): ?>
	<header id="page-title">
		<h2><?php echo $page_title; ?></h2>
	</header>
	<form action="" method="post">
		<label for="page_content">
			<textarea id="page_content" name="page_content"><?php echo $page_text; ?></textarea>
		</label>
		<br>
		<input class="admin-btn" type="submit" name="submit" value="Seite aktualisieren">
	</form>
<?php else: ?>
	<?php
	$new_text = $_POST['page_content'];
	
	$update = $page->update_page($page_title, $new_text);
	
	if($update){
		echo 'Seite wird aktualisiert';
		echo '<script>window.location.href="' . PUBLIC_DIR . $page_name . '.php"</script>';
	}else{
		$page->printout();
	}
	?>
<?php endif;?>