<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

class Model {
    protected static $persisted_fields;

    # ------------------------
    # function static find
    # Behaviour : Get row from DB pointed by $id parameter
    # Input : hash : column name => $value
    # Output: none
    # ------------------------
    public static function find( $params = array() ) {
        $class = get_called_class();
        $table_name = $class::$table_name;

        $retour = null;

        $sql = "SELECT * FROM $table_name";

        if(count($params) > 0) {
            $sql .= " WHERE ";
            foreach ($params as $column_name => $value) {
                switch(gettype($value)){
                    case "string":
                        $sql .= "$column_name = '$value'";
                        break;
                    case "int":
                        $sql .= "$column_name = $value";
                        break;
                    default:
                        break;
                }
            }
        }

        $sql .= ";";

        // Get db connector
        $dbh = DBHelpers::getDBHelpers();
        // Try to execute SQL (connection + query)
        try{
            $retour = $dbh->select($sql, $class);
        }catch(Exception $e){
            $_SESSION["notice"]["error"][] = $e->getMessage();
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

        $sql = "SELECT * FROM $table_name ORDER BY id DESC;";

        // Get db connector
        $dbh = DBHelpers::getDBHelpers();
        // Try to execute SQL (connection + query)
        try{
            $retour  = $dbh->select($sql, $class);
        }catch(Exception $e){
            $_SESSION["notice"]["error"][] = $e->getMessage();
        }
        return $retour;
    }

    # ------------------------
    # function create
    # Behaviour : create row for current Model
    # Input : none
    # Output: true or false
    # ------------------------
    public function create(){
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
            // Access to field
            $field = $class::$persisted_fields[$cpt];
            $val = $this->$field;
            $sql .= "'$val'";

            // Add comma between field except the last
            if($cpt < (count($class::$persisted_fields) - 1))
                $sql .= ",";
        }
        $sql .= ");";

        $connector = DBHelpers::getDBHelpers();
        return $connector->create($sql);
    }

    # ------------------------
    # function update
    # Behaviour : update row of current Model
    # Input : none
    # Output: true or false
    # ------------------------
    public function update(){
        $class = get_class($this);
        $table_name = $class::$table_name;

        $sql = "UPDATE $table_name SET ";

        for($cpt = 0; $cpt < count($class::$persisted_fields); $cpt++){
            $field_name = $class::$persisted_fields[$cpt];
            if($field_name != "id") {

                // Access to field getter by concat get + persisted field name
                // ucfirst : Uppercase first letter of array element (string)
                $sql .= "$field_name = '" . $this->$field_name. "'";

                // Add comma between field except the last
                if ($cpt < (count($class::$persisted_fields) - 1))
                    $sql .= ", ";
            }
        }
        $sql .= " WHERE id = ". $this->id;

        $connector = DBHelpers::getDBHelpers();
        return $connector->update($sql);
    }

    # ------------------------
    # function destroy
    # Behaviour : Destroy row
    # Input : params containing id
    # Output: none
    # ------------------------
    public function destroy($params){

        $class = get_class($this);
        $table_name = $class::$table_name;
        $sql = "DELETE FROM $table_name WHERE ";

        $cpt = 0;
        foreach($params as $field => $value){
            $sql .= "$field = $value";
            if($cpt < count($params) -1)
                $sql .= " AND ";
        }

        echo $sql;
        $connector = DBHelpers::getDBHelpers();
        return $connector->delete($sql);
    }
}