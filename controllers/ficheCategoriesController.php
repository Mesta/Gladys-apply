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

    private static $allow_params = array("fiche_id", "categorie_id");

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
        $ficheCategorie = new FicheCategorie();

        // If POST request, check data and create FicheCategorie object
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $params = $this->params_categorie();
            $params["fiche_id"] = (int)$params["fiche_id"];
            $params["categorie_id"] = (int)$params["categorie_id"];

            $ficheCategorie->fill($params);

            // And save it
            $res = $ficheCategorie->create();
            if ($res) {

                FlashHelpers::getFlashHelpers()->addSuccess("La catégorie a bien été ajouté.");

                // Prepare callback path based on route request (check regex in Routes class)
                $callback = $request["callback"];

                // Different callback if it goes to categorie
                if($callback === "categories"){
                    $callback .= "/".$request["categorie_id"];
                }

                header("Location: /$callback");
            } else {
                FlashHelpers::getFlashHelpers()->addError("Une erreur est survenue lors du traitement de votre requête.");
            }
        }

        if (isset($res) && !$res or !isset($res)) {

            $this->view = joinPath(array($this->viewFolder, "form.php"));

            // Pass parameters to the view
            $data = array(
                "url" => $_SERVER['REQUEST_URI'],
                "categorie" => $ficheCategorie,
            );

            // Override params if request come from fiche page
            if (isset($request["fiche_id"])) {
                $data["title"] = "Ajouter une catégorie";
                $data["fiche_id"] = $request["fiche_id"];
            }
            elseif(isset($request["categorie_id"])){
                $data["title"] = "Ajouter une fiche";
                $data["categorie_id"] = $request["categorie_id"];
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
    public function destroy($request){
        // Get params and cast them to integer
        $categorie_id   = (int)$request["categorie_id"];
        $fiche_id       = (int)$request["fiche_id"];

        $find_params = array("fiche_id" => $fiche_id, "categorie_id" => $categorie_id);

        // Load categorie from database
        $ficheCategorie = FicheCategorie::find($find_params)[0];

        $callback = $request["callback"];

        if($ficheCategorie->destroy($find_params)){

            FlashHelpers::getFlashHelpers()->addSuccess("La fiche n'appartiens plus à cette catégorie.");

            // Different callback if it goes to categorie
            if($callback == "categories") {
                $callback .= "/" . $request["categorie_id"];
            }

            header("Location:/$callback");
        }
        else{
            FlashHelpers::getFlashHelpers()->addError("Une erreur s'est produite lors du traitement de votre requête.");
            header("Location:/$callback");
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
                    $clean[$key] = htmlentities($value, ENT_QUOTES);
                }
            }
        }

        return $clean;
    }
}
