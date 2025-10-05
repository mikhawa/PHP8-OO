<?php
// path: formateur/07-avance-correction/public/index.php

/*
 * Point d'entrée de l'application, on déclare
 * que l'on est en mode typage strict
 * On charge la config, l'autoload et le routeur
 */

declare(strict_types=1);

require_once "../config.php";

// Autoload fonctionnel avec les namespaces personnels,
// ne fonctionne qu'en OO
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require RACINE_PATH.'/' .$class . '.php';
});


// chargement du router
require_once RACINE_PATH."/controller/routerController.php";

