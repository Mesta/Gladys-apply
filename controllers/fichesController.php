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
        $fiches = Fiche::all();
        $this->view = joinPath(array($this->viewFolder, "index.php"));

        $data = array("fiches" => $fiches);
        $this->renderTemplate($data);
    }

    # ------------------------
    # function create
    # Behaviour : render new template
    # Input : none
    # Output: render template & view new
    # ------------------------
    public function create() {
        $fiche = new Fiche();

        // If POST request, check data and create Fiche object
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Instanciate new Fiche
            $fiche = new Fiche();
            $fiche->fill($this->params_fiche());

            // And save it
            if($fiche->create()){
                FlashHelpers::getFlashHelpers()->addSuccess("La fiche a bien été créée.");
                header("Location: /fiches");
            }else{
                FlashHelpers::getFlashHelpers()->addSuccess("Une erreur est survenue lors de la création de la fiche.");
            }
        }
        else {

            $this->view = joinPath(array($this->viewFolder, "form.php"));

            $data = array(
                "url" => $_SERVER['REQUEST_URI'],
                "fiche" => $fiche,
            );
            $this->renderTemplate($data);
        }
    }

    # ------------------------
    # function update
    # Behaviour : check posted data, filter & sanitize them
    # Input : hash array with request parameter
    # Output: none
    # ------------------------
    public function update($params){
        // Load fiche from database
        $fiche = Fiche::find($params["fiche_id"]);

        // If POST request, check data and create Fiche object
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Update fields
            $fiche->fill($this->params_fiche());
            $res = $fiche->update();

            if($res !== false){
                if($res === 0){
                    FlashHelpers::getFlashHelpers()->addInfo("Vous n'avez rien changé du tout :-).");
                    header("Location: /fiches/$fiche->id/modifier");
                }
                else{
                    FlashHelpers::getFlashHelpers()->addSuccess("La fiche a bien été modifiée.");
                    header("Location: /fiches");
                }
            }
            else{
                FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue durant la modification de la fiche.");
                $this->view = joinPath(array($this->viewFolder, "form.php"));
                $data = array(
                    "url"   => $_SERVER['REQUEST_URI'],
                    "fiche" => $fiche,
                );
                $this->renderTemplate($data);
            }
        }else{

            $this->view = joinPath(array($this->viewFolder, "form.php"));
            $data = array(
                "url"   => $_SERVER['REQUEST_URI'],
                "fiche" => $fiche,
            );
            $this->renderTemplate($data);
        }
    }

    # ------------------------
    # function destroy
    # Behaviour : check posted data, filter & sanitize them
    # Input : hash array with request parameter
    # Output: none
    # ------------------------
    public function destroy($params){
        // Load fiche from database
        $fiche = Fiche::find($params["fiche_id"]);

        // Translate params to array with index "db-named field"
        $select["id"] = $params["fiche_id"];

        if($fiche->destroy($select)){
            // Flash message success
            FlashHelpers::getFlashHelpers()->addSuccess("La fiche a bien été supprimée.");
            header('Location:/fiches');
        }
        else{
            FlashHelpers::getFlashHelpers()->addError("Une erreur s'est produite durant la suppression de la fiche.");
            header('Location:/fiches');
        }
    }

    # ------------------------
    # function new_params
    # Behaviour : check posted data, filter & sanitize them
    # Input : none
    # Output: array
    # ------------------------
    private function params_fiche(){
        $clean = array();

        // Check posted data is nested in "fiche"
        if(isset($_POST["fiche"])) {

            // Check if each posted data are in the whitelist
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