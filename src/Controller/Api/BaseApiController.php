<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 25.03.2019
 * Time: 7:17
 */

namespace App\Controller\Api;


use App\Container;
use App\Request;
use App\Response;

abstract class BaseApiController
{

	/** @var Container  */
	protected $_container;

	public function __construct(Container $container)
	{
		$this->_container = $container;
	}

	protected function getRequestData(Request $request) {
		$body = $request->getBody();

		$data = json_decode($body, TRUE);

		return $data ?: [];
	}

	protected function setUpResponse(array $data, int $status = Response::STATUS_OK) :string {
		$response = Response::getInstance();

		$response->setHeader('Content-type', 'application/json; charset=UTF-8');
		http_response_code($status);

		return json_encode($data);
	}

}