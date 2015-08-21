<?php

# ---------------------------------
# File : CategorieCategorie.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");

class CategorieCategorie extends Model {

    protected static $persisted_fields = array("mother_id", "daughter_id");
    protected static $table_name = "categorie_categorie";

    public $mother_id;
    public $daughter_id;

    # ---------------
    # function fill
    # Behaviour : Fill model from hash array
    # Input : $row : Hash
    # Output: none
    # ---------------
    public function fill( $row ) {
        $this->daughter_id  = $row["daughter_id"];
        $this->mother_id    = $row["mother_id"];
    }

    public function getMother(){
        return Categorie::find(array("id" => $this->mother_id));
    }

    public function getDaughter(){
        return Categorie::find(array("id" => $this->daughter_id));
    }
}