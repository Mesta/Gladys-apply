<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");
require_once("categorieCategorieModel.php");

class Categorie extends Model {

    protected static $persisted_fields = array("id", "libelle");
    protected static $table_name = "categorie";

    public $id;
    public $libelle;

    private $fiches;
    private $sous_categories;

    # ---------------
    # function filll
    # Behaviour : Fill model from hash array
    # Input : $row : Hash
    # Output: none
    # ---------------
    public function fill( $row ) {
        $this->libelle = $row["libelle"];
    }

    public function __toString(){
        return (string)$this->libelle;
    }

    public function getFiches(){
        $ficheCategories = FicheCategorie::find(array("categorie_id" => $this->id));

        $this->fiches = array();

        foreach($ficheCategories as $ficheCategorie){
            $this->fiches[] = $ficheCategorie->getFiche()[0];
        }
        return $this->fiches;
    }

    public function getSubCategories(){
        $categories = CategorieCategorie::find(array("mother_id" => (integer)$this->id));

        $this->sous_categories = array();

        foreach($categories as $categorie){
            $this->sous_categories[] = $categorie->getDaughter()[0];
        }

        return $this->sous_categories;
    }
}