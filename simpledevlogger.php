<?php
/**
 * Plugin Name: Simple Dev Logger
 * Version:     0.1.1
 * Author:      Aixeiger
 * License:     GPLv2 or later
 * Requires PHP: 7.3
 * Requires at least: 5.4
 * Description: A simple logger for development purposes, when we are making a theme or a plugin we need to ensure that our code works as expected and process and return data properly, but if a plugin is used for extend something big like WooCommerce. Logging temporary data can be hard, instead of develop a custom logger, use update_option or die(), use this and start logging.
 */
define('SDEVLOGGER_FILE', __FILE__);
define('SDEVLOGGER_PATH', dirname(SDEVLOGGER_FILE).'/');

require_once SDEVLOGGER_PATH.'database/database-schema.php';
require_once SDEVLOGGER_PATH.'database/database-manager.php';
require_once SDEVLOGGER_PATH.'database/database-install.php';
require_once SDEVLOGGER_PATH.'includes/provider.php';
require_once SDEVLOGGER_PATH.'includes/contractProvider.php';
require_once SDEVLOGGER_PATH.'includes/logger.php';
require_once SDEVLOGGER_PATH.'includes/admin.php';
require_once SDEVLOGGER_PATH.'includes/filters-actions.php';
require_once SDEVLOGGER_PATH.'includes/application.php';
require_once SDEVLOGGER_PATH.'facades/facade.php';
require_once SDEVLOGGER_PATH.'facades/logger.php';

use SDevLogger\Includes\Application as SDLApplication;
use SDevLogger\Facades\Logger as SDLLogger;

$sdlapp = new SDLApplication();
$sdlapp->boot();

/**
 * use: WPDL::log($title, $value, $data)
 * or use the function wpdl($title, $value, $data)
 * or you can import to your project as use WPDevLogger\Facades\Logger
 *
 * @param String 					$title
 * @param Int|String|Array|Object 	$value
 * @param Int|String|Array|Object 	$data (Optional)
 */
class SDLO{

	public static function log($title = '', $value = '', $data = false){
		// log here
		SDLLogger::log($title, $value, $data);
	}

}

function sdlo($title = '', $value = '', $data = false){
	SDLLogger::log($title, $value, $data);
}

/**

The way for extend the application is this:

use WPDevLogger\Includes\Application;
use WPDevLogger\Includes\ContractProvider;
use WPDevLogger\Includes\Provider;
use WPDevLogger\Facades\Facade;

class Theory extends Provider implements ContractProvider{

	public $name = 'AwesomeName';

	public function boot()
	{

	}

	public function getLogs()
	{
		return $this->app['database']->getLogs(500);
	}
}

class TheoryFacade extends Facade{

	public static function getAccesor()
	{
		return 'theory';
	}
}

$currentapp = Application::getInstance();
$currentapp['theory'] = Theory::class;

$data = TheoryFacade::getLogs();

*/