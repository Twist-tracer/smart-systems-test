<?php

/**
 * Created by PhpStorm.
 * User: twist
 * Date: 23.03.2019
 * Time: 19:23
 */

namespace App;
use App\Persister\FieldPersister;
use App\Persister\UserFieldPersister;
use App\Persister\UserPersister;
use App\Repository\FieldRepository;
use App\Repository\UserFieldRepository;
use App\Repository\UserRepository;
use App\Service\UserService;

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
		$this->boot();

		$router = Router::getInstance();
		return $router->handle($request);
	}

	private function boot() {
		@session_start();

		$this->setUpContainer();
	}

	private function setUpContainer() {
		$container = Container::getInstance();

		$container
			->set(DataBase::class, function(Container $container) {
				$config = require_once __DIR__.'/../config/db.php';

				$config['dsn'] .= ';charset='.$config['charset'];
				$db = new DataBase($config['dsn'], $config['username'], $config['password']);

				$db->exec('set names ' . $config['charset']);

				return $db;
			})
			->set(UserRepository::class, function(Container $container) {
				return new UserRepository($container->get_data_base());
			})
			->set(UserPersister::class, function(Container $container) {
				return new UserPersister($container->get_data_base());
			})
			->set(FieldRepository::class, function(Container $container) {
				return new FieldRepository($container->get_data_base());
			})
			->set(FieldPersister::class, function(Container $container) {
				return new FieldPersister($container->get_data_base());
			})
			->set(UserFieldRepository::class, function(Container $container) {
				return new UserFieldRepository($container->get_data_base());
			})
			->set(UserFieldPersister::class, function(Container $container) {
				return new UserFieldPersister($container->get_data_base());
			})
			->set(UserService::class, function(Container $container) {
				return new UserService(
					$container->get_user_repository(),
					$container->get_user_persister()
				);
			});
	}
}