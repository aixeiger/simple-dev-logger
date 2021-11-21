<?php
namespace SDevLogger\Database;

class DatabaseManager extends DatabaseSchema{

	public function boot(){
		
	}

	public function getLogs($limit = 100)
	{
		$table_logs_name = $this->table_logs_name;
		$results = $this->wpdb->get_results($this->wpdb->prepare("SELECT id, title, value, data, date_create FROM $table_logs_name ORDER BY date_create DESC LIMIT %d", $limit));
		if(!$results){
			return array();
		}

		return $results;
	}

	public function create($title, $value, $data)
	{
		$table_logs_name = $this->table_logs_name;
		$this->wpdb->insert(
			$table_logs_name,
			array(
				'title' => $title,
				'value' => $value,
				'data' => $data,
				'date_create' => $this->current_date()
			),
			array('%s', '%s', '%s', '%s')
		);
	}
}