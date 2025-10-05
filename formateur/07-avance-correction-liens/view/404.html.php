<?php
// view/404.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
</head>
<body>
    <h1>Erreur 404</h1>
    <?php include 'inc/public.menu.html.php'; ?>
    <?php
    if(isset($message)):
    ?>
        <h2><?=$message?></h2>
    <?php
    endif;
    ?>
    <h2>Erreur 404</h2>

</body>
</html>
