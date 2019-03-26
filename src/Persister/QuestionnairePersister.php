<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\Questionnaire;

class QuestionnairePersister extends BasePersister
{

	const TABLE = 'questionnaires';

	protected $table = self::TABLE;

	/**
	 * @param Questionnaire $questionnaire
	 * @return bool
	 */
	public function add(Questionnaire $questionnaire) :bool {
		$sql = sprintf('insert into %s (user_id) values (:user_id)', $this->table);
		$bind_params = [
			':user_id' => $questionnaire->getUserId(),
		];

		$statement = $this->_db->prepare($sql);

		if($statement->execute($bind_params)) {
			$questionnaire->setId($this->_db->lastInsertId());
			return true;
		}

		return false;
	}

}