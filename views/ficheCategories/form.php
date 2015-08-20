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
                echo "<input type='hidden' value='/fiches' name='ficheCategorie[callback]' id='ficheCategorie_fiche_id'>";

                echo "<select id ='fichecategorie_categorie_id' name='ficheCategorie[categorie_id]' class='form-control'>";
                $all = Categorie::all();
                foreach($all as $categorie){
                    echo "<option value='$categorie->id'>$categorie->libelle</option>";
                }
                echo "</select>";
            }
            elseif(isset($data["categorie_id"])){
                $categorie_id = $data["categorie_id"];
                echo "<input type='hidden' value='$fiche_id' name='ficheCategorie[fiche_id]'>";

                echo "<input type='hidden' value='/categories' name='ficheCategorie[callback]' id='ficheCategorie_fiche_id'>";

            }
            ?>

            <div class="text-center">
                <input type="submit" class="btn btn-default" value="Enregistrer">
                <?php
                if(isset($data["fiche_id"])){
                    echo "<a href='/fiches' class='btn btn-danger'>Annuler</a>";
                }
                elseif(isset($data["categorie_id"])){
                    echo "<a href='/categories' class='btn btn-danger'>Annuler</a>";
                }
                ?>
            </div>
        </form>
    </div>
</div>
