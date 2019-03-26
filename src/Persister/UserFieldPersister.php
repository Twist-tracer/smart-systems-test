<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\UserField;

class UserFieldPersister extends BasePersister
{

	const TABLE = 'user_fields';

	protected $table = self::TABLE;

	/**
	 * @param UserField $userField
	 * @return bool
	 */
	public function add(UserField $userField) :bool {
		$sql = sprintf('insert into %s (user_id, field_id) values (:user_id, :field_id)', $this->table);
		$bind_params = [
			':user_id' => $userField->getUserId(),
			':field_id' => $userField->getFieldId(),
		];

		$statement = $this->_db->prepare($sql);

		if($statement->execute($bind_params)) {
			$userField->setId($this->_db->lastInsertId());
			return true;
		}

		return false;
	}

}