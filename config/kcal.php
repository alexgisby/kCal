<?php defined('SYSPATH') or die('No direct script access.');

return array(
	
	/**
	 * Order of the Days in the Week. Up to you to make sure that this is right, you'll get mental results if it's not sequential.
	 */
	'days_of_week'	=> 'Mon, Tue, Wed, Thu, Fri, Sat, Sun',
	
	/**
	 * View file for the calendar to render out to.
	 */
	'view'	=> 'calendar',
	
	/**
	 * View system to use (Twig, or View usually)
	 */
	'view_system'	=> 'View',
	
	/**
	 * Format to use for URL's.
	 */
	'month_url_format'	=> '?year={YEAR}&month={MONTH}',
	// 'month_url_format' => '{YEAR}/{MONTH}',		Alternate format
	
	/**
	 * Format for the header of the Calendar
	 */
	'header_format'		=> 'F Y',
	
	/**
	 * Boolean to toggle the "Today" button
	 */
	'show_today'		=> true,
	
);