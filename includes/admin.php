<?php
namespace SDevLogger\Includes;

class Admin extends Provider implements ContractProvider{

	public function boot()
	{
		add_action('admin_menu', array($this, 'register_menu'));
	}

	public function register_menu()
	{
		add_menu_page(
			'SimpleDev Logger',
			'SimpleDev Logger',
			'manage_options',
			'simple-dev-logger',
			array($this, 'menu_callback')
		);
	}

	public function menu_callback()
	{
		include_once SDEVLOGGER_PATH.'templates/admin.php';
	}

}