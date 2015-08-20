
<div class="row">
    <div class="col-md-12 align-right">
        <a href="/fiches/nouveau" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Créer une fiche</a>
    </div>
</div>

<?php
$col = 0;
$fiches = $data["fiches"];
foreach($fiches as $fiche){
    if( $col == 0 ){
        echo "<div class='row'>";
    }

    echo "<div class='col-md-3'>";
    echo "    <div class='thumbnail'>";
    echo "        <h2>".$fiche->libelle."</h2>";
    echo "        <p>".$fiche->description."</p>";
    echo "        <ul>Catégories";
    echo "            <li>doles</li>";
    echo "        </ul>";
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
