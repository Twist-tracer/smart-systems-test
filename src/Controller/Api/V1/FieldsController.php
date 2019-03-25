<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 25.03.2019
 * Time: 7:02
 */

namespace App\Controller\Api\V1;


use App\Controller\Api\BaseApiController;
use App\Entity\Field;
use App\Request;
use App\Response;

class FieldsController extends BaseApiController
{

	public function actionCreate(Request $request) {
		$data = $this->getRequestData($request);

		// TODO validate
		if(!$this->validateActionCreate($data)) {
			// TODO change to exceptions and concretize error
			return $this->setUpResponse(['error' => 'Invalid request data'], Response::STATUS_BAD_REQUEST);
		}

		$fieldPersister = $this->_container->get_field_persister();
		$userFieldPersister = $this->_container->get_user_field_persister();

		$field = new Field();
		$field
			->setName($data['name'])
			->setType($data['type'])
			->setSystem(false);

		// TODO check if field exists
		if(!$fieldPersister->add($field)) {
			return $this->setUpResponse(['error' => 'Something went wrong'], Response::STATUS_INTERNAL_SERVER_ERROR);
		}


		// TODO add to user fields


		return $this->setUpResponse(['status' => $field->getId()]);
	}

	private function validateActionCreate(array $data) : bool {

		return true;
	}

}