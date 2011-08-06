<?php
	//
	// Kohana Native View for Calendars
	//
?>


<table class="calendar">
	<thead>
		<tr class="navigation">
			<th><a href="#">&laquo;</a></th>
			<th colspan="5"><?php echo $header; ?></th>
			<th><a href="#">&raquo;</a></th>
		</tr>
		<tr>
			<?php foreach($days_of_week as $day): ?>
				<th><?php echo $day; ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($cells as $row): ?>
			<tr>
				<?php foreach($row as $cell): ?>
					<?php echo View::factory('kcal/cell')->set('cell', $cell)->render(); ?>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>