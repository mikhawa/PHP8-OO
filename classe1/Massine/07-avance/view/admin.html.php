<?php
// view/admin.html.php
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration Articles - Mon Blog</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navigation pour articles avec thème primary -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="./">
                <i class="bi bi-gear-wide-connected me-2"></i>Administration Articles
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
                        <a class="nav-link active" href="./?p=admin">
                            <i class="bi bi-file-text me-1"></i>Admin Articles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./?c=admin">
                            <i class="bi bi-tags me-1"></i>Admin Catégories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?p=create">
                            <i class="bi bi-plus-circle me-1"></i>Nouvel Article
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <div class="bg-primary text-white py-4">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h2 mb-0">
                        <i class="bi bi-kanban me-2"></i>Gestion des Articles
                    </h1>
                    <p class="mb-0 opacity-75">Administrez et gérez tous vos articles</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="?p=create" class="btn btn-light btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Créer un Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-4">
        <?php
        if(empty($nosArticle)):
        ?>
        <!-- État vide -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-inbox display-1 text-primary mb-4"></i>
                        <h3 class="text-primary mb-3">Aucun article créé</h3>
                        <p class="text-muted mb-4">Commencez par créer votre premier article pour votre blog.</p>
                        <a href="?p=create" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Créer le premier article
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        else:
            $nbArticle = count($nosArticle);
            $pluriel = $nbArticle > 1? "s" : "";
        ?>
        <!-- Stats et actions -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary text-white rounded-3 p-3 me-3">
                                <i class="bi bi-journal-text fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-1"><?=$nbArticle?> Article<?=$pluriel?></h4>
                                <p class="text-muted mb-0">Total des articles publiés</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Actions Rapides</h5>
                        <a href="?p=create" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-plus me-1"></i>Nouveau
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des articles -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 text-primary">
                    <i class="bi bi-table me-2"></i>Liste des Articles
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th class="fw-semibold"># ID</th>
                                <th class="fw-semibold">Titre</th>
                                <th class="fw-semibold">Slug</th>
                                <th class="fw-semibold">Contenu</th>
                                <th class="fw-semibold">Date</th>
                                <th class="fw-semibold">Statut</th>
                                <th class="fw-semibold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nosArticle as $item): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-primary">#<?=$item->getId()?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-primary">
                                        <?=html_entity_decode($item->getArticleTitle())?>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-muted"><?=$item->getArticleSlug()?></code>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;">
                                        <?=html_entity_decode(substr($item->getArticleText(),0,100))?>...
                                    </div>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        <?=$item->getArticleDate()?>
                                    </small>
                                </td>
                                <td>
                                    <?php if($item->getArticleVisibility()): ?>
                                        <span class="badge bg-success">
                                            <i class="bi bi-eye me-1"></i>Publié
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">
                                            <i class="bi bi-eye-slash me-1"></i>Brouillon
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="?p=update&id=<?=$item->getId()?>" 
                                           class="btn btn-outline-primary" 
                                           title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Supprimer"
                                                onclick="confirmerSuppression('<?=$item->getArticleSlug()?>', <?=$item->getId()?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Confirmer la suppression
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer l'article <strong id="articleName"></strong> ?</p>
                    <p class="text-muted small">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Annuler
                    </button>
                    <a href="#" id="confirmDelete" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Supprimer
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmerSuppression(slug, id) {
            document.getElementById('articleName').textContent = slug;
            document.getElementById('confirmDelete').href = '?p=delete&id=' + id;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
</body>
</html>
