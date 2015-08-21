<?php

# ---------------------------------
# File : route.php
# Creator : Jeremy Lardet
# Date : 19/08/2015
# ---------------------------------

class Route {
    private $patternURL;
    public $controller;
    public $method;
    public $action;
    public $params;


    # ------------------------
    # function Route
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function Route($controller, $action, $patternURL, $method, $params = array()){
        $this->controller 	= $controller;
        $this->action 		= $action;
        $this->method		= $method;
        $this->patternURL	= $patternURL;

        foreach($params as $param){
            $this->params[$param] = null;
        }
    }

    # ------------------------
    # function matchPattern
    # Behaviour : Check if url match the pattern
    # 	If it does : get params from url & return true
    #	If it does not : return false
    # Input : string formated as url
    # Output: true or false
    # ------------------------
    public function matchPattern($url, $method){

        if($method == $this->method){
            $matches = array();

            // Check if url match & get groups
            $res = preg_match($this->patternURL, $url, $matches);

            // If it matches
            if($res == 1){

                // Get expected params from url
                if(count($this->params) > 0){

                    foreach($this->params as $key => $param){
                        $this->params[$key] = $matches[$key];
                    }
                }

                // And finally
                $retour = true;
            }
            else{
                $retour = false;
            }
        }
        else {
            $retour = false;
        }

        return $retour;

    }
}
