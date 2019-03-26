<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:39
 */

namespace App\Entity;

class QuestionnaireFieldValue
{

	private $fields  = [];

	public function __construct(array $fields = [])
	{
		if(isset($fields['id'])) {
			$this->setId((int)$fields['id']);
		}

		if(isset($fields['questionnaire_id'])) {
			$this->setQuestionnaireId((int)$fields['questionnaire_id']);
		}

		if(isset($fields['field_id'])) {
			$this->setFieldId((int)$fields['field_id']);
		}

		if(isset($fields['system'])) {
			$this->setValue((string)$fields['value']);
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
	public function setQuestionnaireId(int $value) {
		$this->fields['questionnaire_id'] = $value;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getQuestionnaireId() :? int
	{
		return $this->fields['questionnaire_id'] ?? null;
	}

	/**
	 * @param int $value
	 * @return $this
	 */
	public function setFieldId(int $value) {
		$this->fields['field_id'] = $value;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getFieldId() :? int
	{
		return $this->fields['field_id'] ?? null;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setValue(string $value) {
		$this->fields['value'] = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue() :? string
	{
		return $this->fields['value'] ?? null;
	}

}