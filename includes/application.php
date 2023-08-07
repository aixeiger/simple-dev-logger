<?php
namespace SDevLogger\Includes;

use SDevLogger\Facades\Facade;
use ArrayAccess;
use ReflectionClass;

class Application implements ArrayAccess{

	protected static $instance;

	// The bindings can be accessed from outsite of the application
	protected $bindings = [];

	public function __construct()
	{	
		/**
		 * Once the application has been instantiated for first time
		 * It will not be able in new instances to access to the current state
		 * For access to the application can be only by calling the Application::getInstance() method
		 * This ensure that the application can be instantiated only one time
		 */
		if(is_null(static::$instance)){
				
			static::$instance = $this;

			$this->register();
		}
	}

	public function bind($abstract, $concrete, $shared = true)
	{
		if(is_string($concrete)){
			
			try {
				$reflector = new ReflectionClass($concrete);	
			} catch (Exception $e) {
				throw new Exception("Target class [$concrete] does not exists", 0, $e);
			}
			
			if(!$reflector->isInstantiable()){
				return false;
			}

			$concrete = $reflector->newInstanceArgs([$this]);
		}

		if($shared){
			$this->bindings[$abstract] = $concrete;
		} else {
			$this->instances[$abstract] = $concrete;
		}
	}

	protected function register()
	{
		$this->registerProviders();
		$this->registerFacades();
	}

	protected function registerProviders()
	{
		$this->bind('database', new \SDevLogger\Database\DatabaseManager($this));
		$this->bind('filters', new FiltersActions($this));
		$this->bind('admin', new Admin($this));
		$this->bind('logger', new Logger($this));
	}

	protected function registerFacades()
	{
		Facade::setApplication($this);
	}

	// bootstrap all the providers
	public function boot()
	{
		foreach ($this->bindings as $key => $provider) {
			$provider->boot();
		}
	}

	public static function getInstance()
	{
		return static::$instance;
	}

	public function offsetExists(mixed $key): bool
	{
		return isset($this->bindings[$key]);
	}

	public function offsetGet(mixed $key): mixed
	{
		return $this->bindings[$key];
	}

	public function offsetSet(mixed $key, mixed $value): void
	{
		static::getInstance()->bind($key,$value);
	}

	public function offsetUnset(mixed $key): void
	{
		unset($this->bindings[$key]);
	}
}