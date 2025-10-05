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
            <h4>Écrit le <?=$article->getArticleDate()?></h4>
            <?php // gestion des catégories
            if(!empty($article->getCategory())): ?>
            <h4>Catégorie<?=(count($article->getCategory())>1)?"s":""?> :
                <?php
                foreach ($article->getCategory() as $cat):
                    echo "<a href='?p=category&slug=".$cat->getCategorySlug()."'>".html_entity_decode($cat->getCategoryName())."</a> | ";
                endforeach;
                endif;
                ?>
            </h4>
            <p><?=nl2br(html_entity_decode($article->getArticleText())); ?></p>
        </div>

<?php var_dump($article); ?>
</body>
</html>
