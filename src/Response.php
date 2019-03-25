<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 20:26
 */

namespace App;

use App\Traits\Singleton;

class Response
{
	use Singleton;

	const STATUS_OK = 200;

	const STATUS_BAD_REQUEST = 400;

	const STATUS_INTERNAL_SERVER_ERROR = 500;

	private $headers;

	private $body;

	/**
	 * @param array $headers
	 *
	 * @return $this
	 */
	public function setHeaders(array $headers)
	{
		$this->headers = $headers;

		return $this;
	}

	/**
	 * @param string $val,
	 * @param string|null $name,
	 *
	 * @return $this
	 */
	public function setHeader(string $val, string $name = NULL)
	{
		if(empty($name)) {
			$this->headers[] = $val;
		} else {
			$this->headers[$name] = $val;
		}

		return $this;
	}

	/**
	 * @return array|null
	 */
	public function getHeaders() :? array
	{
		return $this->headers;
	}

	/**
	 * @param string $body
	 *
	 * @return $this
	 */
	public function setBody(string $body)
	{
		$this->body = $body;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getBody() :? string
	{
		return $this->body;
	}

	/**
	 * @return void
	 */
	public function send()
	{
		if(!empty($this->getHeaders())) {
			foreach ($this->getHeaders() as $name => $header) {
				if(is_string($name)) {
					header(sprintf('%s: %s', $name, $header));
				} else {
					header($header);
				}
			}
		}

		!empty($this->body) ? die($this->body) : die();
	}

}