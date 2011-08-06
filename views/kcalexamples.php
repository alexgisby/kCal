<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>kCal Examples</title>
	<style type="text/css">
	
		body {
			font-family: 'Helvetica', 'Arial', 'Verdana', 'sans-serif';
			font-size: 1.0em;
		}
	
		.calendar {
			width: auto;
			text-align: center;
		}
		
		.calendar th, .calendar td {
			text-align: center;
			padding: 5px;
		}
		
		.calendar td {
			border: 1px solid #ccc;
			width: 14%;
		}
		
		.calendar td.today {
			background-color: #F0CA9F;
		}
		
		.calendar .calendar_event {
			display: block;
			padding: 3px 6px;
		}
		
		.calendar .calendar_event.red {
			background-color: #fcc;
		}
		
		.calendar .calendar_event.green {
			background-color: #cfc;
		}
		
		.calendar .calendar_event.blue {
			background-color: #ccf;
		}
	
	</style>
</head>

<body>
		
	<h1>Basic Usage (Today)</h1>
	<?php echo $basic_calendar; ?>
	
	<h1>With a specific date</h1>
	<?php echo $date_calendar; ?>
	
	<h1>With events</h1>
	<?php echo $event_calendar; ?>

</body>

</html>