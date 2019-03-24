<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\Field;

class UserFieldPersister extends BasePersister
{

	const TABLE = 'user_fields';

	protected $table = self::TABLE;

}