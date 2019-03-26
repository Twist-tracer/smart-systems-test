<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 26.03.2019
 * Time: 6:08
 */

namespace App\Service;

use App\Entity\User;
use App\Persister\UserPersister;
use App\Repository\UserRepository;

class UserService
{

	/** @var  UserRepository */
	private $_repo;

	/** @var  UserPersister */
	private $_persister;

	public function __construct(UserRepository $repo, UserPersister $persister)
	{
		$this->_repo = $repo;
		$this->_persister = $persister;
	}

	public function getCurrentUser() : User
	{
		$user = $this->_repo->getCurrentUser();
		if(!$user) {
			$user = new User();
			$user->setFingerPrint(User::createFingerPrint());
			$this->_persister->add($user);
		}

		return $user;
	}

}