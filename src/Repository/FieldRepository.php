<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 24.03.2019
 * Time: 11:45
 */

namespace App\Repository;

use App\Entity\Field;
use App\Entity\User;
use App\Persister\FieldPersister;

class FieldRepository extends BaseRepository
{
	protected $table = FieldPersister::TABLE;

	/**
	 * @return Field[]
	 */
	public function getSystemFields() : array
	{
		$sql = sprintf('select * from %s where system = :system', $this->table);
		$bind_params = [
			':system' => true
		];
		$statement = $this->_db->prepare($sql);
		$statement->execute($bind_params);

		if($statement->rowCount() <= 0) {
			return [];
		}

		$rows = $statement->fetchAll();

		$result = [];
		foreach ($rows as $row) {
			$field = new Field();
			$field
				->setId((int)$row['id'])
				->setName($row['name'])
				->setType($row['type'])
				->setSystem((bool)$row['system']);

			$result[] = $field;
		}

		return $result;
	}

	public function getFieldsByIds(array $ids) : array
	{
		$idKeys = array_map(function($key){
			return ':id_'.$key;
		}, $ids);

		$sql = sprintf('select * from %s where id in (%s)', $this->table, implode(',', $idKeys));

		$statement = $this->_db->prepare($sql);

		foreach($ids as $id) {
			$statement->bindParam(':id_' . $id, $id);
		}

		$statement->execute();

		if($statement->rowCount() <= 0) {
			return [];
		}

		$rows = $statement->fetchAll();

		$result = [];
		foreach ($rows as $row) {
			$field = new Field();
			$field
				->setId((int)$row['id'])
				->setName($row['name'])
				->setType($row['type'])
				->setSystem((bool)$row['system']);

			$result[] = $field;
		}

		return $result;
	}

    public function findByNameAndType(string $name, string $type) :? Field
    {
        $sql = sprintf('select * from %s where name = :name and type = :type', $this->table);
        $bind_params = [
            ':name' => $name,
            ':type' => $type,
        ];
        $statement = $this->_db->prepare($sql);
        $statement->execute($bind_params);

        if($statement->rowCount() <= 0) {
            return null;
        }

        $result = $statement->fetch();
        $field = new Field($result);

        return $field;
    }

}