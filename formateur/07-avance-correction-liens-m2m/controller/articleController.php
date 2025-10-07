<?php
// path: formateur/07-avance-correction/controller/articleController.php
/*
 *
 * Contrôleur des articles
 *
 */
use model\ArticleMapping;

// Accueil de l'admin des articles
if(!isset($_GET['p'])){
    $nosArticle = $ArticleManager->readAll();
    include RACINE_PATH . "/view/article.admin.html.php";
    die();
}
// page admin
switch ($_GET['p']) {

    // create article
    case 'create':
        // si le formulaire est envoyé
        if (isset($_POST['article_title'], $_POST['article_text'], $_POST['article_visibility'])) {
            try {
                // utilisation des setters
                $newArticle = new ArticleMapping($_POST);
                // si on a des catégories
                if (isset($_POST['categ']) && !empty($_POST['categ'])) {
                    // on ajoute le tableau d'id de catégorie à l'article
                    $newArticle->setCategory($_POST['categ']);
                }
                // pas de faute création du slug
                // qui est importé par 'use SlugifyTrait'
                // dans ArticleManager, on décode l'htmspecialchars
                // pour éviter des caractères parasites dans le nom
                // du slug
                $slug = $ArticleManager->slugify(html_entity_decode($newArticle->getArticleTitle()));
                // on utilise le setter d'Article pour mettre
                // à jour article_slug
                $newArticle->setArticleSlug($slug);

                // on veut insérer l'article
                $ok = $ArticleManager->create($newArticle);
                if ($ok === true) {
                    // redirection vers la page d'admin
                    header("Location: ./?articleAdmin");
                    exit;
                } else {
                    // erreur lors de l'insertion
                    $message = $ok;
                }

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        // récupération des catégories pour le formulaire
        $nosCategory = $CategoryManager->readAll();

        include RACINE_PATH . "/view/article.create.html.php";

        break;
    // update article
    case 'update':
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])):
            // si on a cliqué sur update
            if (isset($_POST['article_title'], $_POST['article_text'], $_POST['article_visibility'])) {

                // les setters revérifient les champs
                $updateArticle = new ArticleMapping($_POST);
                // on régénère le slug depuis lui-même
                $slug = $ArticleManager->slugify(html_entity_decode($updateArticle->getArticleTitle()));
                // on utilise le setter d'Article pour mettre
                // à jour article_slug
                $updateArticle->setArticleSlug($slug);
                // on va modifier dans la table article
                try {
                    $ok = $ArticleManager->update($_GET['id'], $updateArticle);
                    // si une erreur comme l'id ou problème d'insertion
                    if (is_string($ok)) {
                        $message = $ok;
                        include RACINE_PATH . "/view/404.html.php";
                        die();
                    }
                    header("location: ./?articleAdmin");
                } catch (Exception $e) {
                    echo $e->getMessage();
                }


            }
            // récupération de l'article
            $article = $ArticleManager->readById((int)$_GET['id']);
            // si l'article n'existe pas
            if ($article === false) {
                $message = "Cet article n'existe plus";
                include RACINE_PATH . "/view/404.html.php";
            } else {
                // récupération des catégories pour le formulaire
                $nosCategory = $CategoryManager->readAll();
                include RACINE_PATH . "/view/article.update.html.php";
            }
        else:
            $message = "Touche pas à mon code !";
            include RACINE_PATH . "/view/404.html.php";
        endif;
        break;
    // delete article
    case 'delete':
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])):
            $ok = $ArticleManager->delete($_GET['id']);
            if ($ok) {
                header("Location: ./?articleAdmin");
            } else {
                $message = "Erreur lors de la suppression !";
                include RACINE_PATH . "/view/404.html.php";
            }
        else:
            $message = "Touche pas à mon code !";
            include RACINE_PATH . "/view/404.html.php";
        endif;
        break;
}
