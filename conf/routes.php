<?php

# ---------------------------------
# File : routes.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# ---------------------------------

class Routes {
	private $__routes;

	public function Routes() {
		$__routes = array();
		$__routes["/"] = array("controller" => "application", "method" => "index");
	}

	public function getRoute($url) {
		pre($this->__routes);
		$route = $this->__routes[$url];

		if($route == null or $route == '') {
    		http_response_code(404);
    		include_once("../views/not_found.html");
    		exit;
		}
		
		return $route;
	}
}

?>