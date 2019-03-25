<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:47
 */

namespace App;

use App\Controller\Api\V1\FieldsController;
use App\Controller\SiteController;
use App\Exception\Http\NotFoundHttpException;
use App\Traits\Singleton;

class Router
{
	use Singleton;

	private $routes = [
		'/' => [
			'class' => SiteController::class,
			'action' => 'index',
			'methods' => [Request::METHOD_GET]
		],

		'/api/v1/fields' => [
			'class' => FieldsController::class,
			'action' => 'create',
			'methods' => [Request::METHOD_POST]
		]
	];

	public function handle(Request $request) : Response
	{
		$response = Response::getInstance();

		$route = null;
		if(
			$this->routes[$request->getPath()]
			&& in_array($request->getMethod(), $this->routes[$request->getPath()]['methods'])
		) {
			$route = $this->routes[$request->getPath()];
		}

		if(is_null($route)) {
			return $response->setHeader('HTTP/1.0 404 Not Found');
		}

		$container = Container::getInstance();
		$controller = new $route['class']($container);
		$method = sprintf('action%s', ucfirst($route['action']));

		try {
			$result = $controller->$method($request);
		} catch (NotFoundHttpException $e) {
			return $response->setHeader('HTTP/1.0 404 Not Found');
		}

		$response->setBody($result ?? null);

		return $response;
	}

}