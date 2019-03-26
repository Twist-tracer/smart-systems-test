<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\Entity\User;
use App\Persister\UserPersister;

class UserRepository extends BaseRepository
{
	protected $table = UserPersister::TABLE;

	/**
	 * @return User|null
	 */
	public function getCurrentUser() :? User
	{
		$fingerPrint = User::createFingerPrint();

		$sql = sprintf('select * from %s where fingerprint = :fingerprint limit 1', $this->table);
		$bind_params = [
			':fingerprint' => $fingerPrint
		];
		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return null;
		}

		$result = $statement->fetch();
		$user = new User();
		$user
			->setId($result['id'])
			->setFingerPrint($result['fingerprint']);

		return $user;
	}

}