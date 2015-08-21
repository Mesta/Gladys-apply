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

class CategorieCategoriesController extends Controller{

    private static $allow_params = array("mother_id", "daughter_id");

    # ------------------------
    # function FicheCategoriesController
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function CategorieCategoriesController() {
        $this->viewFolder = joinPath(array(
                Configuration::getConfiguration("viewFolder"),
                "categorieCategories"
            )
        );
        parent::Controller();
    }

    # ------------------------
    # function create
    # Behaviour : render new template
    # Input : none
    # Output: render template & view new
    # ------------------------
    public function create($request)
    {
        $categorieCategorie = new CategorieCategorie();

        // If POST request, check data and create FicheCategorie object
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $params = $this->params_categorie();

            $params["mother_id"] = (int)$params["mother_id"];
            $params["daughter_id"] = (int)$params["daughter_id"];

            $categorieCategorie->fill($params);

            // And save it
            $res = $categorieCategorie->create();
            if ($res) {
                FlashHelpers::getFlashHelpers()->addSuccess("La sous-catégorie a bien été ajouté.");
                header("Location: /categories/".$request["mother_id"]);
            } else {
                FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue durant l'ajout de la sous-catégorie.");
            }
        }

        if (isset($res) && !$res or !isset($res)) {

            $this->view = joinPath(array($this->viewFolder, "form.php"));

            // Pass parameters to the view
            $data = array(
                "url" => $_SERVER['REQUEST_URI'],
                "categorieCategorie" => $categorieCategorie,
                "mother_id" => $request["mother_id"],
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
    public function destroy($request){
        // Get params and cast them to integer
        $mother_id      = (int)$request["mother_id"];
        $daughter_id    = (int)$request["daughter_id"];

        $find_params = array("mother_id" => $mother_id, "daughter_id" => $daughter_id);

        // Load categorie from database
        $categorieCategorie = CategorieCategorie::find($find_params)[0];
        $callback = "/categories/$mother_id";

        if($categorieCategorie ->destroy($find_params)){

            FlashHelpers::getFlashHelpers()->addSuccess("La fiche n'appartiens plus à cette catégorie.");
            header("Location:$callback");
        }
        else{
            FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue lors de la suppression de la sous-catégorie.");
            header("Location:$callback");
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
        if(isset($_POST["categorieCategorie"])) {

            // Check if each posted data are in the whitelist
            foreach($_POST["categorieCategorie"] as $key => $value) {

                // If it's ok : filled the returned array
                if(in_array($key, self::$allow_params)) {
                    $clean[$key] = htmlentities($value, ENT_QUOTES);
                }
            }
        }

        return $clean;
    }
}
