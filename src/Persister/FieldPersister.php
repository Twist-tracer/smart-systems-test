<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 12:02
 */

namespace App\Persister;

use App\Entity\Field;

class FieldPersister extends BasePersister
{

	const TABLE = 'fields';

	protected $table = self::TABLE;

	private $systemFields = [
		[
			'name' => 'Фамилия',
			'type' => 'text',
			'system' => true,
		],
		[
			'name' => 'Имя',
			'type' => 'text',
			'system' => true,
		],
		[
			'name' => 'Отчество',
			'type' => 'text',
			'system' => true,
		],
		[
			'name' => 'Дата рождения',
			'type' => 'date',
			'system' => true,
		],
	];

	public function createSystemFields()
	{
		foreach ($this->systemFields as $systemField) {
			$systemField = new Field($systemField);
			$this->add($systemField);
		}
	}

	public function add(Field $field) {
		$sql = sprintf('insert into %s (name, type, system) values (:name, :type, :system)', $this->table);
		$bind_params = [
			':name' => $field->getName(),
			':type' => $field->getType(),
			':system' => $field->getSystem(),
		];

		$statement = $this->_db->prepare($sql);

		if($statement->execute($bind_params)) {
			$field->setId($this->_db->lastInsertId());
		}
	}

}