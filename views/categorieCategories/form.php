<div class="row">
    <div class="col-md-12 align-right">
        <h1>Ajouter une sous-catégorie</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="<?php echo $data["url"] ?>" method="POST">
            <?php

            $mother_id = $data["mother_id"];
            echo "<input type='hidden' value='$mother_id' name='categorieCategorie[mother_id]' id='categorieCategorie_mother_id'>";

            // Get All categories from DB
            $all = Categorie::all();

            // Get sub-categorie for this categorie
            $categorie = Categorie::find(array("id" => $mother_id))[0];
            $categorie_categories = $categorie->getSubcategories();

            // Diff both array
            // Diff is made calling __toString() magic function from object
            // For this purpose, the string MUST be unique value, or diff fail
            $diff = array_diff($all, $categorie_categories);

            if(count($diff) > 0){
                echo "<select id ='categorie_categorie_daughter_id' name='categorieCategorie[daughter_id]' class='form-control'>";
                foreach($diff as $categorie){
                    echo "<option value='$categorie->id'>$categorie->libelle</option>";
                }
                echo "</select>";
            }
            else
                echo "<p>Il n'est pas possible d'ajouter d'autre sous-catégories.</p>";

            ?>

            <br/>

            <div class="text-center">
                <div class='btn-group btn-group-lg' role='group'>

                    <?php
                    if(count($diff) > 0){
                        echo "<input type='submit' class='btn btn-default' value='Enregistrer'>";
                    }
                    echo "<a href='/categories/$categorie->id' class='btn btn-danger'>Retour</a>";
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
