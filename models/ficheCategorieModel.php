<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");

class FicheCategorie extends Model {

    protected static $persisted_fields = array("fiche_id", "categorie_id");
    protected static $table_name = "fiche_categorie";

    public $fiche_id;
    public $categorie_id;

    # ---------------
    # function filll
    # Behaviour : Fill model from hash array
    # Input : $row : Hash
    # Output: none
    # ---------------
    public function fill( $row ) {
        $this->fiche_id = $row["fiche_id"];
        $this->categorie_id = $row["categorie_id"];
    }

    public function getCategorie(){
        return Categorie::find(array("id" => $this->categorie_id));
    }
}