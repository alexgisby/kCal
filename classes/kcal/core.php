<?php defined('SYSPATH') or die('No direct script access.');

/**
 * kCal is a calendar library for Kohana.
 *
 * @package 	kCal
 * @author 		Alex Gisby
 */

class kCal_Core
{
	/**
	 * @var 	int 	Current Day
	 */
	protected $current_day;
	
	/**
	 * @var 	int 	Current Month
	 */
	protected $current_month;
	
	/**
	 * @var 	int 	Current year
	 */
	protected $current_year;
	
	/**
	 * @var 	int 	Timestamp representing the current date
	 */
	protected $timestamp;
	
	/**
	 * @var 	array 	Days of the week as defined in the config.
	 */
	protected $days_of_week;
	
	/**
	 * @var 	array 	Cells of the calendar
	 */
	protected $cells = array();
	
	/**
	 * @var 	array 	Events added to this calendar
	 */
	protected $events = array();
	
	/**
	 * Creates a new instance of the calendar. Optionally set the current date (if you don't, we use the current date)
	 *
	 * @param 	int 	Current Day
	 * @param 	int 	Current Month (INTEGER!)
	 * @param 	int 	Current Year
	 * @return 	kCal
	 */
	public function __construct($day = false, $month = false, $year = false)
	{
		$this->set_current_date($day, $month, $year);
	}
	
	
	/**
	 * Set the current date of the calendar. Set any of these as false and we'll use the current date.
	 *
	 * @param 	int 	Current Day
	 * @param 	int 	Current Month (INTEGER!)
	 * @param 	int 	Current Year (should be 4 digit format)
	 * @return 	this
	 */
	public function set_current_date($day = false, $month = false, $year = false)
	{
		// Day is a bit complicated since days can be out of range (30 Feb anyone?) so if we've set the month and year
		// we just default to the 1st which is safe.
		if(($month !== false || $year !== false) && $day === false)
		{
			$this->current_day = 1;
		}
		else
		{
			$this->current_day 		= ($day !== false)? (int)$day : date('j');
		}
		
		$this->current_month	= ($month !== false)? (int)$month : date('n');
		$this->current_year		= ($year !== false)? (int)$year : date('Y');
		
		$this->timestamp		= strtotime($this->current_year . '-' . str_pad($this->current_month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($this->current_day, 2, '0', STR_PAD_LEFT));
		
		return $this;
	}
	
	/**
	 * Renders out the calendar.
	 *
	 * @param 	array 	Extra variables to add to the template
	 * @return 	string
	 */
	public function render(array $extra = array())
	{
		$this->prepare_cells();
		
		$view = Twig::factory('kcal/calendar')->set(array(
				'days_of_week'	=> $this->days_of_week,
				'cells'			=> $this->cells,
				'header'		=> date('F Y', $this->timestamp),
				'current_day'	=> $this->current_day,
				'current_month'	=> $this->current_month,
				'current_year'	=> $this->current_year,
				'today_day'		=> date('j'),
				'today_month'	=> date('n'),
				'today_year'	=> date('Y'),
				'next_query_string'	=> '?month=' . date('n', strtotime('+1 Month', $this->timestamp)) . '&year=' . date('Y', strtotime('+1 Month', $this->timestamp)),
				'prev_query_string' => '?month=' . date('n', strtotime('-1 Month', $this->timestamp)) . '&year=' . date('Y', strtotime('-1 Month', $this->timestamp)),
			));
			
		$view->set($extra);
		
		return $view->render();
	}
	
	/**
	 * Shortcut to render.
	 *
	 * @return 	string
	 */
	public function __toString()
	{	
		try
		{
			$output = $this->render();
		}
		catch(Exception $e)
		{
			$output = $e->getMessage();
		}
		
		return $output;
	}
	
	/**
	 * Adds an event to the calendar.
	 *
	 * @param 	string 	strtotime friendly version of the start date
	 * @param 	string 	strtotime friendly version of the end date.
	 * @param 	array 	Data to pass to the calendar for this event.
	 * @return 	this
	 */
	public function add_event($start_date, $end_date, $data = array())
	{
		// Loop through all of the days in this event, adding them into the array:
		$start_ts 	= strtotime($start_date);
		$end_ts 	= strtotime($end_date);
		
		$curr_ts 	= $start_ts;
		
		while($curr_ts <= $end_ts)
		{
			$curr_day = date('j', $curr_ts);
			$curr_month = date('m', $curr_ts);
			$curr_year = date('Y', $curr_ts);
			
			$this->events[(int)$curr_year][(int)$curr_month][(int)$curr_day][] = $data;
			
			$curr_ts += 60 * 60 * 24;
		}
		
		return $this;
	}
	
	/**
	 * Prepares the cells for the view. Will spit out a multi-dimensional array of 7 cols and 4/5 rows
	 * containing the days of the month.
	 *
	 * @return 	this
	 */
	protected function prepare_cells()
	{
		// Ok, first things first, work out some basic info about the current date:
		$days_in_month 			= date('t', $this->timestamp);
		$first_day_in_month		= date('D', strtotime($this->current_year . '-' . $this->current_month . '-1'));
		$this->days_of_week		= explode(',', kohana::config('kcal')->days_of_week);
		foreach($this->days_of_week as &$doftw)
		{	$doftw = trim($doftw);		}
				
		$day_idx 			= 1;
		$started_counting 	= false;
		$current_row		= 0;
		while($day_idx <= $days_in_month)
		{
			foreach($this->days_of_week as $i => $day)
			{
				// If we haven't started counting, try to now.
				if(!$started_counting)
				{
					if($first_day_in_month == $day)
					{
						$started_counting = true;
					}
				}
				
				// Ok, if we are counting, let's put the cell in:
				if($started_counting && $day_idx <= $days_in_month)
				{
					// Let's start building the array for this date:
					$data = array(
						'idx'			=> $day_idx,
						'today'			=> (date('jMY', strtotime($this->current_year . '-'.  $this->current_month . '-' . $day_idx)) == date('jMY')),
						'has_events'	=> false,
					);
					
					// See if it has an event, and if so, add it;
					if(isset($this->events[$this->current_year][$this->current_month][$day_idx]))
					{
						$data['has_events'] = true;
						$data['events'] = $this->events[$this->current_year][$this->current_month][$day_idx];
					}
					
					$this->cells[$current_row][$i] = $data;
					$day_idx ++;
				}
				else
				{
					// Slap in a blank one:
					$this->cells[$current_row][$i] = array(
						'idx'	=> '',
					);
				}
				
			}
			
			$current_row ++;
		}
		
		return $this;
		
	}
}