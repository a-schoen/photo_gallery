<?php 
if(!isset($_SESSION['admin_token'])){		
	$_SESSION['admin_token'] = md5(uniqid('', true) . ADM_TOKEN);
}
$token = $_SESSION['admin_token'];

if($is_admin){
	$button_class = 'admin-login-btn admin-btn';
	$button_text = 'Admin (angemeldet)';
}else{	
	$button_class = 'admin-login admin-login-btn';
	$button_text = 'Admin-Login';
}
?>
<div id="admin-login">
	<button class="login-btn <?php echo $button_class; ?>"><?php echo $button_text; ?></button>
	<div class="admin-login-form">
		<button class="admin-login-close">X</button>
		<?php if($is_admin): ?>
			<h5>Admin</h5>
			<ul>
				<li><a href="<?php echo PUBLIC_DIR; ?>admin.php">Einstellungen ändern</a></li>
				<li><a href="<?php echo PUBLIC_DIR; ?>gallery.php?id=1">Bilder verwalten/hinzufügen</a></li>
				<li><a href="<?php echo PUBLIC_DIR; ?>galleries.php">Galerien verwalten</a></li>
				<li><a href="<?php echo PUBLIC_DIR; ?>admin.php?logout">Ausloggen</a></li>
			</ul>
		<?php else: ?>
			<?php if(!isset($_POST['login_submit'])): ?>
				<h5>Admin-Login</h5>
				<form action="" method="POST">
					<label>Passwort: </label>
					<br>
					<input type="hidden" value=<?php echo $token; ?> name="token">
					<input type="password" name="login_password">
					<br>
					<input type="submit" name="login_submit" value="Einloggen">
				</form>
			<?php else: ?>
				<?php
					$login = new Login();
					$logged_in = $login->log_in('admin', $_POST['login_password'], $_POST['token']);
					if($logged_in){
						echo '<script>window.location.href="' . PUBLIC_DIR . 'index.php"</script>';

					}
					else{
						$login->printout();
						?>
							<button onclick="history.back()">Erneut versuchen?</button>
						<?php 
					}
				?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

