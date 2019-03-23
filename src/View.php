<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 22:15
 */

namespace App;

class View
{
	/**
	 * @param string $view
	 * @param array $params
	 * @return string
	 */
	public function render(string $view, array $params = []) {
		foreach($params as $k => $v) {
			$$k = $v;
		}

		ob_start();
		include sprintf('../views/%s.php', $view);
		return ob_get_clean();
	}

}