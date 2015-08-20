<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");

class Categorie extends Model {

    protected static $persisted_fields = array("id", "libelle");
    protected static $table_name = "categorie";

    public $id;
    public $libelle;

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
        return $this->libelle;
    }

    public function getFiches(){
        $ficheCategories = FicheCategorie::find(array("categorie_id" => $this->id));

        $this->fiches = array();

        foreach($ficheCategories as $ficheCategorie){
            $this->fiches[] = $ficheCategorie->getFiche()[0];
        }
        return $this->fiches;
    }
}