	<?php

	# -----------------------
	# File : application.php
	# Creator : Jeremy Lardet
	# Date : 18/08/2015
	# -----------------------

	require_once "helpers/application_helpers.php";
	require_once "conf/configuration.php";
	require_once "conf/routes.php";

	require_once "controllers/defaultController.php";
	require_once "controllers/fichescontroller.php";

	class Application {
		// Singleton design pattern
		private static $_instance = null;



		public function Application() {
			session_start();
			$this->getRoute();
		}


		private function getRoute() {
			$router = new Routes();

			// Get URI from request
			$url = $_SERVER['REQUEST_URI'];

			// Get handler for this request
			$route = $router->getRoute($url);

			$controller = new $route["controller"];
			$controller->$route["method"]();
		}

		# ------------------------
		# function getInstance
		# Behaviour : return the singleton instance
		# Input : none
		# Output: Instance of Application
		# ------------------------
		public static function getInstance() {
			if(is_null(self::$_instance)) {
				self::$_instance = new Application();  
			}
			return self::$_instance;
		}
	}
	?>