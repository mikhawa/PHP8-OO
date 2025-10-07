<?php
// view/homepage.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvel article</title>
</head>
<body>
    <h1>Nouvel article</h1>
    <?php include 'inc/admin.article.menu.html.php'; ?>
    <h2>Création d'un nouvel article</h2>
    <?php
    if(isset($message)):
        ?>
        <p style="color:red; font-weight: bold;"><?=$message?></p>
    <?php
    endif;
    ?>
    <form action="" method="post" name="name">
        <label for="article_title">Titre de l'article</label><br>
        <input type="text" name="article_title" id="article_title" required><br><br>

        <label for="article_text">Texte de l'article</label><br>
        <textarea name="article_text" id="article_text" cols="30" rows="10" required></textarea><br><br>

        <label for="article_visibility">Visibilité de l'article</label><br>
        <select name="article_visibility" id="article_visibility" required>
            <option value="1">Visible</option>
            <option value="0">Non visible</option>
        </select><br><br>
        <label for="article_category">Catégories</label><br>
            <?php
            if(isset($nosCategory) && !empty($nosCategory)):
                foreach ($nosCategory as $category):
                    ?>
                    <input type="checkbox" name="categ[]" value="<?=$category->getId()?>"><?=html_entity_decode($category->getCategoryName())?>
                    <?php
                endforeach;
            endif;
            ?>
        <br><br>

        <input type="submit" value="Créer l'article">
        
    </form>
<?php var_dump($_POST);
// si on a soumis le formulaire
if(isset($newArticle)) var_dump($newArticle);
?>
</body>
</html>
