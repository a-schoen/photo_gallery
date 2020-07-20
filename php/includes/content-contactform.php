<?php
$page = new Page();

$page_info= $page->get_current_page_details(); 

?>
<header id="page-title">
	<h2><?php echo $page_info['page_title']; ?></h2>
</header>
<article id="page-content">
	<?php if(!isset($_POST['submit'])): ?>	
		<form action="" method="POST" class="contact-form">
			<input type="text" class="namefield" name="name">
			<label for="email">Email-Adresse&#42;</label><br>
			<input type="email" name="email" id="email" required>
			<br>
			<label for="title">Betreff&#42;</label><br>
			<input type="text" name="title" id="title" required>
			<br>
			<label for="message">Ihre Nachricht&#42;</label><br>
			<textarea id="message" name="message"></textarea>
			<br>
			<small>&#42; Pflichtfelder</small>
			<br>
			<input class="btn" type="submit" name="submit" value="Absenden">
		</form>	
	<?php else: ?>
		<?php
		//check spam honeytrap ("name" field)
		if(!empty($_POST['name'])){
			var_dump($_POST['name']);
		}else{
			$email = new Email();
				
			$sent = $email->send_mail($_POST);
			
			if(!$sent){
				$email->printout();
				$url = PUBLIC_DIR . 'contact.php';
				echo '<button onclick="window.location.href="' . $url . '">Neue Nachricht</button>';
			}else{
				$email->show_message();
			}
		}
		?>
	<?php endif; ?>
</article>
	