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
use App\Entity\Questionnaire;
use App\Entity\QuestionnaireFieldValue;
use App\Entity\UserField;
use App\Request;
use App\Response;

class QuestionnairesController extends BaseApiController
{

	public function actionCreate(Request $request) {
		$data = $this->getRequestData($request);

		// TODO validate
		if(!$this->validateActionCreate($data)) {
			// TODO change to exceptions and concretize error
			return $this->setUpResponse(['error' => 'Invalid request data'], Response::STATUS_BAD_REQUEST);
		}

		$fieldRepository = $this->_container->get_field_repository();
		$questionnairePersister = $this->_container->get_questionnaire_persister();
		$questionnaireFieldValuePersister = $this->_container->get_questionnaire_field_value_persister();
		$userService = $this->_container->get_user_service();

		$user = $userService->getCurrentUser();

		$fieldValues = $data['fields'];
		$fieldIds = array_keys($fieldValues);
		$fields = $fieldRepository->getFieldsByIds($fieldIds);

		$questionnaire = new Questionnaire();
		$questionnaire->setUserId($user->getId());
		$questionnairePersister->add($questionnaire);

		/** @var Field $field */
		foreach ($fields as $field) {
			$questionnaireFieldValue = new QuestionnaireFieldValue();
			$questionnaireFieldValue
				->setQuestionnaireId($questionnaire->getId())
				->setFieldId($field->getId())
				->setValue((string)$fieldValues[$field->getId()]);

			$questionnaireFieldValuePersister->add($questionnaireFieldValue);
		}

		return $this->setUpResponse(['id' => $questionnaire->getId()]);
	}

	private function validateActionCreate(array $data) : bool {

		return true;
	}

}