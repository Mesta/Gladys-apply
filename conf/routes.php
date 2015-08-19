<?php

# ---------------------------------
# File : routes.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# ---------------------------------

require_once "route.php";

class Routes {
    private $routes;

    public function Routes() {
        $this->routes = array(
            new Route("fichesController", 	"index", 	"#^\/fiches$#", "GET"),
            //new Route("fichesController", 	"show", 	"#^\/fiches\/(?P<fiche_id>\d)$#", "GET"   , array("fiche_id")),
            new Route("fichesController", 	"create", 	"#^\/fiches\/nouveau$#", "GET"),
            new Route("fichesController", 	"create", 	"#^\/fiches\/nouveau$#", "POST"),
            new Route("fichesController", 	"update", 	"#^\/fiches\/(?P<fiche_id>\d)\/modifier$#", "GET"   , array("fiche_id")),
            new Route("fichesController", 	"update", 	"#^\/fiches\/(?P<fiche_id>\d)\/modifier$#", "POST"  , array("fiche_id")),
            new Route("fichesController", 	"destroy", 	"#^\/fiches\/(?P<fiche_id>\d)\/supprimer$#","DELETE", array("fiche_id")),

            new Route("defaultController", 	"index", "#^\/$#", "GET"),


        );
    }

    # ------------------------
    # function getRoute
    # Behaviour : Find the right route
    # Input : string formated as an url
    # Output: Route object or 404
    # ------------------------
    public function getRoute($url, $method) {
        $cpt = 0;
        $match = false;

        while($cpt < count($this->routes) && !$match) {
            $route = $this->routes[$cpt];
            $match = $route->matchPattern($url, $method);
            $cpt++;
        }

        if($match){
            return $route;
        }
        else{
            http_response_code(404);
            include_once("../web/404.html");
            exit;
        }

    }
}

?>