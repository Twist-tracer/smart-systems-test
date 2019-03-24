<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:39
 */

namespace App\Entity;

class Field
{

	private $fields  = [];

	public function __construct(array $fields = [])
	{
		if(isset($fields['id'])) {
			$this->setId((int)$fields['id']);
		}

		if(isset($fields['name'])) {
			$this->setName((string)$fields['name']);
		}

		if(isset($fields['type'])) {
			$this->setType((string)$fields['type']);
		}

		if(isset($fields['system'])) {
			$this->setSystem((bool)$fields['system']);
		}
	}

	/**
	 * @param int $value
	 * @return $this
	 */
	public function setId(int $value) {
		$this->fields['id'] = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getId() :? string
	{
		return $this->fields['id'] ?? null;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setName(string $value) {
		$this->fields['name'] = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() :? string
	{
		return $this->fields['name'] ?? null;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setType(string $value) {
		$this->fields['type'] = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getType() :? string
	{
		return $this->fields['type'] ?? null;
	}

	/**
	 * @param bool $value
	 * @return $this
	 */
	public function setSystem(bool $value) {
		$this->fields['system'] = $value;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getSystem() :? bool
	{
		return $this->fields['system'] ?? false;
	}

}