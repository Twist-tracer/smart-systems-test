<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\Entity\Field;
use App\Entity\QuestionnaireFieldValue;
use App\Entity\User;
use App\Persister\FieldPersister;
use App\Persister\QuestionnaireFieldValuePersister;

class QuestionnaireFieldValueRepository extends BaseRepository
{
	protected $table = QuestionnaireFieldValuePersister::TABLE;

	/**
	 * @return Field[]
	 */
	public function getSystemFields() : array
	{
		$sql = sprintf('select * from %s where system = :system', $this->table);
		$bind_params = [
			':system' => true
		];
		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return [];
		}

		$rows = $statement->fetchAll();

		$result = [];
		foreach ($rows as $row) {
			$field = new Field();
			$field
				->setId((int)$row['id'])
				->setName($row['name'])
				->setType($row['type'])
				->setSystem((bool)$row['system']);

			$result[] = $field;
		}

		return $result;
	}

	/**
	 * @param int $questionnaireId
	 * @return QuestionnaireFieldValue[]
	 */
	public function getByQuestionnaireId(int $questionnaireId) : array
	{
		$sql = sprintf('select * from %s where questionnaire_id = :questionnaire_id', $this->table);

		$bind_params = [
			':questionnaire_id' => $questionnaireId
		];

		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return [];
		}

		$rows = $statement->fetchAll();

		$result = [];
		foreach ($rows as $row) {
			$questionnaireFieldValue = new QuestionnaireFieldValue();
			$questionnaireFieldValue
				->setId((int)$row['id'])
				->setQuestionnaireId($row['questionnaire_id'])
				->setFieldId($row['field_id'])
				->setValue($row['value']);

			$result[] = $questionnaireFieldValue;
		}

		return $result;
	}

}