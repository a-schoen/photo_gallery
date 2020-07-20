<?php 
$settings = new Settings();

//get current settings
$current_formats_array = $settings->get_allowed_formats();
$current_formats = implode(',', $current_formats_array);

$current_settings = $settings->get_current_settings();
$current_max_file_size = $current_settings['max_file_size'];
$mb_max_file_size = intval($current_max_file_size)/1000000; 

$current_fade_time = $current_settings['slider_fade_time'];
$current_show_time = $current_settings['slider_show_time'];

if($current_settings['require_visitor_login'] == '1'){
	$inactive = '';
	$active = 'selected';
}else{
	$active = '';
	$inactive = 'selected';
}

//get upload_max_filesize
$upload_max_filesize = ini_get('upload_max_filesize');
$upload_max_filesize = intval($upload_max_filesize);

//get post_max_size
$post_max_size = ini_get('post_max_size');
$post_max_size = intval($post_max_size);

if($post_max_size <= $upload_max_filesize){
	$file_size_limit = $post_max_size;
}else{
	$file_size_limit = $upload_max_filesize;
}
?>
<h2>Einstellungen ändern</h2>
<h5>Admin-Passwort ändern</h5>
<?php if(isset($_POST['admin_pw_submit'])): ?>
	<?php
		if($_POST['new_admin_pw'] != $_POST['new_admin_pw_repeat']){
			$settings->error_text('Die Passwörter stimmen nicht überein');
			echo '<button class="admin-btn" onclick="window.location.href="' . PUBLIC_DIR . 'admin.php">Zurück</button>';
		}else{
			$update_admin_pw = $settings->change_password('admin_pw', $_POST['new_admin_pw']);
			if($update_admin_pw){
				echo '<p>Admin-Passwort geändert</p>';
			}else{
				$settings->printout();
				echo '<button class="admin-btn" onclick=\'window.location.href="' . PUBLIC_DIR . 'admin.php"\'>Zurück</button>';
			}
		}
	?>
<?php else: ?>
	<form class="admin-form" action="" method="post">
		<label for="new_pw">neues Passwort (8-20 Zeichen; Groß- und Kleinbuchts. & Ziffern erlaubt):
			<br><input type="password" maxlength="20" name="new_admin_pw" id="new_admin_pw">
		</label>
		<br>
		<label for="new_admin_pw">neues Passwort wiederholen:
			<br><input type="password" maxlength="20" name="new_admin_pw_repeat" id="new_admin_pw_repeat">
		</label>
		<br>
		<input class="admin-btn" type="submit" name="admin_pw_submit" value="Admin-Passwort ändern">
	</form>
<?php endif; ?>	
<hr>


<h5>Besucher-Passwort ändern</h5>	
<?php if(isset($_POST['visitor_pw_submit'])): ?>
	<?php
		if($_POST['new_visitor_pw'] != $_POST['new_visitor_pw_repeat']){
			$settings->error_text('Die Passwörter stimmen nicht überein');
			echo '<button class="admin-btn" onclick=\'window.location.href="' . PUBLIC_DIR . 'admin.php">Zurück</button>';
		}else{
			$update_visitor_pw = $settings->change_password('visitor_pw', $_POST['new_visitor_pw']);
			if($update_visitor_pw){
				echo '<p>Besucherpasswort geändert</p>';
			}else{
				$settings->printout();
				echo '<button class="admin-btn" onclick=\'window.location.href="' . PUBLIC_DIR . 'admin.php">Zurück</button>';
			}
		}
	?>	
<?php else: ?>
	<form class="admin-form" action="" method="post">
		<label for="new_visitor_pw">neues Passwort (8-20 Zeichen; Groß- und Kleinbuchts. & Ziffern erlaubt):
			<br><input type="password" maxlength="20" max name="new_visitor_pw" id="new_visitor_pw">
		</label>
		<br>
		<label for="new_visitor_pw">neues Passwort wiederholen:
			<br><input type="password" maxlength="20" name="new_visitor_pw_repeat" id="new_visitor_pw_repeat">
		</label>
		<br>
		<input class="admin-btn" type="submit" name="visitor_pw_submit" value="Besucherpasswort ändern">
	</form>
<?php endif; ?>
<hr>
	
<h5>Website-Einstellungen ändern</h5>
<?php if(isset($_POST['settings_submit'])): ?>
	<?php
		$update = $settings->update_settings_form($_POST);
		
		if($update){
			echo 'Einstellungen aktualisiert';
			echo '<script>window.location.href=' . PUBLIC_DIR . 'admin.php"</script>';
		}else{
			$settings->printout();
			echo '<button class="admin-btn" onclick=\'window.location.href="' . PUBLIC_DIR . 'admin.php">Zurück</button>';
		}
	?>	
<?php else: ?>	
	<form class="admin-form" action="" method="post">
	<label for="require_visitor_login">Passwortschutz für die gesamte Website:
			<select name="require_visitor_login" id="require_visitor_login">
				<option value="1" <?php echo $active; ?>>aktiv</option>
				<option value="0" <?php echo $inactive; ?>>inaktiv</option>
			</select>
		</label>
		<br>
		<label for="format_list">Erlaubte Dateiformate (bitte mit Komma trennen):
			<input type="text" name="format_list" id="format_list" value="<?php echo $current_formats; ?>">
		</label><br>
		<label for="max_file_size">Max. Dateigröße für Bilder (in MB):
			<input type="number" max="<?php echo $file_size_limit; ?>" name="max_file_size" id="max_file_size" value="<?php echo $mb_max_file_size; ?>">
		</label>
		<br>
		<label for="fade_time">Ein- und Ausblendezeit der Bilder im Slideshow-Modus (in Millisekunden):
			<input type="number" max="10000" step="500" name="fade_time" id="fade_time" value="<?php echo $current_fade_time; ?>">
		</label>
		<br>
		<label for="show_time">Anzeigezeit der Bilder im Slideshow-Modus (in Millisekunden):
			<input type="number" max="20000" step="500" name="show_time" id="show_time" value="<?php echo $current_show_time; ?>">
		</label>
		<br>
		<input class="admin-btn" type="submit" value="Daten aktualisieren" name="settings_submit">
	</form>
<?php endif; ?>

	