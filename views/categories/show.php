<?php
$categorie = $data["categorie"];

$id = $categorie->id;
$libelle = $categorie->libelle;

$fiches = $categorie->getFiches();

echo "<h2>";
echo "    Catégorie : $libelle";
echo "    <a href='/categories/$id/modifier' class='btn btn-xs btn-default'>Modifier</a>";
echo "</h2>";

echo "<div class='row'>";
echo "    <div class='col-xs-12 col-md-8'>";

echo "    <h3>Les fiches";
echo "        <a class='btn btn-xs btn-default' href='/categories/$id/fiches/ajouter'>";
echo "            <i class='glyphicon glyphicon-plus'></i> Ajouter une fiche";
echo "        </a>";
echo "    </h3>";

// Display fiches
if(count($fiches) > 0){
    $col = 0;
    foreach($fiches as $fiche){
        if ($col == 0) {
            echo "<div class='row'>";
        }

        echo "<div class='col-md-6'>";
        echo "    <div class='thumbnail'>";
        echo "        <h2><a href='/fiches'>$fiche->libelle</a></h2>";
        echo "        <p>" . $fiche->description . "</p>";
        echo "        <a class='btn btn-xs btn-danger' href='/categories/$categorie->id/fiches/$fiche->id/supprimer'>";
        echo "            <i class='glyphicon glyphicon-remove'></i> Supprimer";
        echo "        </a>";
        echo "    </div>";
        echo "</div>";

        if( $col == 2 ){
            echo "</div>";
            $col = 0;
        }else{
            $col++;
        }
    }
}



$ss_categories = $categorie->getSubCategories();

echo "    <div class='col-xs-6 col-md-4'>";

echo "    <h3>Sous-catégories</h3>";
echo "    <div class='panel panel-default'>";
echo "        <div class='panel-heading'>";
echo "            <a class='btn btn-xs btn-default' href='/categories/$id/sous-categories/ajouter'><i class='glyphicon glyphicon-plus'></i> Ajouter</a>";
echo "        </div>";
echo "        <table class='table'>";
if(count($ss_categories) > 0){
    foreach ($ss_categories as $ss_categorie) {
        echo "            <tr>";
        echo "                <td>$ss_categorie->libelle</td>";
        echo "                <td align='right'>";
        echo "                    <a href='/categories/$id/sous-categories/$ss_categorie->id/supprimer' class='btn btn-xs btn-danger'>";
        echo "                        <i class='glyphicon glyphicon-remove'></i> Supprimer";
        echo "                </a>";
        echo "                </td>";
        echo "            </tr>";
    }

}

echo "        </table>";
echo "    </div>";
echo "</div>";
echo "</div>";

echo '<a href="/categories" class="btn btn-default">Retour à la liste</a>';
?>


