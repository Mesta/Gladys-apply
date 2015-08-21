<div class="panel panel-default">
    <div class="panel-heading">
        <ul class="list-inline panel-links" style="text-align:right;">
            <li>
                <a class='btn btn-success' href="/categories/nouveau"><i class="glyphicon glyphicon-plus"></i> Nouvelle catégorie</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <table class="table table-hover table-stripped table-condensed">
            <thead>
            <tr>
                <th>Libellé</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach($data["categories"] as $categorie){
                    $id = $categorie->id;
                    $libelle = $categorie->libelle;

                    echo "            <tr>";
                    echo "                <td>$libelle</td>";
                    echo "                <td align='right'>";
                    echo "                    <span class='btn-group btn-group-sm' role='group'>";
                    echo "                        <a class='btn btn-sm btn-default' href='categories/$id'>Voir</a>";
                    echo "                        <a class='btn btn-sm btn-default' href='categories/$id/modifier'>Modifier</a>";
                    echo "                        <a class='btn btn-sm btn-danger' href='categories/$id/supprimer'>Supprimer</a>";
                    echo "                    </span>";
                    echo "                </td>";
                    echo "            </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
