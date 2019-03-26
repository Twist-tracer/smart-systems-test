<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\Entity\Field;
use App\Entity\Questionnaire;
use App\Entity\User;
use App\Persister\FieldPersister;
use App\Persister\QuestionnairePersister;

class QuestionnaireRepository extends BaseRepository
{
	protected $table = QuestionnairePersister::TABLE;

	/**
	 * @param int $id
	 * @return Questionnaire
	 */
	public function getById(int $id) : Questionnaire
	{
		$sql = sprintf('select * from %s where id = :id', $this->table);
		$bind_params = [
			':id' => $id
		];
		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return null;
		}

		$row = $statement->fetch();

		$questionnaire = new Questionnaire();
		$questionnaire
			->setId((int)$row['id'])
			->setUserId($row['user_id']);

		return $questionnaire;
	}

}