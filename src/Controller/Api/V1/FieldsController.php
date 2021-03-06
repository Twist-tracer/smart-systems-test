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
use App\Entity\UserField;
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
		$fieldRepository = $this->_container->get_field_repository();
		$userFieldPersister = $this->_container->get_user_field_persister();
		$userService = $this->_container->get_user_service();

		$user = $userService->getCurrentUser();

        $field = $fieldRepository->findByNameAndType($data['name'], $data['type']);
        if(!$field) {
            $field = new Field();
            $field
                ->setName($data['name'])
                ->setType($data['type'])
                ->setSystem(false);

            if(!$fieldPersister->add($field)) {
                return $this->setUpResponse(['error' => 'Something went wrong'], Response::STATUS_INTERNAL_SERVER_ERROR);
            }

        }

        $userField = new UserField();
		$userField
			->setUserId($user->getId())
			->setFieldId($field->getId());

        $userFieldPersister->add($userField);

		return $this->setUpResponse(['id' => $field->getId()]);
	}

	private function validateActionCreate(array $data) : bool {

		return true;
	}

}