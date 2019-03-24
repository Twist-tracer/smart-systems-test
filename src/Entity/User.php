<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:39
 */

namespace App\Entity;

class User
{

	private $fields  = [];

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setFingerPrint(string $value) {
		$this->fields['fingerprint'] = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFingerPrint() :? string
	{
		return $this->fields['fingerprint'] ?? null;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setId(string $value) {
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
	 * Создает простой отпечаток на основе ceссии пользователя
	 * Есть и другие более сложные способы идентификации пользователя,
	 * к примеру evercookie но для тестового задания думаю хватит и этого
	 */
	public static function createFingerPrint() : string
	{
		return hash('sha512', session_id());
	}

}