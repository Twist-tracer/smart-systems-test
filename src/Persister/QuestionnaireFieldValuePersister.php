<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\QuestionnaireFieldValue;

class QuestionnaireFieldValuePersister extends BasePersister
{

	const TABLE = 'questionnaire_field_values';

	protected $table = self::TABLE;

	/**
	 * @param QuestionnaireFieldValue $questionnaireFieldValue
	 * @return bool
	 */
	public function add(QuestionnaireFieldValue $questionnaireFieldValue) :bool {
		$sql = sprintf('insert into %s (questionnaire_id, field_id, value) ', $this->table);
		$sql .= 'values (:questionnaire_id, :field_id, :value)';
		$bind_params = [
			':questionnaire_id' => $questionnaireFieldValue->getQuestionnaireId(),
			':field_id' => $questionnaireFieldValue->getFieldId(),
			':value' => $questionnaireFieldValue->getValue(),
		];

		$statement = $this->_db->prepare($sql);

		if($statement->execute($bind_params)) {
			$questionnaireFieldValue->setId($this->_db->lastInsertId());
			return true;
		}

		return false;
	}

}