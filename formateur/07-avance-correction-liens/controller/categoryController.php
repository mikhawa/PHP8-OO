<?php
// path: formateur/07-avance-correction/controller/categoryController.php
use model\CategoryMapping;

if(!isset($_GET['p'])){
    // on affiche la liste des catégories
    $nosCategories = $CategoryManager->readAll();
    // appel de la vue
    include RACINE_PATH . "/view/category.admin.html.php";
    die();
}
// page admin
switch ($_GET['p']) {

    // create article
    case 'create':
        // si le formulaire est envoyé
        if (isset($_POST['category_name'])) {
            try {
                // utilisation des setters
                $newCateg = new CategoryMapping($_POST);
                // pas de faute création du slug
                // qui est importé par 'use SlugifyTrait'
                // dans ArticleManager, on décode l'htmspecialchars
                // pour éviter des caractères parasites dans le nom
                // du slug
                $slug = $CategoryManager->slugify(html_entity_decode($newCateg->getCategoryName()));
                // on utilise le setter d'Article pour mettre
                // à jour article_slug
                $newCateg->setCategorySlug($slug);

                // on veut insérer l'article
                $ok = $CategoryManager->create($newCateg);
                if ($ok === true) {
                    // redirection vers la page d'admin
                    header("Location: ./?categoryAdmin");
                    exit;
                } else {
                    // erreur lors de l'insertion
                    $message = $ok;
                }

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        include RACINE_PATH . "/view/category.create.html.php";

        break;

    // update category
    case 'update':
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])):
            // si on a cliqué sur update
            if (isset($_POST['category_name'])) {

                // les setters revérifient les champs
                try {
                    $updateCateg = new CategoryMapping($_POST);
                    // on vérifie que l'id n'a pas été modifié par l'utilisateur
                    if ($updateCateg->getId() != $_GET['id']) {
                        die("tentative de hack !!!");
                    }
                    // pas de faute création du slug
                    // qui est importé par 'use SlugifyTrait'
                    // dans ArticleManager, on décode l'htmspecialchars
                    // pour éviter des caractères parasites dans le nom
                    // du slug
                    $slug = $CategoryManager->slugify(html_entity_decode($updateCateg->getCategoryName()));
                    // on utilise le setter d'Article pour mettre
                    // à jour article_slug
                    $updateCateg->setCategorySlug($slug);

                    // on veut mettre à jour l'article
                    $ok = $CategoryManager->update((int)$_GET['id'], $updateCateg);
                    if ($ok === true) {
                        // redirection vers la page d'admin
                        header("Location: ./?categoryAdmin");
                        exit;
                    } else {
                        // erreur lors de la mise à jour
                        $message = $ok;
                    }

                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
            // on récupère l'article à modifier
            $categ = $CategoryManager->readById((int)$_GET['id']);
            if ($categ === false) {
                die("Vous essayez de modifier une catégorie qui n'existe pas");
            }
            include RACINE_PATH . "/view/category.update.html.php";
        else :
            die("Vous devez préciser un id valide");
        endif;
        break;
    // delete article
    case 'delete':
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])):
            try {
                $ok = $CategoryManager->delete((int)$_GET['id']);
                if ($ok === true) {
                    header("Location: ./?categoryAdmin");
                    exit;
                } else {
                    $message = $ok;
                    include RACINE_PATH . "/view/404.html.php";
                    die();
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        else :
            die("Vous devez préciser un id valide");
        endif;

        break;

}
