<?php
namespace SDevLogger\Includes;

class Provider{

	protected $app;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}
}