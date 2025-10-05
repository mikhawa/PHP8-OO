<?php
// path: formateur/07-avance-correction/view/category.update.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mise à jour de la catégorie : <?= html_entity_decode($categ->getCategoryName()) ?></title>
</head>
<body>
    <h1>Mise à jour de la catégorie</h1>
    <?php include 'inc/admin.category.menu.html.php'; ?>
    <h2><?= html_entity_decode($categ->getCategoryName()) ?></h2>
    <?php
    if(isset($message)):
        ?>
        <p style="color:red; font-weight: bold;"><?=$message?></p>
    <?php
    endif;
    ?>
    <form action="" method="post" name="name">
        <input type="hidden" name="id" value="<?= $categ->getId() ?>">
        <label for="category_name">Titre de la catégorie</label><br>
        <input type="text" name="category_name" id="category_name" required value="<?= html_entity_decode($categ->getCategoryName()) ?>"><br><br>

        <label for="category_desc">Description de la catégorie</label><br>
        <textarea name="category_desc" id="category_desc" cols="30" rows="10"><?= !is_null($categ->getCategoryDesc())? html_entity_decode($categ->getCategoryDesc()): ""; ?></textarea><br><br>

        <input type="submit" value="Modifier la catégorie">
        
    </form>

</body>
</html>
