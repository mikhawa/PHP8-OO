<?php
// view/category.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catégorie : <?=html_entity_decode($category->getCategoryName())?></title>
</head>
<body>
    <h1>Catégorie : <?=html_entity_decode($category->getCategoryName())?></h1>
    <?php include 'inc/public.menu.html.php'; ?>


        <div  class="Category">
            <h3><?=html_entity_decode($category->getCategoryName())?></h3>
            <p><?=!is_null($category->getCategoryDesc())?nl2br(html_entity_decode($category->getCategoryDesc())):"Pas de description"; ?></p>
        </div>
    <h2>Articles de la catégorie <?=html_entity_decode($category->getCategoryName())?></h2>
    <?php
    if(empty($article)):
    ?>
    <h3>Pas encore d'articles dans cette catégorie</h3>
    <?php
    else:
        $nbArticle = count($article);
        $pluriel = $nbArticle > 1? "s" : "";
    ?>
    <h3>Il y a <?=$nbArticle?> article<?=$pluriel?> dans cette catégorie</h3>
        <?php
    // tant qu'on a des articles
        $i = 1;
        foreach ($article as $item):
        ?>
        <div id="article<?=$i?>" class="article">
            <h3><a href="?p=article&slug=<?=$item->getArticleSlug()?>"><?=html_entity_decode($item->getArticleTitle())?></a></h3>
            <h4>Écrit le <?=$item->getArticleDate()?></h4>
            <?php if(!empty($item->getCategory())): ?>
            <h4>Catégorie<?=(count($item->getCategory())>1)?"s":""?> :
                <?php
                foreach ($item->getCategory() as $cat):
                    echo "<a href='?p=category&slug=".$cat->getCategorySlug()."'>".html_entity_decode($cat->getCategoryName())."</a> | ";
                endforeach;
                endif;
                ?>
            </h4>
            <p><?=$ArticleManager::cutTheText(html_entity_decode($item->getArticleText()),150);
            // Méthode statique pour couper le texte à 150 caractères maximum
                ?></p>
        </div>
    <?php
        $i++;
        endforeach;
    endif;
    ?>

<?php //var_dump($connectPDO,$ArticleManager,$nosArticle); ?>
</body>
</html>
