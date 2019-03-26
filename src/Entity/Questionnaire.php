<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:39
 */

namespace App\Entity;

class Questionnaire
{

	private $fields  = [];

	public function __construct(array $fields = [])
	{
		if(isset($fields['id'])) {
			$this->setId((int)$fields['id']);
		}

		if(isset($fields['user_id'])) {
			$this->setUserId((int)$fields['user_id']);
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
	 * @param int $value
	 * @return $this
	 */
	public function setUserId(int $value) {
		$this->fields['user_id'] = $value;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getUserId() :? int
	{
		return $this->fields['user_id'] ?? null;
	}

}