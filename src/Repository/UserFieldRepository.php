<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\Persister\UserFieldPersister;

class UserFieldRepository extends BaseRepository
{
	protected $table = UserFieldPersister::TABLE;

	public function getUserFieldIds(int $userId) {
		$sql = sprintf('select * from %s where user_id = :user_id', $this->table);
		$bind_params = [
			':user_id' => $userId
		];
		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return [];
		}

		$result = $statement->fetchAll();
		return array_column($result, 'field_id');
	}

}