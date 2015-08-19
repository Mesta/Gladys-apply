<?php

# ---------------------------------
# File : routes.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# ---------------------------------

class Routes {
	private $__routes;

	public function Routes() {
		$this->__routes = array(
			"/" => array("controller" => "defaultController", "method" => "index"),
			"/fiches" => array("controller" => "fichesController", "method" => "index"),
			"/fiches/nouveau" => array("controller" => "fichesController", "method" => "create"),
			);
	}

	public function getRoute($url) {

		if(isset($this->__routes[$url]))
			return $this->__routes[$url];
		else{
			http_response_code(404);
			include_once("../views/not_found.html");
			exit;
		}		
	}
}

?>