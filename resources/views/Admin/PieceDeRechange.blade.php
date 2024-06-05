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
            <h3 class="text-black">Gestion des Pièces De Rechange</h3>
            <hr>
            <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addPieceModal">
                <i class="fas fa-plus-circle"></i> Ajouter une Pièce de Rechange
            </button>

            <table class="table table-bordered">
                <thead class="bg-light text-dark">
                    <tr>
                        <th><i class="fas fa-cog"></i> Nom de la Pièce</th>
                        <th><i class="fas fa-barcode"></i> Référence</th>
                        <th><i class="fas fa-truck"></i> Fournisseur</th>
                        <th><i class="fas fa-dollar-sign"></i> Prix</th>
                        <th><i class="fas fa-tools"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pieces as $piece)
                        <tr>
                            <td>{{ $piece->partName }}</td>
                            <td>{{ $piece->partReference }}</td>
                            <td>{{ $piece->supplier }}</td>
                            <td>{{ $piece->price }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-show" data-piece-id="{{ $piece->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPieceModal{{ $piece->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('deletePieceDeRechange') }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="pieceId" value="{{ $piece->id }}">
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
            <form method="POST" action="{{ route('addPieceDeRechange') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPieceModalLabel"><i class="fas fa-plus-circle"></i> Ajouter une Pièce de Rechange</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="partName"><i class="fas fa-cog"></i> Nom de la Pièce</label>
                        <input type="text" name="partName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="partReference"><i class="fas fa-barcode"></i> Référence</label>
                        <input type="text" name="partReference" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier"><i class="fas fa-truck"></i> Fournisseur</label>
                        <input type="text" name="supplier" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fas fa-dollar-sign"></i> Prix</label>
                        <input type="text" name="price" class="form-control" required>
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
@foreach($pieces as $piece)
<div class="modal fade" id="showPieceModal{{ $piece->id }}" tabindex="-1" role="dialog" aria-labelledby="showPieceModalLabel{{ $piece->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showPieceModalLabel{{ $piece->id }}"><i class="fas fa-eye"></i> Détails de la Pièce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="partName"><i class="fas fa-cog"></i> Nom de la Pièce</label>
                    <input type="text" value="{{ $piece->partName }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="partReference"><i class="fas fa-barcode"></i> Référence</label>
                    <input type="text" value="{{ $piece->partReference }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="supplier"><i class="fas fa-truck"></i> Fournisseur</label>
                    <input type="text" value="{{ $piece->supplier }}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="price"><i class="fas fa-dollar-sign"></i> Prix</label>
                    <input type="text" value="{{ $piece->price }}" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Edit Piece Modal (for each piece) -->
@foreach($pieces as $piece)
<div class="modal fade" id="editPieceModal{{ $piece->id }}" tabindex="-1" role="dialog" aria-labelledby="editPieceModalLabel{{ $piece->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('updatePieceDeRechange') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editPieceModalLabel{{ $piece->id }}"><i class="fas fa-edit"></i> Modifier la Pièce de Rechange</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $piece->id }}">
                    <div class="form-group">
                        <label for="partName"><i class="fas fa-cog"></i> Nom de la Pièce</label>
                        <input type="text" name="partName" value="{{ $piece->partName }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="partReference"><i class="fas fa-barcode"></i> Référence</label>
                        <input type="text" name="partReference" value="{{ $piece->partReference }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier"><i class="fas fa-truck"></i> Fournisseur</label>
                        <input type="text" name="supplier" value="{{ $piece->supplier }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price"><i class="fas fa-dollar-sign"></i> Prix</label>
                        <input type="text" name="price" value="{{ $piece->price }}" class="form-control" required>
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

<!-- Show Piece Modal Script -->
<script>
    $(document).ready(function() {
        $('.btn-show').on('click', function() {
            var pieceId = $(this).data('piece-id');
            $('#showPieceModal' + pieceId).modal('show');
        });
    });
</script>
</body>
</html>
@endsection
