<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\User;

class UserPersister extends BasePersister
{

	const TABLE = 'users';

	protected $table = self::TABLE;

	/**
	 * @param User $user
	 * @return bool
	 */
	public function add(User $user) :bool {
		$sql = sprintf('insert into %s (fingerprint) values (:fingerprint)', $this->table);
		$bind_params = [
			':fingerprint' => $user->getFingerPrint(),
		];

		$statement = $this->_db->prepare($sql);

		if($statement->execute($bind_params)) {
			$user->setId($this->_db->lastInsertId());
			return true;
		}

		return false;
	}

}