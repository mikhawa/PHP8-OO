<?php
declare(strict_types=1);

require_once "../config.php";

// Autoload fonctionnel avec les namespaces persos
// ne fonctionne qu'en OO
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    //echo RACINE_PATH.'/' .$class . '.php<br>';
    require RACINE_PATH.'/' .$class . '.php';
});


// chargement du router
require_once RACINE_PATH."/controller/routerController.php";

