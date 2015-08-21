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
echo "    <div class='col-xs-12 col-md-8'>"; // Open col-xs-12

echo "    <h3>Les fiches";
echo "        <a class='btn btn-xs btn-default' href='/categories/$id/fiches/ajouter'>";
echo "            <i class='glyphicon glyphicon-plus'></i> Ajouter une fiche";
echo "        </a>";
echo "    </h3>";

// Display fiches
$nbRow = 2;
if(count($fiches) > 0){
    $col = 0;
    foreach($fiches as $fiche){
        if ($col%$nbRow == 0) {
            echo "<div class='row'>"; // Open row
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

        // Close row
        if( $col%$nbRow == $nbRow - 1){
            echo "</div>";
        }

        $col++;
    }
}

if( isset($col) && $col%$nbRow == 1 ){
    echo "</div>";
}

echo "</div>"; // Close col-xs-12

// Display subcategories

$ss_categories = $categorie->getSubCategories();
echo "    <div class='col-xs-6 col-md-4'>";

echo "    <h3>Sous-catégories</h3>";
echo "    <div class='panel panel-default' id='ss_categorie'>";
echo "        <div class='panel-heading'>";
echo "            <a class='btn btn-xs btn-default' href='/categories/$id/sous-categories/ajouter'><i class='glyphicon glyphicon-plus'></i> Ajouter</a>";
echo "        </div>";
echo "        <table class='table'>";
if(count($ss_categories) > 0){
    foreach ($ss_categories as $ss_categorie) {
        echo "            <tr>";
        echo "                <td>";
        echo "                <a href='/categories/$ss_categorie->id'>$ss_categorie->libelle</a>";
        echo "                </td>";
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



