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

	public function add(User $user)
	{

	}

}