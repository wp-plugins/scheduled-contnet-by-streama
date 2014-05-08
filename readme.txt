=== Scheduled Content ===
Contributors: Danny159
Tags: scheduled content, timed, posts, content, page, streama, thatblogger
Requires at least: 3.5
Tested up to: 3.9
Stable tag: 2.0

Scheduled content enables you to schedule portions of a post or page and/or set an expiery date for that content.

== Description ==

After installing and activating the plugin you can use the shortcode [schedule]. You can pass upto 4 parameters, the date and the time to show the content and the date and time the content will expired and disappear from your page or post. You have to pass at least one parameter from the scheduled or expired.

Sample -

[schedule on='2014-12-01' at="10:01" expon='2014-12-01' expat="13:15"]
the content you want to hide here
[/schedule]

The 4 parameters are "on", "at", "expon" and "expat".
"on" accepts a date, until that date is arrived the content will be hidden.
"at" accepts a time. Time has to be set in 24hrs format. (date should be yy-mm-dd if you only pass time)
"expon" accepts a date, the content will disappear from the page on this date.
"expat" accepts a time. Time has to be set in 24hrs format. (date should be yy-mm-dd if you only pass time)

The time is compared with your blog's time zone settings, if you set your time zone to local time zone it would be easy for you. Go to "General" settings of your wordpress dashboard, under "Time Zone" you can set the time zone you prefer.

Shortcodes will also run inside this shortcode!!


== Installation ==

1. Upload and extract the .zip file downloaded to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Start using the shortcode

== Changelog ==

= 2.1 =
* Add feature to allow shortcodes to be inside the scheduled content - http://wordpress.org/support/topic/shortcodes-in-scheduled-content

= 2.0 =
* Bug Fixes
* Remove Debug Code
* General Cleaning of Code

= 1.2 =
* Bug Fixes
* Debug

= 1.1 =  
* Fix time issue that casues content to appear 1 hour early

= 1.0 =  
* Public beta release