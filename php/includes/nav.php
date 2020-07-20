<nav id="site-nav">
	<ul>
		<li><a href="<?php echo PUBLIC_DIR; ?>">Home</a></li>
		<li class="has-submenu">
			<a id="has-submenu-link" class="closed" href="galleries.php">Galerien</a>
			<ul class="submenu">
				<?php 
					$galleries = new Collection();
					$galleries->make_submenu($is_admin);
				?>									
			</ul>
		</li>
		<li><a href="<?php echo PUBLIC_DIR; ?>contact.php">Kontakt</a></li>
	</ul>
</nav>