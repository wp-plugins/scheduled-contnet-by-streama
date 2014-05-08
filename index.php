<?php
/*
Plugin Name: Scheduled Contnet by ThatBlogger
Plugin URI: http://thatblogger.co/scheduled-content-wordpress-plugin/
Description: Scheduled content enables you to schedule portions of a post or page and/or set an expiery date for that content.
Author: ThatBlogger
Author URI: http://thatblogger.co/
Version: 2.1
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

date_default_timezone_set(get_option('timezone_string'));

add_shortcode('schedule', 'thatblogger_schdule');
function thatblogger_schdule($atts, $content){
	
	// Get the current time in a mysql format
	$curTime = current_time('mysql');
	// Explode the time into date and time format
	$curTime = explode(' ', $curTime);
	// Convert the current time into a UNIX timestamp
	$curStamp = strtotime($curTime[0].' '.$curTime[1]);
	
	// Get the users attrabutes
	$defaults = array(
		'on'		=>	$cur_date[0], //date
		'at'		=>	$cur_date[1],  //time
		'expon'		=>	$cur_date[2],  //date
		'expat'		=>	$cur_date[3]  //time
	);
	$atts = shortcode_atts($defaults, $atts);//User inputs
	
	// Get the time content is to appear
	$userTimeA = $atts['on'].' '.$atts['at'];
	// Turn that into a UNIX timestamp
	$userTimeA = strtotime($userTimeA);
	
	// Get the time content is to expire, if any
	$userTimeB = $atts['expon'].' '.$atts['expat'];
	// Turn that into a UNIX timestamp
	$userTimeB = strtotime($userTimeB);
	
	// Set the return to nothing incase something goes wrong... so we wont show anything
	$return = '';
	
	// Check if there is no expiery what so ever
	if($atts['expon'] == NULL && $atts['expat'] == NULL){
		// No expiery check to see if the content should be shown yet
		if($curStamp >= $userTimeA){
			// Return the content
			$return = do_shortcode($content);
		}
	}else{
		// Expiery set so lets check if the content has expired.
		if($curStamp < $userTimeB){
			if($curStamp >= $userTimeA){
				// Return the content
				$return = do_shortcode($content);
			}
		}
	}
	
	// Finally return what we find out
	return $return;
}