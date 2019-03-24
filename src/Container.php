<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:33
 */

namespace App;


use App\Persister\FieldPersister;
use App\Persister\UserFieldPersister;
use App\Persister\UserPersister;
use App\Repository\FieldRepository;
use App\Repository\UserFieldRepository;
use App\Repository\UserRepository;
use App\Traits\Singleton;

class Container
{
	use Singleton;

	private $values = [];

	/**
	 * @param $key
	 * @return mixed|null
	 */
	public function get($key)
	{
		if(!isset($this->values[$key])) {
			return null;
		}

		if(is_callable($this->values[$key])) {
			return $this->values[$key] = call_user_func($this->values[$key], $this);
		} else {
			return $this->values[$key];
		}
	}

	public function set(string $key, callable $serviceConstructor)
	{
		$this->values[$key] = $serviceConstructor;

		return $this;
	}

	public function get_data_base() :? DataBase
	{
		return $this->get(DataBase::class);
	}

	public function get_user_repository() :? UserRepository
	{
		return $this->get(UserRepository::class);
	}

	public function get_user_persister() :? UserPersister
	{
		return $this->get(UserPersister::class);
	}

	public function get_field_repository() :? FieldRepository
	{
		return $this->get(FieldRepository::class);
	}

	public function get_field_persister() :? FieldPersister
	{
		return $this->get(FieldPersister::class);
	}

	public function get_user_field_repository() :? UserFieldRepository
	{
		return $this->get(UserFieldRepository::class);
	}

	public function get_user_field_persister() :? UserFieldPersister
	{
		return $this->get(UserFieldPersister::class);
	}

}