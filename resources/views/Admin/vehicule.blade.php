@extends('Admin.admin')

@section('main-content')
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Véhicules</title>
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
            <h3 class="text-black">Gestion des véhicules</h3>
            <hr>
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addStudentModal">
                <i class="fas fa-car"></i>  Add Vehicule
            </button>


            <table class="table table-bordered">
                <thead class="bg-light text-dark">
                    <tr>
                        <th><i class="fas fa-car"></i> Marque</th>
                        <th><i class="fas fa-car"></i> Modèle</th>
                        <th><i class="fas fa-gas-pump"></i> Type de carburant</th>
                        <th><i class="fas fa-address-card"></i> Immatriculation</th>
                        <th><i class="fas fa-user"></i> Propriétaire</th>
                        <th><i class="fas fa-cog"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicules as $vehicule)
                        <tr>
                            <td>{{ $vehicule->mark }}</td>
                            <td>{{ $vehicule->model }}</td>
                            <td>{{ $vehicule->fuelType }}</td>
                            <td>{{ $vehicule->registration }}</td>
                            <td>{{ $vehicule->user_id }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-show" data-client-id="{{$vehicule->id}}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn btn-warning btn-sm btn-edit" data-client-id="{{$vehicule->id}}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form method="POST" action="{{route('deleteVehicule')}}" class="d-inline btn-delete">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="vehiculeId" value="{{$vehicule->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm" >
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
<!-- Add Vehicle Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action=" {{route('addVehicule')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel"><i class="fas fa-car"></i> Ajouter un véhicule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mark"><i class="fas fa-car"></i> Marque</label>
                        <input type="text" name="mark" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="model"><i class="fas fa-car"></i> Modèle</label>
                        <input type="text" name="model" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fuelType"><i class="fas fa-gas-pump"></i> Type de carburant</label>
                        <input type="text" name="fuelType" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="registration"><i class="fas fa-address-card"></i> Immatriculation</label>
                        <input type="text" name="registration" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="photo"><i class="fas fa-image"></i> Photo</label>
                        <input type="file" name="photo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="user_id"><i class="fas fa-user"></i> Propriétaire</label>
                        <input type="text" name="user_id" class="form-control" required>
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
<!-- Show Vehicle Modal (for each vehicle) -->
@foreach($vehicules as $vehicule)
<div class="modal fade" id="showClientModal{{$vehicule->id}}" tabindex="-1" role="dialog"
    aria-labelledby="showVehicleModalLabel{{$vehicule->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showClientModalLabel{{$vehicule->id}}"><i class="fas fa-eye"></i> Détails du véhicule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="mark"><i class="fas fa-car"></i> Marque</label>
                    <input type="text" value="{{$vehicule->mark}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="model"><i class="fas fa-car"></i> Modèle</label>
                    <input type="text" value="{{$vehicule->model}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="fuelType"><i class="fas fa-gas-pump"></i> Type de carburant</label>
                    <input type="text" value="{{$vehicule->fuelType}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="registration"><i class="fas fa-address-card"></i> Immatriculation</label>
                    <input type="text" value="{{$vehicule->registration}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="photo"><i class="fas fa-image"></i> Photo</label>
                    <img src="{{$vehicule->photo}}" alt="Vehicle Photo" class="img-fluid">
                </div>
                <div class="form-group">
                    <label for="user_id"><i class="fas fa-user"></i> Propriétaire</label>
                    <input type="text" value="{{$vehicule->user_id}}" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal d'édition du véhicule (pour chaque véhicule) -->
@foreach($vehicules as $vehicule)
<div class="modal fade" id="editVehicleModal{{$vehicule->id}}" tabindex="-1" role="dialog" aria-labelledby="editVehicleModalLabel{{$vehicule->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleModalLabel{{$vehicule->id}}"><i class="fas fa-edit"></i> Modifier le véhicule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('updateVehicule') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $vehicule->id }}">
                    <div class="form-group">
                        <label for="mark">Marque</label>
                        <input type="text" name="mark" class="form-control" value="{{ $vehicule->mark }}" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Modèle</label>
                        <input type="text" name="model" class="form-control" value="{{ $vehicule->model }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fuelType">Type de carburant</label>
                        <input type="text" name="fuelType" class="form-control" value="{{ $vehicule->fuelType }}" required>
                    </div>
                    <div class="form-group">
                        <label for="registration">Immatriculation</label>
                        <input type="text" name="registration" class="form-control" value="{{ $vehicule->registration }}" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_id">Propriétaire</label>
                        <input type="text" name="user_id" class="form-control" value="{{ $vehicule->user_id }}" required>
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
@endforeach

<script>
    $(document).ready(function(){
        // Affichage du modal de détails du véhicule
        $('.btn-show').click(function(){
            var clientId = $(this).data('client-id');
            $('#showClientModal' + clientId).modal('show');
        });

        // Affichage du modal d'édition du véhicule
        $('.btn-edit').click(function(){
    var vehiculeId = $(this).data('client-id');
    $('#editVehicleModal' + vehiculeId).modal('show');
});


        // Soumission du formulaire de suppression du véhicule
        $('.btn-delete').click(function(){
            var form = $(this).closest('form');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce véhicule?')) {
                form.submit();
            }
        });
    });
</script>

@endsection



</body>
