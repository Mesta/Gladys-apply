	<?php

	# -----------------------
	# File : application.php
	# Creator : Jeremy Lardet
	# Date : 18/08/2015
	# -----------------------

	require_once "helpers/application_helpers.php";
	require_once "conf/configuration.php";
	require_once "conf/routes.php";

	class Application {
		private $_conf;

		public function Application() {
			session_start();
			$_conf = new Configuration();
			$this->getRoute();
		}

		private function getRoute() {
			$router = new Routes();

			// Get URI from request
			$url = $_SERVER['REQUEST_URI'];

			// Get handler for this request
			$route = $router->getRoute($url);

			$route["controller"]->$route["method"];
		}
	}
	?>