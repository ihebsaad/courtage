@extends('layouts.admin')

@section('title', 'Gestion des Clients')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap4.min.css">

<!-- Custom CSS -->
<style>
    .filter-card {
        transition: all 0.3s ease;
        border: 1px solid #e3e6f0;
    }
    .filter-card.collapsed {
        margin-bottom: 1rem;
    }
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: none;
    }
    .stats-item {
        text-align: center;
        padding: 1rem;
    }
    .stats-number {
        font-size: 2rem;
        font-weight: bold;
        display: block;
    }
    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .client-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
    }
    .table-actions {
        white-space: nowrap;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    #clients-table_wrapper .row {
        margin: 0;
    }
    .dataTables_filter {
        display: none;
    }
    .card-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    .collapse-toggle {
        border: none;
        background: none;
        color: #5a5c69;
        transition: all 0.3s ease;
    }
    .collapse-toggle:hover {
        color: #3a3b45;
    }
    .collapse-toggle i {
        transition: transform 0.3s ease;
    }
    .collapse-toggle.collapsed i {
        transform: rotate(180deg);
    }
    /* Fix pour les boutons Bootstrap */
    .btn-group .btn {
        margin-right: 0;
    }
    .dropdown-menu {
        min-width: 120px;
    }
</style> 

@section('content')
<div class="container-fluid">
    
    <!-- En-tête avec statistiques -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stats-card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stats-item">
                                <span class="stats-number" id="total-clients">{{ $stats['total'] ?? 0 }}</span>
                                <span class="stats-label">Total Clients</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-item">
                                <span class="stats-number" id="total-prospects">{{ $stats['prospects'] ?? 0 }}</span>
                                <span class="stats-label">Prospects</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-item">
                                <span class="stats-number" id="total-particuliers">{{ $stats['particuliers'] ?? 0 }}</span>
                                <span class="stats-label">Particuliers</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-item">
                                <span class="stats-number" id="total-entreprises">{{ $stats['entreprises'] ?? 0 }}</span>
                                <span class="stats-label">Entreprises</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres avancés -->
    <div class="card filter-card mb-4" id="filters-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-filter mr-2"></i>Filtres de recherche
                </h6>
                <button class="collapse-toggle" type="button" data-toggle="collapse" 
                        data-target="#filters-collapse" aria-expanded="true" aria-controls="filters-collapse">
                    <i class="fas fa-chevron-up" id="filter-chevron"></i>
                </button>
            </div>
        </div>
        <div class="collapse show" id="filters-collapse">
            <div class="card-body">
                <form id="filters-form">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label font-weight-bold">Recherche globale</label>
                            <input type="text" id="global-search" class="form-control" 
                                   placeholder="Nom, email, téléphone...">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label font-weight-bold">Type</label>
                            <select id="filter-type" class="form-control">
                                <option value="">Tous</option>
                                <option value="particulier">Particulier</option>
                                <option value="entreprise">Entreprise</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label font-weight-bold">Statut</label>
                            <select id="filter-statut" class="form-control">
                                <option value="">Tous</option>
                                <option value="client">Client</option>
                                <option value="prospect">Prospect</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label font-weight-bold">Ville</label>
                            <select id="filter-ville" class="form-control">
                                <option value="">Toutes</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label font-weight-bold">Période de création</label>
                            <div class="input-group">
                                <input type="date" id="filter-date-debut" class="form-control" placeholder="Du">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">à</span>
                                </div>
                                <input type="date" id="filter-date-fin" class="form-control" placeholder="Au">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" id="apply-filters" class="btn btn-primary mr-2">
                                <i class="fas fa-search mr-1"></i>Appliquer les filtres
                            </button>
                            <button type="button" id="clear-filters" class="btn btn-outline-secondary">
                                <i class="fas fa-eraser mr-1"></i>Effacer les filtres
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table des clients -->
    <div class="card shadow">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-users mr-2"></i>Liste des Clients
                </h6>
                <div class="card-header-actions">
                    <button class="btn btn-sm btn-outline-secondary" id="refresh-table" title="Actualiser">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" 
                                id="exportDropdown" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download mr-1"></i>Export
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exportDropdown">
                            <a class="dropdown-item" href="#" id="export-excel">
                                <i class="fas fa-file-excel mr-2 text-success"></i>Excel
                            </a>
                            <a class="dropdown-item" href="#" id="export-pdf">
                                <i class="fas fa-file-pdf mr-2 text-danger"></i>PDF
                            </a>
                            <a class="dropdown-item" href="#" id="export-csv">
                                <i class="fas fa-file-csv mr-2 text-info"></i>CSV
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('clients.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus mr-1"></i>Nouveau Client
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="clients-table" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th width="10%">Client</th>
                            <th width="20%">Nom/Raison Sociale</th>
                            <th width="15%">Contact</th>
                            <th width="10%">Type</th>
                            <th width="10%">Statut</th>
                            <th width="10%">Ville</th>
                            <th width="10%">Créé le</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions sélection multiple -->
    <div class="card mt-3" id="bulk-actions" style="display: none;">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <span class="mr-3 mb-2 mb-md-0">
                    <strong id="selected-count">0</strong> élément(s) sélectionné(s)
                </span>
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-warning" id="bulk-prospect">
                        <i class="fas fa-eye mr-1"></i>Marquer comme Prospect
                    </button>
                    <button class="btn btn-sm btn-success" id="bulk-client">
                        <i class="fas fa-handshake mr-1"></i>Marquer comme Client
                    </button>
                    <button class="btn btn-sm btn-danger" id="bulk-delete">
                        <i class="fas fa-trash mr-1"></i>Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce client ?</p>
                <p class="text-danger small">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Supprimer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    // Configuration du DataTable
    var table = $('#clients-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("clients.datatable") }}',
            data: function(d) {
                d.type = $('#filter-type').val();
                d.statut = $('#filter-statut').val();
                d.ville = $('#filter-ville').val();
                d.date_debut = $('#filter-date-debut').val();
                d.date_fin = $('#filter-date-fin').val();
                d.search_global = $('#global-search').val();
            }
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return '<input type="checkbox" class="row-select" value="' + data + '">';
                }
            },
            {
                data: 'avatar',
                name: 'avatar',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    var initials = '';
                    var bgColor = '';
                    
                    if (row.type === 'particulier') {
                        initials = (row.prenom ? row.prenom.charAt(0) : '') + (row.nom ? row.nom.charAt(0) : '');
                        bgColor = 'bg-primary';
                    } else {
                        initials = row.raison_sociale ? row.raison_sociale.substring(0, 2).toUpperCase() : 'EN';
                        bgColor = 'bg-success';
                    }
                    
                    return '<div class="client-avatar ' + bgColor + '">' + initials + '</div>';
                }
            },
            {
                data: 'nom_complet',
                name: 'nom_complet',
                render: function(data, type, row) {
                    var name = row.type === 'particulier' 
                        ? (row.civilite ? row.civilite + ' ' : '') + (row.prenom || '') + ' ' + (row.nom || '')
                        : row.raison_sociale || '';
                    
                    var subtitle = row.type === 'entreprise' && row.secteur_activite 
                        ? '<small class="text-muted d-block">' + row.secteur_activite + '</small>'
                        : '';
                    
                    return '<div>' + name + subtitle + '</div>';
                }
            },
            {
                data: 'contact',
                name: 'contact',
                orderable: false,
                render: function(data, type, row) {
                    var contact = '';
                    if (row.email) {
                        contact += '<div><i class="fas fa-envelope text-muted mr-1"></i>' + row.email + '</div>';
                    }
                    if (row.telephone) {
                        contact += '<div><i class="fas fa-phone text-muted mr-1"></i>' + row.telephone + '</div>';
                    }
                    if (row.telephone_portable) {
                        contact += '<div><i class="fas fa-mobile-alt text-muted mr-1"></i>' + row.telephone_portable + '</div>';
                    }
                    return contact || '<span class="text-muted">Non renseigné</span>';
                }
            },
            {
                data: 'type',
                name: 'type',
                render: function(data, type, row) {
                    var badge = data === 'particulier' 
                        ? '<span class="badge badge-primary"><i class="fas fa-user mr-1"></i>Particulier</span>'
                        : '<span class="badge badge-success"><i class="fas fa-building mr-1"></i>Entreprise</span>';
                    return badge;
                }
            },
            {
                data: 'statut',
                name: 'statut',
                render: function(data, type, row) {
                    var badge = data === 'client' 
                        ? '<span class="badge badge-success"><i class="fas fa-handshake mr-1"></i>Client</span>'
                        : '<span class="badge badge-warning"><i class="fas fa-eye mr-1"></i>Prospect</span>';
                    return badge;
                }
            },
            {
                data: 'ville',
                name: 'ville',
                render: function(data, type, row) {
                    if (data) {
                        return '<div>' + data + '</div>' + 
                               (row.code_postal ? '<small class="text-muted">' + row.code_postal + '</small>' : '');
                    }
                    return '<span class="text-muted">Non renseigné</span>';
                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function(data, type, row) {
                    return moment(data).format('DD/MM/YYYY');
                }
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,                                
            }/*
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                        <div class="table-actions">
                            <a href="/clients/${row.id}" class="btn btn-sm btn-outline-info" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/clients/${row.id}/edit" class="btn btn-sm btn-outline-primary" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${row.id}" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }*/
        ],
        order: [[7, 'desc']],
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"B>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn-success btn-sm d-none'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn-danger btn-sm d-none'
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
                className: 'btn-info btn-sm d-none'
            }
        ],
        responsive: true,
        select: {
            style: 'multi',
            selector: '.row-select'
        },
        drawCallback: function(settings) {
            updateBulkActions();
        }
    });

    // Gestion des filtres
    $('#apply-filters').click(function() {
        table.ajax.reload();
    });

    $('#clear-filters').click(function() {
        $('#filters-form')[0].reset();
        table.ajax.reload();
    });

    // Recherche globale
    $('#global-search').on('keyup', function() {
        if (this.value.length >= 3 || this.value.length === 0) {
            table.ajax.reload();
        }
    });

    // Toggle des filtres
    $('#filters-collapse').on('shown.bs.collapse', function() {
        $('#filter-chevron').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    });

    $('#filters-collapse').on('hidden.bs.collapse', function() {
        $('#filter-chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    });

    // Sélection multiple
    $('#select-all').click(function() {
        $('.row-select').prop('checked', this.checked);
        updateBulkActions();
    });

    $(document).on('change', '.row-select', function() {
        updateBulkActions();
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
    });

    function updateBulkActions() {
        var selected = $('.row-select:checked').length;
        $('#selected-count').text(selected);
        
        if (selected > 0) {
            $('#bulk-actions').show();
        } else {
            $('#bulk-actions').hide();
        }
    }

    // Actions en lot
    $('#bulk-prospect, #bulk-client, #bulk-delete').click(function() {
        var action = $(this).attr('id').replace('bulk-', '');
        var selected = $('.row-select:checked').map(function() {
            return this.value;
        }).get();

        if (selected.length === 0) {
            alert('Veuillez sélectionner au moins un élément');
            return;
        }

        if (action === 'delete') {
            if (confirm('Êtes-vous sûr de vouloir supprimer ' + selected.length + ' élément(s) ?')) {
                performBulkAction(action, selected);
            }
        } else {
            performBulkAction(action, selected);
        }
    });

    function performBulkAction(action, ids) {
        $.ajax({
            url: '{{ route("clients.bulk-action") }}',
            method: 'POST',
            data: {
                action: action,
                ids: ids,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload();
                    $('#bulk-actions').hide();
                    $('.row-select, #select-all').prop('checked', false);
                    
                    // Notification de succès
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert(response.message);
                    }
                } else {
                    alert('Erreur: ' + response.message);
                }
            },
            error: function() {
                alert('Erreur lors de l\'exécution de l\'action');
            }
        });
    }

    // Suppression individuelle
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        $('#deleteModal').modal('show');
        
        $('#confirm-delete').off('click').on('click', function() {
            $.ajax({
                url: '/clients/' + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès',
                            text: 'Client supprimé avec succès',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        alert('Client supprimé avec succès');
                    }
                },
                error: function() {
                    alert('Erreur lors de la suppression');
                }
            });
        });
    });

    // Rafraîchir la table
    $('#refresh-table').click(function() {
        table.ajax.reload();
    });

    // Export des données
    $('#export-excel').click(function(e) {
        e.preventDefault();
        table.button('.buttons-excel').trigger();
    });

    $('#export-pdf').click(function(e) {
        e.preventDefault();
        table.button('.buttons-pdf').trigger();
    });

    $('#export-csv').click(function(e) {
        e.preventDefault();
        table.button('.buttons-csv').trigger();
    });

    // Charger les options de ville
    loadCityOptions();

    function loadCityOptions() {
        $.get('{{ route("clients.cities") }}', function(cities) {
            var select = $('#filter-ville');
            select.empty().append('<option value="">Toutes</option>');
            
            cities.forEach(function(city) {
                select.append('<option value="' + city + '">' + city + '</option>');
            });
        });
    }
});

// Fonction pour formater les dates (nécessite Moment.js)
if (typeof moment === 'undefined') {
    // Fallback si Moment.js n'est pas disponible
    window.moment = function(date) {
        return {
            format: function(format) {
                var d = new Date(date);
                if (format === 'DD/MM/YYYY') {
                    return d.getDate().toString().padStart(2, '0') + '/' + 
                           (d.getMonth() + 1).toString().padStart(2, '0') + '/' + 
                           d.getFullYear();
                }
                return d.toLocaleDateString();
            }
        };
    };
}
</script>

<!-- Ajout de Moment.js pour les dates -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/locale/fr.min.js"></script>
@endsection