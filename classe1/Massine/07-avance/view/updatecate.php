<?php
// view/updatecate.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier la Catégorie - Mon Blog</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navigation pour catégories avec thème success -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="./">
                <i class="bi bi-pencil-square me-2"></i>Modifier la Catégorie
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
                            <i class="bi bi-gear me-1"></i>Admin Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?c=admin">
                            <i class="bi bi-tags me-1"></i>Admin Catégories
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="bg-success text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h2 mb-0">
                        <i class="bi bi-folder-fill me-2"></i>Modifier la Catégorie
                    </h1>
                    <p class="mb-0 opacity-75">Mettez à jour les informations de votre catégorie</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge bg-light text-success fs-6">
                        ID: #<?= $categorie->getId() ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-tag-fill me-2"></i>Formulaire de Modification
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="id" value="<?= $categorie->getId() ?>">
                            
                            <!-- Nom de la catégorie -->
                            <div class="mb-4">
                                <label for="category_name" class="form-label fw-semibold">
                                    <i class="bi bi-tag me-1 text-success"></i>Nom de la Catégorie
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="category_name" 
                                       name="category_name" 
                                       value="<?= html_entity_decode($categorie->getCategoryName()) ?>"
                                       required>
                                <div class="invalid-feedback">
                                    Veuillez saisir un nom pour votre catégorie.
                                </div>
                            </div>

                            <!-- Description de la catégorie -->
                            <div class="mb-4">
                                <label for="category_desc" class="form-label fw-semibold">
                                    <i class="bi bi-file-text me-1 text-success"></i>Description de la Catégorie
                                </label>
                                <textarea class="form-control" 
                                          id="category_desc" 
                                          name="category_desc" 
                                          rows="8" 
                                          required><?= html_entity_decode($categorie->getCategoryDesc()) ?></textarea>
                                <div class="invalid-feedback">
                                    Veuillez saisir une description pour votre catégorie.
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-flex gap-3 pt-3 border-top">
                                <button type="submit" class="btn btn-success btn-lg flex-fill">
                                    <i class="bi bi-check-circle me-2"></i>Mettre à Jour
                                </button>
                                <a href="./?c=admin" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validation Bootstrap
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
