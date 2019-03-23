<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:26
 */

namespace App;

use App\Traits\Singleton;

class Request
{
	use Singleton;

	private $path;

	private $headers;

	private $get;

	private $post;

	private $body;

	public function __construct()
	{
		$this->path = $this->extractPathFromGlobals();
		$this->get = $_GET;
		$this->post = $_POST;
		$this->body = file_get_contents('php://input');
		$this->headers = $this->extractHeadersFromGlobals();

	}

	/**
	 * @return array
	 */
	public function getQueryParams() :array
	{
		return $this->get;
	}

	/**
	 * @return array
	 */
	public function getPostParams() :array
	{
		return $this->post;
	}

	/**
	 * @return string
	 */
	public function getPath() :string
	{
		return $this->path;
	}

	/**
	 * Извлекает заголовки из $_SERVER и возвращает массив вида ключ->значение
	 *
	 * @return array
	 */
	private function extractHeadersFromGlobals() :array
	{
		$headers = [];

		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}

		return $headers;
	}

	/**
	 * Извлекает путь из $_SERVER
	 *
	 * @return string
	 */
	private function extractPathFromGlobals() :string
	{
		return str_replace("?{$_SERVER['QUERY_STRING']}", '', $_SERVER['REQUEST_URI']);
	}

	/**
	 * @return array
	 */
	public function getHeaders() :array
	{
		return $this->headers;
	}

}