<?php
namespace SDevLogger\Facades;

use SDevLogger\Includes\Application;

class Facade{

	protected static $app;

	public static function setApplication(Application $app)
	{
		static::$app = $app;
	}

	protected static function getAccessor()
	{
		throw new RuntimeException('The facade does not implements getAccessor method');
	}

	public static function __callStatic($method, $parameters)
	{
		$instance = static::$app[static::getAccessor()];

		if(!$instance){
			throw new RuntimeException('The provider not exists');
		}

		return $instance->$method(...$parameters);
	}
}