<?php
$page_type = $page->find_page_name();
?>
	<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo JS_DIR . $page_type; ?>.bundle.js"></script>
<?php if($is_admin): ?>
	<script type="text/javascript" src="<?php echo JS_DIR; ?>admin.bundle.js"></script>
<?php endif; ?>
</body>
</html>

