<?php
// path: formateur/07-avance-correction/controller/routerController.php

/*
 *
 * Routeur du site web
 *
 */

/*
 * Lien vers les dépendances nécessaires
 * à l'entièreté du site
 */
// ici pour les articles
use model\ArticleMapping;
use model\ArticleManager;

// ici pour les catégories
use model\CategoryManager;
use model\CategoryMapping;

# Connexion PDO
try {
    $connectPDO = new PDO(
        DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_LOGIN,
        DB_PWD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (Exception $e) {
    die($e->getMessage());
}

// Instanciation du Manager d'ArticleMapping
$ArticleManager = new ArticleManager($connectPDO);
// Instanciation du Manager de CategoryMapping
$CategoryManager = new CategoryManager($connectPDO);


// si il n'existe pas les paramètres categoryAdmin ni articleAdmin
if (!isset($_GET['categoryAdmin']) && !isset($_GET['articleAdmin'])) {
    // appel du controller public
    require_once "publicContoller.php";

// si il existe  categoryAdmin
}elseif (isset($_GET['categoryAdmin'])){
    // appel du controller des catégories
    require_once "categoryController.php";

// si il existe articleAdmin
}elseif (isset($_GET['articleAdmin'])){
    // appel du controller des articles
    require_once "articleController.php";

}else{
    // page non trouvée
    $message = "Page non trouvée";
    include RACINE_PATH . "/view/404.html.php";
}


// fermeture de connexion
$connectPDO = null;