<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:30
 */

namespace App\Traits;

trait Singleton
{
	protected static $instance;

	final private function __construct()
	{
		static::init();
	}

	final public static function getInstance()
	{
		return isset(static::$instance)
			? static::$instance
			: static::$instance = new static;
	}

	protected function init() {}

	final private function __wakeup() {}

	final private function __clone() {}
}