<?php
$check_login = new Login();
$is_admin = $check_login->is_logged_in('admin');
$admin_body_class = ($is_admin) ? 'show-admin-elements' : '';

$page = new Page();
$page_type = $page->find_page_name();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<title>Isartal-Galerie</title>
	<link href="<?php echo CSS_DIR; ?>normalize.css" rel="stylesheet" type="text/css">
	<link href="<?php echo CSS_DIR; ?>style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="container" class="<?php echo $admin_body_class . ' ' . 'page-type-' . $page_type; ?>">
		<header id="page-header">
			<?php include ('login-admin.php'); ?>
			<?php include('header.php'); ?>
		</header>	
		<?php include('nav.php'); ?>	
				