<?php
namespace SDevLogger\Database;

class DatabaseInstall extends DatabaseSchema{

	// Create tables
	public function install()
	{
		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		$collate = $this->wpdb->get_charset_collate();

		$table_logs_name = $this->table_logs_name;
		if(!$this->wpdb->query("SHOW TABLES LIKE '$table_logs_name'")){

			$sql_logs = "CREATE TABLE $table_logs_name(
						id bigint(20) unsigned NOT NULL auto_increment,
						title varchar(255) NOT NULL default '',
						value text NOT NULL,
						data text NOT NULL,
						date_create datetime NOT NULL DEFAULT '1000-01-01 00:00',
						PRIMARY KEY  (id)
					) $collate";

			dbDelta($sql_logs);
		}
	}

	// Drop tables
	public function uninstall()
	{
		$table_logs_name = $this->table_logs_name;
		if($this->wpdb->query("SHOW TABLES LIKE '$table_logs_name'")){
			$this->wpdb->query("DROP TABLE $table_logs_name");
		}
	}
}