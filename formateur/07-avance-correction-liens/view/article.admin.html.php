<?php
// path: formateur/07-avance-correction/view/article.admin.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration d'articles</title>
</head>
<body>
    <h1>Administration d'articles</h1>
    <?php include 'inc/admin.article.menu.html.php'; ?>
    <h2>Articles de notre site</h2>
    <?php
    if(empty($nosArticle)):
    ?>
    <h3>Pas encore d'articles sur notre site</h3>
    <?php
    else:
        $nbArticle = count($nosArticle);
        $pluriel = $nbArticle > 1? "s" : "";
    ?>
    <h3>Il y a <?=$nbArticle?> article<?=$pluriel?> </h3>

        <table>
            <thead>
                <th>id</th>
                <th>article_title</th>
                <th>article_slug</th>
                <th>article_text</th>
                <th>article_date</th>
                <th>article_visibility</th>
                <th>update</th>
                <th>delete</th>
            </thead>
            <?php
                foreach ($nosArticle as $item):
            ?>
            <tr>
                <td><?=$item->getId()?></td>
                <td><?=html_entity_decode($item->getArticleTitle())?></td>
                <td><?=$item->getArticleSlug()?></td>
                <td><?=
                    // on coupe le texte à 150 caractères pour l'affichage puis on le recoupe à 120
                    // avec la méthode statique pour éviter de couper un mot en plein milieu
                    $ArticleManager::cutTheText(html_entity_decode(substr($item->getArticleText(),0,150)),120)
                    ?></td>
                <td><?=$item->getArticleDate()?></td>
                <td><?=$item->getArticleVisibility()?></td>
                <td><a href="?articleAdmin&p=update&id=<?=$item->getId()?>">update</a></td>
                <td><a href="#" onclick="let a=confirm('Voulez-vous vraiment supprimer l\'article <?=$item->getArticleSlug()?>'); if(a){ document.location ='?articleAdmin&p=delete&id=<?=$item->getId()?>';}">delete</a></td>
            </tr>
            <?php
                endforeach;
            endif;
            ?>
        </table>


<?php //var_dump($connectPDO,$ArticleManager,$nosArticle); ?>
</body>
</html>
