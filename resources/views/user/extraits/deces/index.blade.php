@extends('user.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --orange: #ffa500;
        --green: #008000;
        --white: #ffffff;
        --light-green: #e8f5e9;
        --light-orange: #fff3e0;
        --dark-green: #006400;
        --dark-orange: #cc8400;
        --gray: #f5f5f5;
        --border-radius: 12px;
        --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .form-background {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: 8px;
    }

    .modal-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .btn-danger {
        color: white;
        background-color: #dc3545;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        transition: var(--transition);
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .disabled-btn {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: all;
    }

    .card-rounded {
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: none;
    }

    .card-title {
        color: var(--green);
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--orange);
        border-radius: 2px;
    }

    .nav-tabs {
        border-bottom: 2px solid var(--green);
        margin-bottom: 25px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #555;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        margin-right: 5px;
        transition: var(--transition);
    }

    .nav-tabs .nav-link:hover {
        background-color: var(--light-green);
        border-color: transparent;
    }

    .nav-tabs .nav-link.active {
        background-color: var(--green);
        color: var(--white);
        border: none;
        position: relative;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--white);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
    }

    .table th {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        color: var(--white);
        padding: 15px 10px;
        font-weight: 600;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .table td {
        padding: 12px 10px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #e0e0e0;
    }

    .table tr:nth-child(even) {
        background-color: var(--light-green);
    }

    .table tr:hover {
        background-color: var(--light-orange);
        transition: var(--transition);
    }

    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .badge-opacity-warning {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .badge-opacity-success {
        background-color: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }

    .badge-opacity-danger {
        background-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .btn-primary {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: linear-gradient(to right, var(--dark-green), var(--green));
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 100, 0, 0.2);
    }

    .btn-sm {
        padding: 6px 12px;
        border-radius: 6px;
    }

    .bg-danger {
        background: linear-gradient(to right, var(--orange), var(--dark-orange)) !important;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
    }

    /* Styles pour les modals */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--box-shadow);
    }

    .modal-header {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        color: var(--white);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .modal-title {
        font-weight: 600;
    }

    .close {
        color: var(--white);
        opacity: 0.8;
    }

    .close:hover {
        color: var(--white);
        opacity: 1;
    }

    .form-control {
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 12px;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.2);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            border-radius: var(--border-radius);
            overflow-x: auto;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 15px;
            font-size: 14px;
        }
        
        .card-title {
            font-size: 1.5rem;
        }
        
        .table th, .table td {
            padding: 8px 5px;
            font-size: 12px;
        }
    }
</style>

<div class="row flex-grow form-background">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Listes des demandes d'extrait effectuées</h4>
                        <p class="text-muted">Gérez vos demandes d'extrait de décès</p>
                    </div>
                    <div>
                        <a href="{{ route('user.death.create') }}">
                            <button class="btn btn-lg text-white mb-0 me-0" type="button" style="background:linear-gradient(to right, var(--green), var(--dark-green))">
                                <i class="fas fa-plus-circle me-2"></i>Nouvelle demande
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Onglets -->
                <ul class="nav nav-tabs mt-4" id="decesTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link" id="partielles-tab" data-bs-toggle="tab" data-bs-target="#partielles" type="button" role="tab" aria-controls="partielles" aria-selected="false">
                            <i class="fas fa-user me-2"></i>Demandes en attentes
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">
                            <i class="fas fa-check-circle me-2"></i>Demandes terminées
                        </button>
                    </li>
                </ul>

                <!-- Contenu des Onglets -->
                <div class="tab-content" id="decesTabsContent">
                   <!-- Deuxième Onglet : Demandes en attentes -->
<div class="tab-pane fade" id="partielles" role="tabpanel" aria-labelledby="partielles-tab">
    <div class="table-responsive mt-4">
        <table class="table select-table">
            <thead>
                <tr class="text-center">
                    <th>Demandeur</th>
                    <th>Référence</th>
                    <th>Nom du défunt</th>
                    <th>Numéro registre</th>
                    <th>Date registre</th>
                    <th>CNI défunt</th>
                    <th>CNI déclarant</th>
                    <th>Document Mariage</th>
                    <th>Réquisition Police</th>
                    <th>État</th>
                    <th>Agent</th>
                    <th>Actions</th>
                    <th>Mode retrait</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deces as $dece)
                @if($dece->etat === 'en attente')
                <tr class="text-center">
                    <td>{{ $dece->user ? $dece->user->name : 'Demandeur inconnu' }}</td>
                    <td>{{ $dece->reference }}</td>
                    <td>{{ $dece->name }}</td>
                    <td>{{ $dece->numberR }}</td>
                    <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                   
                    <td>
                        @if($dece->CNIdfnt)
                            @if (pathinfo($dece->CNIdfnt, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $dece->CNIdfnt) }}" target="_blank">
                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $dece->CNIdfnt) }}" 
                                     alt="CNI défunt" 
                                     width="50" 
                                     height="auto" 
                                     onclick="showImage(this)">
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($dece->CNIdcl)
                            @if (pathinfo($dece->CNIdcl, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $dece->CNIdcl) }}" target="_blank">
                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $dece->CNIdcl) }}" 
                                     alt="CNI déclarant" 
                                     width="50" 
                                     height="auto" 
                                     onclick="showImage(this)">
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($dece->documentMariage)
                            @if (pathinfo($dece->documentMariage, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $dece->documentMariage) }}" target="_blank">
                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $dece->documentMariage) }}" 
                                     alt="Document mariage" 
                                     width="50" 
                                     height="auto" 
                                     onclick="showImage(this)">
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($dece->RequisPolice)
                            @if (pathinfo($dece->RequisPolice, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $dece->RequisPolice) }}" target="_blank">
                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $dece->RequisPolice) }}" 
                                     alt="Réquisition police" 
                                     width="50" 
                                     height="auto" 
                                     onclick="showImage(this)">
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $dece->etat == 'en attente' ? 'badge-opacity-warning' : ($dece->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                            {{ ucfirst($dece->etat) }}
                        </span>
                    </td>
                    <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                    <td>
                        @if ($dece->etat == 'en attente')
                        <button onclick="confirmDelete('#')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                        @else
                            <button class="btn btn-danger btn-sm disabled-btn text-center" onclick="showDisabledMessage()"><i class="fas fa-trash"></i></button>
                        @endif
                    </td>
                    <td><div class="bg-danger text-white">{{ $dece->choix_option == 'retrait_sur_place' ? 'Retrait sur place' : 'Livraison' }}</div></td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="13" class="text-center">Aucune demande en attente</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quatrième Onglet : Demandes terminées -->
<div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
    <div class="table-responsive mt-4">
        <table class="table select-table">
            <thead>
                <tr class="text-center">
                    <th>Référence</th>
                    <th>Nom du défunt</th>
                    <th>Type</th>
                    <th>Date de complétion</th>
                    <th>Agent</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deces->where('etat', 'terminé') as $dece)
                <tr class="text-center">
                    <td>{{ $dece->reference }}</td>
                    <td>{{ $dece->nomDefunt ?? $dece->name }}</td>
                    <td>{{ isset($dece->type) ? 'Copie' : 'Avec certificat' }}</td>
                    <td>{{ $dece->updated_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune demande terminée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modale -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="modalImage" class="modal-image" src="" alt="Image en grand">
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src;
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function showDisabledMessage() {
    Swal.fire({
        title: 'Impossible de supprimer',
        text: 'Vous ne pouvez pas supprimer cette demande car elle est en cours de traitement ou déjà terminée.',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

// Afficher un pop-up de succès après la suppression
@if(session('success'))
    Swal.fire({
        title: 'Succès !',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
@endif

// Afficher un pop-up d'erreur en cas d'échec de la suppression
@if(session('error'))
    Swal.fire({
        title: 'Erreur !',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
@endif

// Active le premier onglet par défaut
document.addEventListener('DOMContentLoaded', function() {
    // Active le premier onglet
    const firstTab = document.querySelector('#decesTabs .nav-link:first-child');
    if (firstTab) {
        firstTab.classList.add('active');
        const firstTabPane = document.querySelector(firstTab.getAttribute('data-bs-target'));
        if (firstTabPane) {
            firstTabPane.classList.add('show', 'active');
        }
    }
    
    // Initialise DataTables si nécessaire
    $('.select-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
        }
    });
});
</script>
<script>
    // Initialisation des onglets Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    // Activer le premier onglet par défaut
    const firstTab = new bootstrap.Tab(document.querySelector('#partielles-tab'));
    firstTab.show();
    
    // Gérer le clic sur les onglets
    const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabButtons.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const tabTarget = this.getAttribute('data-bs-target');
            const tabPane = document.querySelector(tabTarget);
            
            // Cacher tous les onglets
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            // Désactiver tous les boutons d'onglets
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Activer l'onglet cliqué
            this.classList.add('active');
            tabPane.classList.add('show', 'active');
        });
    });
});
</script>

@endsection