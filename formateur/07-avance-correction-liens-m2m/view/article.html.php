<?php
// view/article.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article : <?=html_entity_decode($article->getArticleTitle())?></title>
</head>
<body>
    <h1>Article : <?=html_entity_decode($article->getArticleTitle())?></h1>
    <?php include 'inc/public.menu.html.php'; ?>


        <div  class="article">
            <h3><?=html_entity_decode($article->getArticleTitle())?></h3>
            <?php if (!empty($article->getCategory())) :
                  $nbCat = count($article->getCategory());
                  $plural = $nbCat > 1 ? 's' : '';
            ?>
            <h4>Catégorie<?=$plural?> :
                <?php foreach ($article->getCategory() as $category) : ?>
                    <a href="./?p=category&slug=<?=$category->getCategorySlug()?>"><?=nl2br(html_entity_decode($category->getCategoryName()))?></a> |
                <?php endforeach; ?>
            </h4>
            <?php endif;

             ?>
            <h4>Écrit le <?=$article->getArticleDate()?></h4>
            <?php

            ?>
            <p><?=nl2br(html_entity_decode($article->getArticleText())); ?></p>
        </div>

<?php //var_dump($connectPDO,$ArticleManager,$nosArticle); ?>
</body>
</html>
