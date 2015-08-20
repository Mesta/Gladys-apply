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
}