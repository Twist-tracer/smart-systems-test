<?php
/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 18:46
 */

require_once __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use App\Request;

$kernel = new Kernel();
$request = Request::getInstance();
$response = $kernel->handle($request);
$response->send();
