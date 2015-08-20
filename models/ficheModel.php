<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");
require_once("ficheCategorieModel.php");

class Fiche extends Model {

    protected static $persisted_fields = array("id", "libelle", "description");
    protected static $table_name = "fiche";

    public $id;
    public $libelle;
    public $description;

    private $categories;

    # ---------------
    # function filll
    # Behaviour : Fill model from hash array
    # Input : $row : Hash
    # Output: none
    # ---------------
    public function fill( $row ) {
        $this->libelle = $row["libelle"];
        $this->description = $row["description"];
    }

    public function getCategories(){
        $ficheCategories = FicheCategorie::find(array("fiche_id" => $this->id));

        $this->categories = array();

        foreach($ficheCategories as $ficheCategorie){
            $this->categories[] = $ficheCategorie->getCategorie()[0];
        }
        return $this->categories;
    }
}