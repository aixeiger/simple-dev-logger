<?php
namespace SDevLogger\Facades;

class Logger extends Facade{

	protected static function getAccessor()
	{
		return 'logger';
	}
}