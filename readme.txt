=== Simple Dev Logger ===
Contributors: aixeiger
Tags: development tool, tool, logger, development
Requires at least: 5.4
Tested up to: 5.8
Stable tag: 0.1.1
Requires PHP: 7.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Simple logger for Wordpress theme or plugin development

== Description ==

A simple logger for development purposes, when we are making a theme or a plugin we need to ensure that our code works as expected, but if is a plugin for extend something big like WooCommerce can be hard maintain in mind the current data, instead of develop a custom logger, use an advanced logger, using update_option or die, use this plugin, the difference between an advance logger and this is the simplicity and this is designed for Wordpress friendly, you can log 3 values: a title, a value and data if need, and when you are ready, remove the logger functions from your theme or plugin and that's it


## How works

* Install the plugin
* Start coding your theme or plugin
* If there is any data do you want to log use SDLO::log('title', 'value', array('some' => 'data')) or the function sdlo()
* the first value is mandatory and the other two are optional
* then go to "SimpleDev Logger" page in Worpdress panel at bottom
* is the expected data?
* remove the SDLO::log() and repeat

* a safe way for not break something if you uninstall the plugin and forgot remove the logs is:
	if(function_exists('sdlo')){
		sdlo("Title for log", "some data");
	}
* or
	if(class_exists('WPDL')){
		SDLO::log("Title for log", "some data");
	}


* On uninstall, all the data is dropped