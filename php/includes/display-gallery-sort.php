<?php 
$gallery_id = intval($_GET['id']);

$gallery = new Gallery();

$img_list = $gallery->get_photo_ids($gallery_id);

$ordered_list = $gallery->order_display($gallery_id, $img_list);
$photo = new Photo();
?>
<div class="instruction sorting">
	<small>Bilder an die gewünschte Position ziehen</small>
</div>
<ul id="sortable-list" data-gallery="<?php echo $gallery_id; ?>">	
	<?php $index = 1; ?>
	<?php foreach($ordered_list as $img_id): ?>
		<?php
			$img_info = $photo->get_single_photo($img_id);
			$url = THUMBS_DIR . 'tn_' . $img_info['photo_url'];	
		?>
		<li id="<?php echo $img_id; ?>" class="img-list-display" draggable="true" data-sort-nr="<?php echo $index; ?>">
			<div class="img-list-display-inner">
				<img src="<?php echo $url; ?>">
			</div>
			<div class="img-list-display-inner">
				<p><?php echo $img_info['photo_title']?></p>
			</div>
			<p class="instruction">Zum Umsortieren mit der Maus ziehen</p>
		</li>
		<?php $index++; ?>
	<?php endforeach; ?>
</ul>
<button id="sort-btn">Reihenfolge speichern</button>
