<?php

# ---------------------------------
# File : CategoriesController.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------
require_once("../conf/configuration.php");
require_once("../helpers/application_helpers.php");
require_once("controller.php");

require_once("../models/categorieModel.php");

class CategoriesController extends Controller{

    private static $allow_params = array("libelle", "description");

    # ------------------------
    # function CategoriesController
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function CategoriesController() {
        $this->viewFolder = joinPath(array(
                Configuration::getConfiguration("viewFolder"),
                "categories"
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
        $categories = Categorie::all();
        $this->view = joinPath(array($this->viewFolder, "index.php"));

        $data = array("categories" => $categories);
        $this->renderTemplate($data);
    }

    # ------------------------
    # function create
    # Behaviour : render new template
    # Input : none
    # Output: render template & view new
    # ------------------------
    public function create() {
        $categorie = new Categorie();

        // If POST request, check data and create Categorie object
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Instanciate new Categorie
            $categorie = new Categorie();
            $categorie->fill($this->params_categorie());

            // And save it
            $res = $categorie->create();
            if($res){
                FlashHelpers::getFlashHelpers()->addSuccess("La categorie a bien été créée.");
                header("Location: /categories");
            }else{
                FlashHelpers::getFlashHelpers()->addSuccess("Une erreur est survenue lors de la création de la catégorie.");
            }
        }

        if (isset($res) && !$res or !isset($res)) {

            $this->view = joinPath(array($this->viewFolder, "form.php"));

            $data = array(
                "title" => "Nouvelle catégorie",
                "url"   => $_SERVER['REQUEST_URI'],
                "categorie" => $categorie,
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
        // Load categorie from database
        $categorie = Categorie::find(array("id" => $params["categorie_id"]))[0];

        // If POST request, check data and create Categorie object
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // Update fields
            $categorie->fill($this->params_categorie());
            $res = $categorie->update();

            if ($res !== false) {
                if ($res === 0) {
                    FlashHelpers::getFlashHelpers()->addInfo("Vous n'avez rien changé du tout :-).");
                    header("Location: /categories/$categorie->id/modifier");
                } else {
                    FlashHelpers::getFlashHelpers()->addSuccess("La categorie a bien été modifiée.");
                    header("Location: /categories");
                }
            } else {
                FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue durant la modification de la catégorie.");
            }
        }

        if (isset($res) && !$res or !isset($res)) {
            $this->view = joinPath(array($this->viewFolder, "form.php"));
            $data = array(
                "title"     => "Modifier la catégorie",
                "url"       => $_SERVER['REQUEST_URI'],
                "categorie" => $categorie,
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
        // Load categorie from database
        $categorie = Categorie::find(array("id" => $params["categorie_id"]))[0];

        // Translate params to array with index "db-named field"
        $select["id"] = $params["categorie_id"];

        if($categorie->destroy($select)){
            // Flash message success
            FlashHelpers::getFlashHelpers()->addSuccess("La categorie a bien été supprimée.");
            header('Location:/categories');
        }
        else{
            FlashHelpers::getFlashHelpers()->addError("Une erreur s'est produite durant la suppression de la categorie.");
            header('Location:/categories');
        }
    }

    # ------------------------
    # function new_params
    # Behaviour : check posted data, filter & sanitize them
    # Input : none
    # Output: array
    # ------------------------
    private function params_categorie(){
        $clean = array();

        // Check posted data is nested in "categorie"
        if(isset($_POST["categorie"])) {

            // Check if each posted data are in the whitelist
            foreach($_POST["categorie"] as $key => $value) {

                // If it's ok : filled the returned array
                if(in_array($key, self::$allow_params)) {
                    $clean[$key] = htmlentities($value);
                }
            }
        }

        return $clean;
    }
}
?>