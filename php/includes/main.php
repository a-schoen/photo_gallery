<?php 
$template = $page->assemble_template();
$content_type = $template['content'];
$display_type = $template['display'];
?>
<div id="content">				
	<?php include( INC_DIR . "content-" . $content_type . ".php"); ?>
</div>
<?php include( INC_DIR . "display-" . $display_type . ".php"); ?>	
		