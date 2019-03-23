<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:12
 */

namespace App\Controller;

use App\View;

abstract class BaseController
{
	protected $layout = 'site';

	/**
	 * @param string $viewName
	 * @param array $params
	 * @return string
	 */
	public function render(string $viewName, array $params = []) {
		$view = new View();

		$content = $view->render($viewName, $params);

		return $view->render(sprintf('layouts/%s', $this->layout), [
			'content' => $content,
		]);
	}
}