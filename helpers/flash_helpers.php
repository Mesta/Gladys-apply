<?php
# -----------------------
# File : database_helpers.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# -----------------------

class FlashHelpers{
    private static $instance = null;

    # ---------------
    # function FlashHelpers
    # Behaviour : Default constructor
    # Input : none
    # Output: none
    # ---------------
    public function FlashHelpers(){
        if(! isset($_SESSION["notice"]))
            $_SESSION["notice"] = array();

        if(! isset($_SESSION["notice"]["danger"]))
            $_SESSION["notice"]["danger"] = array();

        if(! isset($_SESSION["notice"]["success"]))
            $_SESSION["notice"]["success"] = array();

        if(! isset($_SESSION["notice"]["info"]))
            $_SESSION["notice"]["info"] = array();
    }

    # ---------------
    # function static getFlashHelpers
    # Behaviour : Get singleton instance, or instanciate it
    # Input : none
    # Output: FlashHelpers instance
    # ---------------
    public static function getFlashHelpers(){
        if(is_null(self::$instance))
            self::$instance = new FlashHelpers();
        return self::$instance;
    }

    # ---------------
    # function addError
    # Behaviour : Add $message to error array
    # Input : string
    # Output: none
    # ---------------
    public function addError($message){
       $_SESSION["notice"]["danger"][] = $message;
    }

    # ---------------
    # function addSuccess
    # Behaviour : Add $message to success array
    # Input : string
    # Output: none
    # ---------------
    public function addSuccess($message){
       $_SESSION["notice"]["success"][] = $message;
    }

    # ---------------
    # function addInfo
    # Behaviour : Add $message to info array
    # Input : string
    # Output: none
    # ---------------
    public function addInfo($message){
       $_SESSION["notice"]["info"][] = $message;
    }

    # ---------------
    # function getDanger
    # Behaviour : return danger array
    # Input : none
    # Output: array
    # ---------------
    public function getDanger(){
        return $_SESSION["notice"]["danger"];
    }

    # ---------------
    # function getSuccess
    # Behaviour : return success array
    # Input : none
    # Output: array
    # ---------------
    public function getSuccess(){
        return $_SESSION["notice"]["success"];
    }

    # ---------------
    # function getInfo
    # Behaviour : return info array
    # Input : none
    # Output: array
    # ---------------
    public function getInfo(){
        return $_SESSION["notice"]["info"];
    }

    # ---------------
    # function flushSuccess
    # Behaviour : Clean danger array
    # Input : none
    # Output: none
    # ---------------
    public function flushDanger(){
        $_SESSION["notice"]["danger"] = array();
    }

    # ---------------
    # function flushSuccess
    # Behaviour : Clean info array
    # Input : none
    # Output: none
    # ---------------
    public function flushInfo(){
        $_SESSION["notice"]["info"] = array();
    }

    # ---------------
    # function flushSuccess
    # Behaviour : Clean success array
    # Input : none
    # Output: none
    # ---------------
    public function flushSuccess(){
        $_SESSION["notice"]["success"] = array();
    }
}
