<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

abstract class Model {
    protected static $persisted_fields;

    private $is_persisted;

    # ------------------------
    # function Model
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function Model(){
        $this->is_persisted = false;
    }

    # ------------------------
    # function save
    # Behaviour : Check if this object is persisted or not
    # Input : none
    # Output: none
    # ------------------------
    public function save(){
        $retour = false;
        if($this->is_persisted) {
            $retour = $this->update();
        }
        else {
            $retour = $this->create();
        }
        return $retour;
    }

    # ------------------------
    # function static find
    # Behaviour : Get row from DB pointed by $id parameter
    # Input : mixed content
    # Output: none
    # ------------------------
    public static function find( $id ) {
        $class = get_called_class();
        $table_name = $class::$table_name;

        $retour = null;

        $sql = "SELECT ";

        // Add persisted fields
        for($cpt = 0; $cpt < count($class::$persisted_fields); $cpt++){
            $sql .= $class::$persisted_fields[$cpt];

            // Add comma between field except the last
            if($cpt < (count($class::$persisted_fields) - 1))
                $sql .= ",";
        }

        $sql .= " FROM $table_name WHERE id = " . $id . ";";

        $db_adr  = Configuration::getConfiguration("db_adress");
        $db_name = Configuration::getConfiguration("db_name");
        $db_user = Configuration::getConfiguration("db_user");
        $db_pwd  = Configuration::getConfiguration("db_password");

        $dsn = "mysql:host=$db_adr;dbname=$db_name";

        try {
            $dbh = new PDO($dsn, $db_user, $db_pwd);

            $stmt = $dbh->query($sql);
            $row = $stmt->fetchAll(PDO::FETCH_OBJ)[0];

            // Convert StdObject to Array
            $data = array();
            $retour = new $class();
            foreach($class::$persisted_fields as $key){
                $retour->{"set" . ucfirst($key)}($row->$key);
            }
            $retour->is_persisted = true;
        } catch (PDOException $e) {
            $_SESSION["notice"]["error"][] = "Une erreur est survenue durant l'accès à la base de données.";
        }

        return $retour;
    }

    # ------------------------
    # function static all
    # Behaviour : Get row from DB
    # Input : none
    # Output: Model instance
    # ------------------------
    public static function all( ) {
        $retour = array();

        $class = get_called_class();
        $table_name = $class::$table_name;

        $sql = "SELECT * FROM $table_name;";

        $db_adr  = Configuration::getConfiguration("db_adress");
        $db_name = Configuration::getConfiguration("db_name");
        $db_user = Configuration::getConfiguration("db_user");
        $db_pwd  = Configuration::getConfiguration("db_password");

        $dsn = "mysql:host=$db_adr;dbname=$db_name";

        try {
            $dbh = new PDO($dsn, $db_user, $db_pwd);

            $stmt = $dbh->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

            foreach($rows as $row) {
                $obj  = new $class();
                foreach ($class::$persisted_fields as $key) {
                    $obj->{"set" . ucfirst($key)}($row->$key);
                }
                $retour[] = $obj;
            }
        } catch (PDOException $e) {
            $_SESSION["notice"]["error"][] = "Une erreur est survenue durant l'accès à la base de données.";
        }
        return $retour;
    }

    # ------------------------
    # function create
    # Behaviour : create row for current Model
    # Input : none
    # Output: true or false
    # ------------------------
    private function create(){
        $class = get_class($this);
        $table_name = $class::$table_name;
        $sql = "INSERT INTO $table_name(";

        for($cpt=0; $cpt < count($class::$persisted_fields); $cpt++){
            $sql .= $class::$persisted_fields[$cpt];

            // Add comma between field except the last
            if($cpt < (count($class::$persisted_fields) - 1))
                $sql .= ",";
        }

        $sql .= ") VALUES (";

        for($cpt = 0; $cpt < count($class::$persisted_fields); $cpt++){
            // Access to field getter by concat get + persisted field name
            // ucfirst : Uppercase first letter of array element (string)
            $sql .= "'" . $this->{"get" . ucfirst($class::$persisted_fields[$cpt])}() . "'";

            // Add comma between field except the last
            if($cpt < (count($class::$persisted_fields) - 1))
                $sql .= ",";
        }
        $sql .= ");";

        return $this->persist($sql);
    }

    # ------------------------
    # function update
    # Behaviour : update row of current Model
    # Input : none
    # Output: true or false
    # ------------------------
    private function update(){
        $class = get_class($this);
        $table_name = $class::$table_name;

        $sql = "UPDATE $table_name SET ";

        for($cpt = 0; $cpt < count($class::$persisted_fields); $cpt++){
            $field_name = $class::$persisted_fields[$cpt];
            if($field_name != "id") {

                // Access to field getter by concat get + persisted field name
                // ucfirst : Uppercase first letter of array element (string)
                $sql .= "$field_name = '" . $this->{"get".ucfirst($field_name)}() . "'";

                // Add comma between field except the last
                if ($cpt < (count($class::$persisted_fields) - 1))
                    $sql .= ", ";
            }
        }

        $sql .= " WHERE id = ". $this->getId();
        return $this->persist($sql);
    }

    # ------------------------
    # function persist
    # Behaviour : Handle SQL execution for persist Model objects
    # Input : SQL query as string
    # Output: true or false, can store a flash message for user feedback
    # ------------------------
    private function persist($sql){
        $retour = false;

        $db_adr  = Configuration::getConfiguration("db_adress");
        $db_name = Configuration::getConfiguration("db_name");
        $db_user = Configuration::getConfiguration("db_user");
        $db_pwd  = Configuration::getConfiguration("db_password");

        $dsn = "mysql:host=$db_adr;dbname=$db_name";

        try {
            $dbh = new PDO($dsn, $db_user, $db_pwd);

            if($dbh->exec($sql)){
                $this->setId($dbh->lastInsertId());
                $retour = true;
            }
            else{
                $retour = false;
            }

        } catch (PDOException $e) {
            $_SESSION["notice"]["error"][] = "Une erreur est survenue durant l'accès à la base de données.";
            return false;
        }
        return $retour;
    }

    abstract public function setId($id);
}