<div class="row">
  <div class="col-md-12 align-right">
    <h1><?php echo $data["title"]; ?></h1>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <form action="<?php echo $data["url"] ?>" method="POST">
      <div>
        <label for="libelle">Libellé</label>
        <?php echo "<input class='form-control' name='fiche[libelle]' id='fiche_libelle' value='". $data['fiche']->libelle ."'>"; ?>
      </div>
      <br/>
      <div>
        <label for="libelle">Description</label>
        <?php echo "<textarea class='form-control' name='fiche[description]'' id='fiche_description' maxlength='500'>". $data['fiche']->description ."</textarea>"; ?>
      </div>
      <br/>
      <div class="text-center">
        <input type="submit" class="btn btn-default" value="Enregistrer">
        <a href="/fiches" class="btn btn-danger">Annuler</a>
      </div>
    </form>
  </div>
</div>
