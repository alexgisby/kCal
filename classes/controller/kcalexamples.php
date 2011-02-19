<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Examples for using kCal in your projects.
 *
 * @package 	kCal
 * @category  	Examples
 * @author 		Alex Gisby
 */


class Controller_Kcalexamples extends Controller_Template_Twig
{
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
	}
}