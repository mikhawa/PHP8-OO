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

<?php //var_dump($connectPDO,$ArticleManager,$nosArticle); ?>
</body>
</html>
