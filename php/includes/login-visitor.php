<?php
if(!isset($_SESSION['visitor_token'])){
	$_SESSION['visitor_token'] = md5(uniqid('', true) . VIS_TOKEN);
}
$token = $_SESSION['visitor_token'];
$login = new Login();
?>
<!DOCTYPE html>
<html class="login-screen">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>Isartal-Galerie</title>
	<link href="<?php echo CSS_DIR; ?>style.css" rel="stylesheet" type="text/css">
</head>
<body class="login-screen">
	<div id="container" class="login-screen">
		<div id="visitor_login">
			<?php if(!isset($_POST['submit'])):	?>				
				<form action="" method="post">
					<label>Besucherpasswort eingeben:</label>
					<br>
					<input type="hidden" value=<?php echo $token; ?> name="token">
					<input type="password" name="visitor_pass">
					<br>
					<input type="submit" name="submit" value="einloggen">
				</form>
			<?php else: ?>
				<?php
					$posted_pw = $_POST['visitor_pass'];
					$posted_token = $_POST['token'];
					$logged_in = $login->log_in('visitor', $posted_pw, $posted_token);
				?>
				<?php if($logged_in): ?>
					<p>Vielen Dank, Sie werden eingeloggt!</p>
					<script>window.location.href="' . PUBLIC_DIR . 'index.php"</script>
				<?php else: ?>
					<button onclick="history.back()">Erneut versuchen?</button>
				<?php endif; ?>
			<?php endif; ?>
			<aside id="cookie-notice">
				<p>Diese Website verwendet Cookies im Rahmen des Benutzer-Logins. Durch das Einloggen erkl&auml;ren Sie sich mit der Verwendung von Cookies einverstaden.</p>
			</aside>
		</div>
	</div>
</body>
</html>