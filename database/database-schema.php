<?php
namespace SDevLogger\Database;

use SDevLogger\Includes\Application;

class DatabaseSchema{

	protected $app;

	protected $wpdb;
	
	protected $table_logs_name;

	public function __construct(Application $app)
	{
		$this->app = $app;
		global $wpdb;
		// get a reference of the current $wpdb object
		$this->wpdb =& $wpdb;
		$this->table_logs_name = $this->wpdb->prefix."wpdev_logs";
	}

	public function current_date()
	{
		$current = current_datetime();
		return $current->format("Y-m-d H:i:s");
	}
}