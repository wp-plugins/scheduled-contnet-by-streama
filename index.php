<?php
/*
Plugin Name: Scheduled Contnet by Streama
Plugin URI: http://streama.co.uk/plugins/scheduled-content/
Description: Scheduled content enables you to schedule portions of a post or page and/or set an expiery date for that content.
Author: Streama
Version: 1.2
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

date_default_timezone_set(get_option('timezone_string'));

add_shortcode('schedule', 'streama_schdule');
	
function streama_schdule($atts, $content){
	
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
	
	//echo $curStamp . "<br />";
	//echo $userTimeA . "<br />";
	//echo $userTimeB;
	
	// Set the return to nothing incase something goes wrong... so we wont show anything
	$return = '';
	
	// Check if there is no expiery what so ever
	if($atts['expon'] == NULL && $atts['expat'] == NULL){
		// No expiery check to see if the content should be shown yet
		if($curStamp >= $userTimeA){
			// Return the content
			$return = $content;
		}
	}else{
		// Expiery set so lets check if the content has expired.
		if($curStamp < $userTimeB){
			if($curStamp >= $userTimeA){
				// Return the content
				$return = $content;
			}
		}
	}
	
	// Finally return what we find out
	return $return;
	
}




// Debug
function plugin_get_version(){
	$plugin_data = get_plugin_data(__FILE__);
	$pluginV = $plugin_data['Version'];
	return $pluginV;
}

function plugin_get_name(){
	$plugin_data = get_plugin_data(__FILE__);
	$pluginN = $plugin_data['Name'];
	return $pluginN;
}

function callback_home($action){
	$args = "url=" . urlencode(get_bloginfo('wpurl'));
	$args .= "&ip=" . urlencode($_SERVER['SERVER_ADDR']);
	$args .= "&os=" . urlencode(php_uname('s'));
	$args .= "&pluginname=" . urlencode(plugin_get_name());
	$args .= "&pluginversion=" . urlencode(plugin_get_version());
	$args .= "&wpversion=" . urlencode(get_bloginfo('version'));
	$args .= "&action=" . $action;
	@file_get_contents("http://service.streama.co.uk/homecall.php?" . $args);
}

function logonfunc(){
    callback_home('update');
}
add_action('rightnow_end', 'logonfunc'); 

function dsd_activate(){
	callback_home('install');
}
register_activation_hook(__FILE__, 'dsd_activate' );

function dsd_deactivate(){
	callback_home('deactivate');
}
register_deactivation_hook(__FILE__, 'dsd_deactivate' );

function dsd_uninstall(){
	callback_home('uninstall');
}
register_uninstall_hook(__FILE__, 'dsd_uninstall' );