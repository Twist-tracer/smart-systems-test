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

	public function actionIndex(Request $request) {




		return $this->render('index');
	}


}