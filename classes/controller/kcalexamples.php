<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Examples for using kCal in your projects.
 *
 * @package 	kCal
 * @category  	Examples
 * @author 		Alex Gisby
 */


class Controller_Kcalexamples extends Controller_Template
{
	public $template = 'kcalexamples';
	
	/**
	 * Basic examples
	 */
	public function action_index()
	{
		// Build using today's date;
		$basic_cal = new kCal();
		$this->template->basic_calendar = $basic_cal;
		
		// Using a custom date;
		$date_cal = new kCal(12, 5, 2014);	// Notice how the month is an integer, not a string!
		$this->template->date_calendar = $date_cal;
		
		// With events;
		$event_cal = new kCal(1, 2, 2011);
		
		// The two strings are the start and end dates and should be in a strtotime friendly format.
		$event_cal->add_event('1 February 2011 08:30', '1 February 2011 09:30', array(
				// This array can contain absolutely anything. The data will be passed to the template
				// so you can display the correct information.
				'title'	=> 'Early Morning Run',
				'url'	=> '/events/early-morning-run',
				'style'	=> 'red',
		));
		
		// Events can span several days;
		$event_cal->add_event('14 February 2011 12:35', '18 February 2011 12:00', array(
				'title'	=> 'Camp Crunchalot',
				'url'	=> '/events/camp-crunchalot',
				'style'	=> 'green',
		));
		
		// They can even go outside the 'bounds' of the month;
		$event_cal->add_event('26 February 2011 12:35', '10 March 2011 12:00', array(
				'title'	=> 'Bike Tour',
				'url'	=> '/events/bike-tour',
				'style'	=> 'blue',
		));
		
		// And finally, you can of course have multiple events per day;
		$event_cal->add_event('17 February 2011 10:00', '17 February 2011 15:00', array(
				'title'	=> 'Gym Session',
				'url'	=> '/events/gym-session',
				'style'	=> 'red',
		));
		
		$this->template->event_calendar = $event_cal;
	}
}