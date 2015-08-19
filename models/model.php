<?php

# ---------------------------------
# File : ficheModel.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

abstract class Model {
	private $persisted;
	protected $table_name;
	protected $persisted_fields;

	# ------------------------
	# function Model
	# Behaviour : default constructor
	# Input : none
	# Output: none
	# ------------------------
	public function Model(){
		$this->persisted = false;
		$this->table_name = strtolower(get_class($this));
	}

	# ------------------------
	# function save
	# Behaviour : Check if this object is persisted or not
	# Input : none
	# Output: none
	# ------------------------
	public function save(){
		$retour = false;
		if($this->persisted) {
			$retour = $this->update();
		}
		else {
			$retour = $this->create();
		}
		return $retour;
	}

	# ------------------------
	# function createFiche
	# Behaviour : create row for fiche in db
	# Input : none
	# Output: true or false
	# ------------------------
	private function create(){
		$sql = "INSERT INTO $this->table_name(";

			for($cpt=0; $cpt < count($this->persisted_fields); $cpt++){
				$sql .= $this->persisted_fields[$cpt];

			// Add comma between field except the last
				if($cpt < (count($this->persisted_fields) - 1))
					$sql .= ",";
			}

			$sql .= ") VALUES (";

			for($cpt=0; $cpt < count($this->persisted_fields); $cpt++){
			// Access to field getter by concat get + persisted field name
			// ucfirst : Uppercase first letter of array element (string)
				$sql .= "'" . $this->{"get" . ucfirst($this->persisted_fields[$cpt])}() . "'";

			// Add comma between field except the last
				if($cpt < (count($this->persisted_fields) - 1))
					$sql .= ",";
			}
			$sql .= ");";

		return $this->persist($sql);
	}


	protected function persist($sql){
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
}