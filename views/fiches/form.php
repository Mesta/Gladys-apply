<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 align-right">
        <h1>Nouvelle fiche</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="/fiches/nouveau" method="POST">
          <div>
            <label for="libelle">Libellé</label>
            <input class="form-control" name="fiche[libelle]" id="fiche_libelle">
          </div>
          <br/>
          <div>
            <label for="libelle">Description</label>
            <textarea class="form-control" name="fiche[description]" id="fiche_description" maxlength="500"></textarea>
          </div>
          <br/>
          <div class="text-center">
            <input type="submit" class="btn btn-default" value="Enregistrer">
            <a href="/fiches" class="btn btn-danger">Annuler</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
