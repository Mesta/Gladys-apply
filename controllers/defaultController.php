<?php

# ---------------------------------
# File : DefaultController.php
# Creator : Jeremy Lardet
# Date : 19/08/2015
# ---------------------------------
require_once("../conf/configuration.php");
require_once("../helpers/application_helpers.php");
require_once("controller.php");

class DefaultController extends Controller{

	# ------------------------
	# function DefaultController
	# Behaviour : default constructor
	# Input : none
	# Output: none
	# ------------------------
	public function DefaultController() {
		$this->viewFolder = joinPath(array(
			Configuration::getConfiguration("viewFolder"),
			"default"
			)
		);
		parent::__construct();
	}

	# ------------------------
	# function index
	# Behaviour : Render index page
	# Input : none
	# Output: none
	# ------------------------
	public function index(){
		$this->view = joinPath(array($this->viewFolder, "index.php"));
		$this->renderTemplate();
	}

}
?>