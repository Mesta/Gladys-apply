<?php

# ---------------------------------
# File : DefaultController.php
# Creator : Jeremy Lardet
# Date : 19/08/2015
# ---------------------------------
require_once("../conf/configuration.php");
require_once("../helpers/application_helpers.php");
require_once("controller.php");

require_once("../models/ficheModel.php");

class FichesController extends Controller{

	private static $allow_params = array("libelle", "description");

	# ------------------------
	# function FichesController
	# Behaviour : default constructor
	# Input : none
	# Output: none
	# ------------------------
	public function FichesController() {
		$this->viewFolder = joinPath(array(
			Configuration::getConfiguration("viewFolder"),
			"fiches"
			)
		);
		parent::__construct();
	}

	# ------------------------
	# function index
	# Behaviour : render index template
	# Input : none
	# Output: render tempate & view index
	# ------------------------
	public function index() {
		$this->view = joinPath(array($this->viewFolder, "index.php"));
		$this->renderTemplate();
	}

	# ------------------------
	# function create
	# Behaviour : render new template
	# Input : none
	# Output: render template & view new
	# ------------------------
	public function create() {

		// If POST request, check data and create Fiche object
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$fiche = new Fiche($this->new_params());
			if($fiche->save()){
				echo "salut";
				$_SESSION["notice"]["success"][] = "La fiche a bien été créée.";
				header("Location: /fiches");
			}
		}
		
		$this->view = joinPath(array($this->viewFolder, "form.php"));
		$this->renderTemplate();
	}

	# ------------------------
	# function create
	# Behaviour : check posted data, filter & sanitize them
	# Input : none
	# Output: array
	# ------------------------
	private function new_params(){
		$clean = array();

		// Check posted data
		if(isset($_POST["fiche"])) { 

			// Check if each posted data are ine the whitelist
			foreach($_POST["fiche"] as $key => $value) {

				// If it's ok : filled the returned array
				if(in_array($key, FichesController::$allow_params)) {
					$clean[$key] = htmlentities($value);
				}
			}
		}
		
		return $clean;
	}
}
?>