<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\DataBase;
use App\Entity\User;

class BaseRepository
{
	/** @var DataBase  */
	protected $_db;

	protected $table;

	public function __construct(DataBase $db)
	{
		$this->_db = $db;
	}

}