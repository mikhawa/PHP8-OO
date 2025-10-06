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
    <?php
    if(empty($articles)):
        ?>
        <p>Aucun article dans cette catégorie</p>
        <?php
    else:
        foreach ($articles as $article):
            ?>
            <div class="Article">
                <h3><a href="./?p=article&slug=<?=$article->getArticleSlug()?>"><?=html_entity_decode($article->getArticleTitle())?></a></h3>
                <?php
                // on a de(s) catégorie(s) (tableau non vide)
                if(!empty($article->getCategory())):
                // nombre de catégorie(s)
                $compteCateg = count($article->getCategory());
                $pluriel = $compteCateg>1 ?"s":"";
                ?>
                <h4>Catégorie<?=$pluriel?> :
                <?php
                    $categs = $article->getCategory();
                    foreach ($categs as $categ):
                        echo '<a href="./?p=category&slug='.$categ->getCategorySlug().'">'.html_entity_decode($categ->getCategoryName()).'</a> | ';
                    endforeach;
                    endif;
                ?>
                </h4>
                <p><?=$ArticleManager::cutTheText(html_entity_decode($article->getArticleText()),150)?></p>
            </div>
            <?php
        endforeach;
    endif;
    ?>

<?php //var_dump($articles); ?>
</body>
</html>
