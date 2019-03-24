<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:12
 */

namespace App\Controller;

use App\Container;
use App\View;

abstract class BaseController
{
	protected $title = '';

	protected $layout = 'site';

	/** @var Container  */
	protected $_container;

	public function __construct(Container $container)
	{
		$this->_container = $container;
	}

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
			'title' => $this->title
		]);
	}
}