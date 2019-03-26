<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 19:51
 */

namespace App\Controller;

use App\Entity\QuestionnaireFieldValue;
use App\Exception\Http\NotFoundHttpException;
use App\Request;

class SiteController extends BaseController
{
	protected $layout = 'site';

	/**
	 * Главная страница
	 *
	 * @path /
	 *
	 * @param Request $request
	 *
	 * @return string
	 */
	public function actionIndex(Request $request) : string {
		$this->title = 'Самая лучшая анкета';

		$userRepo = $this->_container->get_user_repository();
		$fieldRepo = $this->_container->get_field_repository();
		$fieldPersister = $this->_container->get_field_persister();
		$userFieldRepo = $this->_container->get_user_field_repository();

		$user = $userRepo->getCurrentUser();

		$fields = $fieldRepo->getSystemFields();

		if(empty($fields)) {
			$fieldPersister->createSystemFields();
			$fields = $fieldRepo->getSystemFields();
		}

		if($user) {
			$userFieldIds = $userFieldRepo->getUserFieldIds($user->getId());
			if(!empty($userFieldIds)) {
				$fields = array_merge($fields, $fieldRepo->getFieldsByIds($userFieldIds));
			}
		}

		return $this->render('index', [
			'fields' => $fields,
		]);
	}

	/**
	 * @param Request $request
	 * @throws NotFoundHttpException
	 */
	public function actionQuestionnaire(Request $request) {
		$queryParams = $request->getQueryParams();

		if(!isset($queryParams['id'])) {
			throw new NotFoundHttpException();
		}

		$questionnaireId = (int)$queryParams['id'];

		if($questionnaireId <= 0) {
			throw new NotFoundHttpException();
		}

		$questionnaireRepo = $this->_container->get_questionnaire_repository();
		$questionnaire = $questionnaireRepo->getById($questionnaireId);

		if(!$questionnaire) {
			throw new NotFoundHttpException();
		}

		$userService = $this->_container->get_user_service();
		$user = $userService->getCurrentUser();

		if($questionnaire->getUserId() !== $user->getId()) {
			throw new NotFoundHttpException();
		}

		$questionnaireFieldValueRepo = $this->_container->get_questionnaire_field_value_reposistory();
		$fieldRepo = $this->_container->get_field_repository();

		$values = $questionnaireFieldValueRepo->getByQuestionnaireId($questionnaire->getId());

		$fieldIds = array_map(function (QuestionnaireFieldValue $value) {
			return $value->getFieldId();
		}, $values);

		$fields = $fieldRepo->getFieldsByIds($fieldIds);

		return $this->render('questionnaire', [
			'fields' => $fields,
			'values' => $values,
		]);
	}


}