<div class="row">
    <div class="col-md-12 align-right">
        <h1><?php echo $data["title"]; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?php echo $data["url"] ?>" method="POST">
            <?php
            if(isset($data["fiche_id"])){
                $fiche_id = $data["fiche_id"];
                echo "<input type='hidden' value='$fiche_id' name='ficheCategorie[fiche_id]' id='ficheCategorie_fiche_id'>";

                // Get All categories from DB
                $all = Categorie::all();

                // Get Categories already linked to this fiche
                $fiche = Fiche::find(array("id" => $fiche_id))[0];
                $fiche_categories = $fiche->getCategories();

                // Diff both array
                // Diff is made calling __toString() magic function from object
                // For this purpose, the string MUST be unique value, or diff fail
                $diff = array_diff($all, $fiche_categories);

                if(count($diff) > 0){
                    echo "<select id ='fichecategorie_categorie_id' name='ficheCategorie[categorie_id]' class='form-control'>";
                    foreach($diff as $categorie){
                        echo "<option value='$categorie->id'>$categorie->libelle</option>";
                    }
                    echo "</select>";
                }
                else
                    echo "<p>Cette fiche appartiens déjà à toutes les catégories.</p>";
            }
            elseif(isset($data["categorie_id"])){
                $categorie_id = $data["categorie_id"];
                echo "<input type='hidden' value='$categorie_id' name='ficheCategorie[categorie_id]' id='ficheCategorie_categorie_id'>";

                // Get All categories from DB
                $all = Fiche::all();

                // Get Categories already linked to this fiche
                $categorie = Categorie::find(array("id" => $categorie_id))[0];
                $fiche_categories = $categorie->getFiches();

                // Diff both array
                // Diff is made calling __toString() magic function from object
                // For this purpose, the string MUST be unique value, or diff fail
                $diff = array_diff($all, $fiche_categories);

                if(count($diff) > 0){
                    echo "<select id ='fiche_categorie_fiche_id' name='ficheCategorie[fiche_id]' class='form-control'>";
                    foreach($diff as $fiche){
                        echo "<option value='$fiche->id'>$fiche->libelle</option>";
                    }
                    echo "</select>";
                }
                else
                    echo "<p>Cette catégorie possède déjà toutes les fiches.</p>";
            }
            ?>

            <div class="text-center">
                <input type="submit" class="btn btn-default" value="Enregistrer">
                <?php
                if(isset($data["fiche_id"])){
                    echo "<a href='/fiches' class='btn btn-danger'>Annuler</a>";
                }
                elseif(isset($data["categorie_id"])){
                    echo "<a href='/categories/$categorie_id' class='btn btn-danger'>Annuler</a>";
                }
                ?>
            </div>
        </form>
    </div>
</div>
