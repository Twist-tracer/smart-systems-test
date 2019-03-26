<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 19:51
 */

namespace App\Controller;

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


}