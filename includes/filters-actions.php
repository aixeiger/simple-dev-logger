<?php
namespace SDevLogger\Includes;

use SDevLogger\Database\DatabaseInstall;

class FiltersActions extends Provider implements ContractProvider{

	public function boot()
	{	
		// Activation and deactivation
		register_activation_hook( SDEVLOGGER_FILE , array($this, 'activate') );
		register_deactivation_hook( SDEVLOGGER_FILE , array($this, 'deactivate') );

		// set at 1000 priority for the be last to be called
		add_action('activated_plugin', array($this, 'setAtFirstOrder'), 100, 2);

	}

	public function activate()
	{
		$db = new DatabaseInstall($this->app);
		$db->install();
	}

	/**
	 * Every time a plugin is activated
	 * we sort in a way that our plugin be the first on be loaded
	 * this is because we need to load before any plugin for be availible
	 *
	 * @param string 		$plugin
	 * @param bool 			$network_wide
	 */
	public function setAtFirstOrder($plugin, $network_wide)
	{
		$wpdlname = 'simpledevlogger/simpledevlogger.php';
		$current = get_option('active_plugins', array());
		if(!$network_wide && in_array($wpdlname, $current)){
			$narray = array($wpdlname);
			foreach ($current as $plugin) {
				if($plugin !== $wpdlname){
					$narray[] = $plugin;
				}
			}
			update_option('active_plugins', $narray);
		}
	}

	public function deactivate()
	{
		$db = new DatabaseInstall($this->app);
		$db->uninstall();
	}

}