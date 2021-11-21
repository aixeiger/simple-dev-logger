<?php
namespace SDevLogger\Includes;

use SDevLogger\Database\DatabaseManager;

class Logger extends Provider implements ContractProvider{

	public function boot()
	{

	}

	public function log($title = '', $value = '', $data = false)
	{
		// at least needed the first value, if not then return
		if($title == ''){
			return;
		}
		
		if(!is_string($title)){
			$title = 'Incorrect title type given, only supported int, float or string';
		}

		if(!is_scalar($value) && !is_object($value) && !is_array($value)) {
			$value = 'Incorrect value type given, only supported scalar, object and array values';
		} elseif(is_object($value) || is_array($value)) {
			$value = json_encode($value);
		}

		if($data){
			if(!is_scalar($data) && !is_object($data) && !is_array($data)){
				$data = 'Incorrect data type given, only supported scalar, object and array values';
			} elseif($data === false) {
				$data = '';
			} elseif(is_object($data) || is_array($data)){
				$data = json_encode($data);
			}
		} else {
			$data = '';
		}

		$this->app['database']->create($title, $value, $data);
	}

	public function getData($limit)
	{
		return $this->app['database']->getLogs($limit);
	}

}