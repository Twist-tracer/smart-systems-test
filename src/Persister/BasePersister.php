<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Persister;

use App\DataBase;
use App\Entity\User;

class BasePersister
{
	/** @var DataBase  */
	protected $_db;

	protected $table;

	public function __construct(DataBase $db)
	{
		$this->_db = $db;
	}

}