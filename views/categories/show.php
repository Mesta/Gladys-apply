<?php
$categorie = $data["categorie"];

$id = $categorie->id;
$libelle = $categorie->libelle;

$fiches = $categorie->getFiches();

echo "<h2>Catégorie : $libelle</h2>";

echo "<h3>Les fiches <a class='btn btn-xs btn-default' href='/categories/$id/fiches/ajouter'><i class='glyphicon glyphicon-plus'></i> Ajouter une fiche</a></h3>";
if(count($fiches) > 0){
    $col = 0;
    foreach($fiches as $fiche){
        if ($col == 0) {
            echo "<div class='row'>";
        }

        echo "<div class='col-md-3'>";
        echo "    <div class='thumbnail'>";
        echo "        <h2><a href='/fiches'>$fiche->libelle</a></h2>";
        echo "        <p>" . $fiche->description . "</p>";
        echo "        <a class='btn btn-xs btn-danger' href='/categories/$categorie->id/fiches/$fiche->id/supprimer'>";
        echo "            <i class='glyphicon glyphicon-remove'></i> Retirer";
        echo "        </a>";
        echo "    </div>";
        echo "</div>";

        if( $col == 3 ){
            echo "</div>";
            $col = 0;
        }else{
            $col++;
        }
    }
    echo "</div>";
}
echo "<br/>";

echo "<a href='/categories/$id/modifier' class='btn btn-default'>Modifier</a>";
echo '<a href="/categories" class="btn btn-default">Retour à la liste</a>';
?>


