<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

require_once("model.php");

class Fiche extends Model {

    protected static $persisted_fields = array("id", "libelle", "description");
    protected static $table_name = "fiche";

    private $id;
    private $libelle;
    private $description;

    # ------------------------
    # function Fiche
    # Behaviour : default constructor
    # Input : Hash array
    # Output: none
    # ------------------------
    public function Fiche(){
        $this->libelle = "";
        $this->description = "";
        parent::__construct();
    }

    # ------------------------
    # function getId
    # Behaviour : return id
    # Input : none
    # Output: String
    # ------------------------
    public function getId(){
        return $this->id;
    }

    # ------------------------
    # function setId
    # Behaviour : Set id
    # Input : int
    # Output: none
    # ------------------------
    public function setId($id){
        $this->id = $id;
    }

    # ------------------------
    # function getLibelle
    # Behaviour : return libelle
    # Input : none
    # Output: String
    # ------------------------
    public function getLibelle(){
        return $this->libelle;
    }

    # ------------------------
    # function getDescription
    # Behaviour : return description
    # Input : none
    # Output: String
    # ------------------------
    public function getDescription(){
        return $this->description;
    }

    # ------------------------
    # function setLibelle
    # Behaviour : set libelle value
    # Input : String
    # Output: none
    # ------------------------
    public function setLibelle($libelle){
        $this->libelle = $libelle;
    }

    # ------------------------
    # function setDescription
    # Behaviour : set description value
    # Input : String
    # Output: none
    # ------------------------
    public function setDescription($description){
        $this->description = $description;
    }

    public function fill( $row ) {
        $this->libelle = $row["libelle"];
        $this->description = $row["description"];
    }
}