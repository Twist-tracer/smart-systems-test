<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 19:23
 */

namespace App;

/**
 * Class Kernel
 * @package App
 */
class Kernel
{

	/**
	 * @param Request $request
	 * @return Response
	 */
	public function handle(Request $request) :Response {
		$router = Router::getInstance();

		return $router->handle($request);
	}

}