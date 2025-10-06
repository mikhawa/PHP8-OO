<?php
// view/404.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur 404 - Mon Blog</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navigation neutre -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="./">
                <i class="bi bi-exclamation-triangle me-2"></i>Erreur 404
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./">
                            <i class="bi bi-house-door me-1"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?p=admin">
                            <i class="bi bi-gear me-1"></i>Administration
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=create">
                            <i class="bi bi-plus-circle me-1"></i>Créer
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <!-- Icône d'erreur -->
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 5rem;"></i>
                </div>

                <!-- Message d'erreur principal -->
                <h1 class="display-1 text-danger fw-bold mb-3">404</h1>
                <h2 class="h3 text-dark mb-4">Page non trouvée</h2>

                <!-- Message personnalisé si disponible -->
                <?php if(isset($message)): ?>
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <div><?=$message?></div>
                </div>
                <?php endif; ?>

                <!-- Description de l'erreur -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body py-4">
                        <p class="text-muted mb-3">
                            Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                        </p>
                        <p class="text-muted mb-0">
                            Vous pouvez retourner à l'accueil ou utiliser la navigation ci-dessus.
                        </p>
                    </div>
                </div>

                <!-- Actions recommandées -->
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                    <a href="./" class="btn btn-primary btn-lg">
                        <i class="bi bi-house-door-fill me-2"></i>Retour à l'Accueil
                    </a>
                    <a href="./?p=admin" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-gear-fill me-2"></i>Administration
                    </a>
                </div>

                <!-- Suggestions -->
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-journal-text text-primary fs-1 mb-2"></i>
                                <h6 class="text-muted">Articles</h6>
                                <small class="text-muted">Découvrez nos articles</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-tags text-success fs-1 mb-2"></i>
                                <h6 class="text-muted">Catégories</h6>
                                <small class="text-muted">Explorez par catégorie</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-search text-info fs-1 mb-2"></i>
                                <h6 class="text-muted">Recherche</h6>
                                <small class="text-muted">Utilisez la navigation</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
