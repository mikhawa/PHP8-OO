<?php
// path: formateur/07-avance-correction/view/category.admin.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration des catégories</title>
</head>
<body>
    <h1>Administration des catégories</h1>
    <?php include 'inc/admin.category.menu.html.php'; ?>
    <h2>Catégories de notre site</h2>
    <?php
    if(empty($nosCategories)):
    ?>
    <h3>Pas encore de catégorie sur notre site</h3>
    <?php
    else:
        $nbCategory = count($nosCategories);
        $pluriel = $nbCategory > 1? "s" : "";
    ?>
    <h3>Il y a <?=$nbCategory?> catégorie<?=$pluriel?> </h3>

        <table>
            <thead>
                <th>id</th>
                <th>category_name</th>
                <th>category_slug</th>
                <th>category_desc</th>
                <th>update</th>
                <th>delete</th>
            </thead>
            <?php
                foreach ($nosCategories as $item):
            ?>
            <tr>
                <td><?=$item->getId()?></td>
                <td><?=html_entity_decode($item->getCategoryName())?></td>
                <td><?=$item->getCategorySlug()?></td>
                <td><?= $item->getCategoryDesc() === null ? "Pas de description" :
                    // on coupe le texte à 150 caractères pour l'affichage puis on le recoupe à 120
                    // avec la méthode statique pour éviter de couper un mot en plein milieu
                    $ArticleManager::cutTheText(html_entity_decode(substr($item->getCategoryDesc(),0,150)),120)
                    ?></td>
                <td><a href="?categoryAdmin&p=update&id=<?=$item->getId()?>">update</a></td>
                <td><a href="#" onclick="let a=confirm('Voulez-vous vraiment supprimer la catégorie : <?=$item->getCategorySlug()?>'); if(a){ document.location ='?categoryAdmin&p=delete&id=<?=$item->getId()?>';}">delete</a></td>
            </tr>
            <?php
                endforeach;
            endif;
            ?>
        </table>


<?php //var_dump($connectPDO,$ArticleManager,$nosArticle); ?>
</body>
</html>
