<?php
	//
	// Kohana Native View for Calendar Cells
	//
?>
<td <?php if($cell['idx'] != ''): ?>id="cell_<?php echo $cell['idx']; ?>" class="cell_is_day <?php if($cell['today']): ?>today<?php endif; ?>"<?php endif; ?>>
	<?php echo $cell['idx']; ?>
	<?php if(isset($cell['has_events']) && $cell['has_events']): ?>
		<div class="events">
		<?php foreach($cell['events'] as $event): ?>
			<a href="<?php echo $event['url']; ?>" class="calendar_event <?php echo $event['style']; ?>"><?php echo $event['title']; ?></a>
		<?php endforeach; ?>
		</div>
	<?php endif; ?>
</td>