<?php

# ---------------------------------
# File : FicheCategoriesController.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------
require_once("../conf/configuration.php");
require_once("../helpers/application_helpers.php");
require_once("controller.php");

require_once("../models/categorieModel.php");

class FicheCategoriesController extends Controller{

    private static $allow_params = array("fiche_id", "categorie_id", "callback");

    # ------------------------
    # function FicheCategoriesController
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function FicheCategoriesController() {
        $this->viewFolder = joinPath(array(
                Configuration::getConfiguration("viewFolder"),
                "ficheCategories"
            )
        );
        parent::__construct();
    }

    # ------------------------
    # function create
    # Behaviour : render new template
    # Input : none
    # Output: render template & view new
    # ------------------------
    public function create($params)
    {
        $ficheCategorie = new FicheCategorie();

        // If POST request, check data and create FicheCategorie object
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $params = $this->params_categorie();
            $ficheCategorie->fill($params);

            // And save it
            $res = $ficheCategorie->create();
            if ($res) {
                $callback = $params["callback"];
                FlashHelpers::getFlashHelpers()->addSuccess("La catégorie a bien été ajouté.");
                header("Location: $callback");
            } else {
                FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue lors de la création de la categorie.");
            }
        }

        if (isset($res) && !$res or !isset($res)) {

            $this->view = joinPath(array($this->viewFolder, "form.php"));

            $data = array(
                "url" => $_SERVER['REQUEST_URI'],
                "categorie" => $ficheCategorie,
            );

            if (isset($params["fiche_id"])) {
                $data["title"] = "Ajouter une catégorie";
                $data["fiche_id"] = $params["fiche_id"];
            }

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
        $categorie = Categorie::find($params["categorie_id"]);

        // Translate params to array with index "db-named field"
        $select["id"] = $params["categorie_id"];

        if($categorie->destroy($select)){
            // Flash message success
            FlashHelpers::getFlashHelpers()->addSuccess("La categorie a bien été supprimée.");
            header('Location:/ficheFicheCategories');
        }
        else{
            FlashHelpers::getFlashHelpers()->addError("Une erreur s'est produite durant la suppression de la categorie.");
            header('Location:/ficheFicheCategories');
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
        if(isset($_POST["ficheCategorie"])) {

            // Check if each posted data are in the whitelist
            foreach($_POST["ficheCategorie"] as $key => $value) {

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