@extends('Admin.admin')

@section('main-content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Application</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
<nav class="navbar navbar-dark bg-light">
  <a class="navbar-brand text-dark" href="#"><b>Espace Administrateur</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
   </button>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-black">Gestion des reparations</h3>
            <hr>
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addPieceModal">
                <i class="fas fa-plus-circle"></i> Ajouter un reparation
            </button>

            <table class="table table-bordered">
                <thead class="bg-light text-dark">
                    <tr>
                        <th><i class="fas fa-cog"></i> description</th>
                        <th><i class="fas fa-barcode"></i> status</th>
                        <th><i class="fas fa-truck"></i> start_date</th>
                        <th><i class="fas fa-dollar-sign"></i> end_date</th>
                        <th><i class="fas fa-dollar-sign"></i> mecanicNotes</th>
                        <th><i class="fas fa-dollar-sign"></i> clientNotes</th>
                        <th><i class="fas fa-dollar-sign"></i> mecanicId</th>
                        <th><i class="fas fa-dollar-sign"></i> vehicleId</th>
                        <th><i class="fas fa-tools"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repairs as $repair)
                        <tr>
                            <td>{{ $repair->id }}</td>
                            <td>{{ $repair->description }}</td>
                            <td>{{ $repair->start_date }}</td>
                            <td>{{ $repair->end_date }}</td>
                            <td class="px-4 py-3 text-xs">
                                @if ($repair->status == 'completed')
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        {{ $repair->status }}
                                    </span>
                                @elseif ($repair->status == 'in_progress')
                                    <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:bg-orange-700 dark:text-orange-100">
                                        {{ $repair->status }}
                                    </span>
                                @elseif ($repair->status == 'pending')
                                    <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                        {{ $repair->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm btn-show" data-piece-id="{{ $repair->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editReparationModal{{ $repair->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('delete') }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="repaireId" value="{{ $repaire->id }}">
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Piece Modal -->
<div class="modal fade" id="addPieceModal" tabindex="-1" role="dialog" aria-labelledby="addPieceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('createForm') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addReparationModalLabel"><i class="fas fa-plus-circle"></i> Ajouter un reparation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description"><i class="fas fa-cog"></i>description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status"><i class="fas fa-barcode"></i> status</label>
                        <input type="text" name="status" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="startDate"><i class="fas fa-truck"></i> startDate</label>
                        <input type="text" name="startDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate"><i class="fas fa-dollar-sign"></i> endDate</label>
                        <input type="text" name="endDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="vehiculeId"><i class="fas fa-dollar-sign"></i> vehiculeId</label>
                        <input type="text" name="vehiculeId" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mecanicId"><i class="fas fa-dollar-sign"></i> mecanicId</label>
                        <input type="text" name="mecanicId" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mecanicNotes"><i class="fas fa-dollar-sign"></i> mecanicNotes</label>
                        <input type="text" name="mecanicNotes" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="clientNotes"><i class="fas fa-dollar-sign"></i> clientNotes</label>
                        <input type="text" name="clientNotes" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Piece Modal (for each piece) -->
@foreach($repairs as $repair)
<div class="modal fade" id="showPieceModal{{ $repair->id }}" tabindex="-1" role="dialog" aria-labelledby="showReparationModalLabel{{ $repair->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showReparationModalLabel{{ $repair->id }}"><i class="fas fa-eye"></i> Détails de la reparation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="description"><i class="fas fa-cog"></i>description</label>
                    <input type="text" name="description" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="status"><i class="fas fa-barcode"></i> status</label>
                    <input type="text" name="status" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="startDate"><i class="fas fa-truck"></i> startDate</label>
                    <input type="text" name="startDate" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="endDate"><i class="fas fa-dollar-sign"></i> endDate</label>
                    <input type="text" name="endDate" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="vehiculeId"><i class="fas fa-dollar-sign"></i> vehiculeId</label>
                    <input type="text" name="vehiculeId" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="mecanicId"><i class="fas fa-dollar-sign"></i> mecanicId</label>
                    <input type="text" name="mecanicId" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="mecanicNotes"><i class="fas fa-dollar-sign"></i> mecanicNotes</label>
                    <input type="text" name="mecanicNotes" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="clientNotes"><i class="fas fa-dollar-sign"></i> clientNotes</label>
                    <input type="text" name="clientNotes" class="form-control" readonly>
                </div>
            </div>
    </div>
</div>
@endforeach

<!-- Edit Piece Modal (for each piece) -->
@foreach($repairs as $repair)
<div class="modal fade" id="editPieceModal{{ $repair->id }}" tabindex="-1" role="dialog" aria-labelledby="editReparationModalLabel{{ $repair->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editPieceModalLabel{{ $repair->id }}"><i class="fas fa-edit"></i> Modifier la reparation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                   //  value="{{ $piece->partName }}
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description"><i class="fas fa-cog"></i>description</label>
                        <input type="text" name="description" class="form-control"  value="{{ $repair->description}}">
                    </div>
                    <div class="form-group">
                        <label for="status"><i class="fas fa-barcode"></i> status</label>
                        <input type="text" name="status" class="form-control" value="{{ $repair->status}}">
                    </div>
                    <div class="form-group">
                        <label for="startDate"><i class="fas fa-truck"></i> startDate</label>
                        <input type="text" name="startDate" class="form-control" value="{{ $repair->startDate}}">
                    </div>
                    <div class="form-group">
                        <label for="endDate"><i class="fas fa-dollar-sign"></i> endDate</label>
                        <input type="text" name="endDate" class="form-control" value="{{ $repair->endDate}}">
                    </div>
                    <div class="form-group">
                        <label for="vehiculeId"><i class="fas fa-dollar-sign"></i> vehiculeId</label>
                        <input type="text" name="vehiculeId" class="form-control" value="{{ $repair->vehiculeId}}">
                    </div>
                    <div class="form-group">
                        <label for="mecanicId"><i class="fas fa-dollar-sign"></i> mecanicId</label>
                        <input type="text" name="mecanicId" class="form-control" value="{{ $repair->mecanicId}}">
                    </div>
                    <div class="form-group">
                        <label for="mecanicNotes"><i class="fas fa-dollar-sign"></i> mecanicNotes</label>
                        <input type="text" name="mecanicNotes" class="form-control" value="{{ $repair->mecanicNotes}}">
                    </div>
                    <div class="form-group">
                        <label for="clientNotes"><i class="fas fa-dollar-sign"></i> clientNotes</label>
                        <input type="text" name="clientNotes" class="form-control" value="{{ $repair->clientNotes}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Show Piece Modal Script -->
<script>
    $(document).ready(function() {
        $('.btn-show').on('click', function() {
            var repairId = $(this).data('repair-id');
            $('#showreparationModal' + repairId).modal('show');
        });
    });
</script>
</body>
</html>
@endsection
