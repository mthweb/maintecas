<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modale en bas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        
        .modal-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0;
            padding: 0;
        }

        .modal-content {
            border-radius: 10px 10px 0 0;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: none;
        }

        .btn-close {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <!-- Bouton pour ouvrir la modale -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBottom">
        Ouvrir la modale
    </button>

    <!-- Modale -->
    <div class="modal fade" id="modalBottom" tabindex="-1" aria-labelledby="modalBottomLabel" aria-hidden="true">
        <div class="modal-dialog modal-bottom">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="modalBottomLabel">Filtrer par options</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class=" d-flex text-muted">
                        <div class="pt-3 pb-3mb-0 small lh-sm  w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark h6 text-dark fw-bold fade-in me-1">Afficher par catégorie</strong>
                                <a href="#" class="text-dark pt-0">
                                    <i class="fa fa-chevron-right fa-x"></i>
                                    LO
                                </a>
                            </div>
                            <!-- <span class="d-block">@username</span> -->
                        </div>
                    </div>

                    <div class=" d-flex text-muted">
                        <div class="pt-3 pb-3mb-0 small lh-sm  w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark h6 text-dark fw-bold fade-in me-1">Emplacement</strong>
                                <a href="#" class="text-dark pt-0">
                                    <i class="fa fa-chevron-right fa-x"></i>
                                    LO
                                </a>
                            </div>
                            <!-- <span class="d-block">@username</span> -->
                        </div>
                    </div>

                    <div class=" d-flex text-muted">
                        <div class="pt-3 pb-3mb-0 small lh-sm  w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark h6 text-dark fw-bold fade-in me-1">En ligne</strong>
                                <a href="#" class="text-dark pt-0">
                                    <i class="fa fa-chevron-right fa-x"></i>
                                    <input type="checkbox" name="" id="">
                                </a>
                            </div>
                            <!-- <span class="d-block">@username</span> -->
                        </div>
                    </div>

                    <div class=" d-flex text-muted">
                        <div class="pt-3 pb-3mb-0 small lh-sm  w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark h6 text-dark fw-bold fade-in me-1">Plus d'options</strong>
                                <a href="#" class="text-dark pt-0">
                                    <i class="fa fa-chevron-right fa-x"></i>
                                    LO
                                </a>
                            </div>
                            <!-- <span class="d-block">@username</span> -->
                        </div>
                    </div>                                        

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark">Appliquer les filtres</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
