<div class="row">
    <div class="col-md-12 align-right">
        <h1><?php echo $data["title"] ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form action="<?php echo $data["url"] ?>" method="POST">
            <div>
                <label for="libelle">Libellé</label>
                <?php echo "<input class='form-control' name='categorie[libelle]' id='categorie_libelle' value='". $data['categorie']->libelle ."'>"; ?>
            </div>

            <br/>

            <div class="text-center">
                <input type="submit" class="btn btn-default" value="Enregistrer">
                <a href="/categories" class="btn btn-danger">Annuler</a>
            </div>
        </form>
    </div>
</div>
