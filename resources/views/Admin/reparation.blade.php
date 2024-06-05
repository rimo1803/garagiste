@extends('Admin.admin')

@section('main-content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion des Réparations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Gestion des Réparations</h1>

        <!-- Button to trigger add modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReparationModal">
            <i class="fas fa-plus-circle"></i> Ajouter une Réparation
        </button>

        <!-- Table of repairs -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($repairs as $repair)
                <tr>
                    <td>{{ $repair->id }}</td>
                    <td>{{ $repair->description }}</td>
                    <td>{{ $repair->status }}</td>
                    <td>{{ $repair->startDate }}</td>
                    <td>{{ $repair->endDate }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showReparationModal{{ $repair->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editReparationModal{{ $repair->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('delete', $repair->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

 <!-- Add Repair Modal -->
<div class="modal fade" id="addReparationModal" tabindex="-1" role="dialog" aria-labelledby="addReparationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('repairs.create') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addReparationModalLabel"><i class="fas fa-plus-circle"></i> Ajouter une Réparation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description"><i class="fas fa-cog"></i> Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status"><i class="fas fa-barcode"></i> Status</label>
                        <input type="text" name="status" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="startDate"><i class="fas fa-calendar-alt"></i> Date de Début</label>
                        <input type="date" name="startDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate"><i class="fas fa-calendar-alt"></i> Date de Fin</label>
                        <input type="date" name="endDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="vehiculeId"><i class="fas fa-car"></i> ID du Véhicule</label>
                        <select name="vehiculeId" class="form-control" required>
                            @foreach($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}">{{ $vehicule->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mecanicId"><i class="fas fa-wrench"></i> ID du Mécanicien</label>
                        <select name="mecanicId" class="form-control" required>
                            @foreach($mechanics as $mechanic)
                                <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mecanicNotes"><i class="fas fa-sticky-note"></i> Notes du Mécanicien</label>
                        <input type="text" name="mecanicNotes" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="clientNotes"><i class="fas fa-sticky-note"></i> Notes du Client</label>
                        <input type="text" name="clientNotes" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Show Repair Modal -->
    @foreach($repairs as $repair)
    <div class="modal fade" id="showReparationModal{{ $repair->id }}" tabindex="-1" role="dialog" aria-labelledby="showReparationModalLabel{{ $repair->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showReparationModalLabel{{ $repair->id }}"><i class="fas fa-eye"></i> Détails de la Réparation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> {{ $repair->id }}</p>
                    <p><strong>Description:</strong> {{ $repair->description }}</p>
                    <p><strong>Status:</strong> {{ $repair->status }}</p>
                    <p><strong>Date de Début:</strong> {{ $repair->startDate }}</p>
                    <p><strong>Date de Fin:</strong> {{ $repair->endDate }}</p>
                    <p><strong>ID du Véhicule:</strong> {{ $repair->vehiculeId }}</p>
                    <p><strong>ID du Mécanicien:</strong> {{ $repair->mecanicId }}</p>
                    <p><strong>Notes du Mécanicien:</strong> {{ $repair->mecanicNotes }}</p>
                    <p><strong>Notes du Client:</strong> {{ $repair->clientNotes }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Edit Repair Modal -->
    @foreach($repairs as $repair)
    <div class="modal fade" id="editReparationModal{{ $repair->id }}" tabindex="-1" role="dialog" aria-labelledby="editReparationModalLabel{{ $repair->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('repairs.update', $repair->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReparationModalLabel{{ $repair->id }}"><i class="fas fa-edit"></i> Modifier la Réparation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description"><i class="fas fa-cog"></i> Description</label>
                            <input type="text" name="description" class="form-control" value="{{ $repair->description }}" required>
                        </div>
                        <div class="form-group">
                            <label for="status"><i class="fas fa-barcode"></i> Status</label>
                            <input type="text" name="status" class="form-control" value="{{ $repair->status }}" required>
                        </div>
                        <div class="form-group">
                            <label for="startDate"><i class="fas fa-calendar-alt"></i> Date de Début</label>
                            <input type="date" name="startDate" class="form-control" value="{{ $repair->startDate }}" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate"><i class="fas fa-calendar-alt"></i> Date de Fin</label>
                            <input type="date" name="endDate" class="form-control" value="{{ $repair->endDate }}">
                        </div>
                        <div class="form-group">
                            <label for="vehiculeId"><i class="fas fa-car"></i> ID du Véhicule</label>
                            <select name="vehiculeId" class="form-control" required>
                                @foreach($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}" @if($vehicule->id == $repair->vehiculeId) selected @endif>{{ $vehicule->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mecanicId"><i class="fas fa-wrench"></i> ID du Mécanicien</label>
                            <select name="mecanicId" class="form-control" required>
                                @foreach($mechanics as $mechanic)
                                    <option value="{{ $mechanic->id }}" @if($mechanic->id == $repair->mecanicId) selected @endif>{{ $mechanic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mecanicNotes"><i class="fas fa-sticky-note"></i> Notes du Mécanicien</label>
                            <input type="text" name="mecanicNotes" class="form-control" value="{{ $repair->mecanicNotes }}">
                        </div>
                        <div class="form-group">
                            <label for="clientNotes"><i class="fas fa-sticky-note"></i> Notes du Client</label>
                            <input type="text" name="clientNotes" class="form-control" value="{{ $repair->clientNotes }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
