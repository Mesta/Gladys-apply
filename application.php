<?php

# -----------------------
# File : application.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# -----------------------

require_once "conf/configuration.php";
require_once "conf/router.php";
require_once "helpers/application_helpers.php";
require_once "helpers/database_helpers.php";
require_once "helpers/flash_helpers.php";

require_once "controllers/defaultController.php";
require_once "controllers/fichesController.php";

class Application {
    // Singleton design pattern
    private static $_instance = null;

    public function Application() {
        session_start();
        $this->getRoute();
    }

    # ---------------
    # function getRoute
    # Behaviour : Check if route exist, and call right method on right controller
    # Input : none
    # Output: none
    # ---------------
    private function getRoute() {
        $router = Router::getRouter();

        // Get URI from request
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER["REQUEST_METHOD"];

        // Get handler for this request
        $router = $router->getRoute($url, $method);

        $controller = new $router->controller();
        $controller->{$router->action}($router->params);
    }

    # ------------------------
    # function getInstance
    # Behaviour : return the singleton instance
    # Input : none
    # Output: Instance of Application
    # ------------------------
    public static function getApplication() {
        if(is_null(self::$instance)) {
            self::$instance = new Application();
        }
        return self::$_instance;
    }
}
?>