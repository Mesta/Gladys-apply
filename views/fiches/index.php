<div class="row">
    <div class="col-md-12 align-right">
        <a href="/fiches/nouveau" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Créer une fiche</a>
    </div>
</div>

<?php
$col = 0;
$fiches = $data["fiches"];
foreach($fiches as $fiche) {
    if ($col == 0) {
        echo "<div class='row'>";
    }

    echo "<div class='col-md-3'>";
    echo "    <div class='thumbnail'>";
    echo "        <h2>" . $fiche->libelle . "</h2>";
    echo "        <p>" . $fiche->description . "</p>";

    echo "    <div class='panel panel-default'>";
    echo "        <div class='panel-heading'>Catégories</div>";

    $categories = $fiche->getCategories();
    if (count($categories) > 0) {
        echo "<table class='table'>";
        foreach ($categories as $categorie) {
            echo "            <tr>";
            echo "                <td><a href='/categories/$categorie->id'>$categorie->libelle</a></td>";
            echo "                <td align='right'><a href='/fiches/$fiche->id/categories/$categorie->id/supprimer'><i class='glyphicon glyphicon-remove'></i></a></td>";
            echo "            </tr>";
        }
        echo "</table>";
    }
    echo "        <div class='panel-footer'>";
    echo "            <a href='fiches/$fiche->id/categories/ajouter' class='btn btn-xs btn-default'>";
    echo "                <i class='glyphicon glyphicon-plus'></i> Ajouter une catégorie";
    echo "            </a>";
    echo "        </div>";
    echo "    </div>";

    echo "        <hr/>";
    echo "        <div class='btn-group btn-group-sm' role='group'>";
    echo "            <a class='btn btn-sm btn-default' href='fiches/".$fiche->id."/modifier'>Modifier</a>";
    echo "            <a class='btn btn-sm btn-danger' href='fiches/".$fiche->id."/supprimer'>Supprimer</a>";
    echo "        </div>";
    echo "    </div>";
    echo "</div>";

    if( $col == 3 ){
        echo "</div>";
        $col = 0;
    }else{
        $col++;
    }
}
?>
