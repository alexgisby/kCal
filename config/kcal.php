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
	'view_system'	=> 'Twig',
	
	
	/**
	 * Format for the Next Month url
	 */
	'next_month_format'	=> '?month={NEXT_MONTH}&year={NEXT_YEAR}',
	
	/**
	 * Format for the Previous Month url
	 */
	'prev_month_format' => '?month={PREV_MONTH}&year={PREV_YEAR}',
	
);