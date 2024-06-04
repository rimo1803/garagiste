@extends('layouts.admin')
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

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
                <h3 class="text-black">Gestion des clients </h3>
                <hr>
                <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addStudentModal">
                <i class="fas fa-user-plus"></i>    Add Client
                </button>

                <table class="table table-bordered">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-address-card"></i> Address</th>
                            <th><i class="fas fa-cog"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                         <tr>
                            <td>{{$client->firstname}} </td>
                            <td> {{$client->email}}</td>
                            <td> {{$client->address}}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-show" data-client-id="{{$client->id}}">
                                    <i class="fas fa-eye"></i>
                                </button>


                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editStudentModal{{$client->id}}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{route('deleteClient')}} " class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="clientId" value="{{$client->id}}">
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$clients->links()}}
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action=" {{route('addClient')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel"><i class="fas fa-user-plus"></i> Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname"><i class="fas fa-user"></i> FirstName</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname"><i class="fas fa-user"></i> LastName</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> UserName</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-envelope"></i> NumberPhone</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="fas fa-address-card"></i> Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Show Client Modal (for each client) -->
@foreach($clients as $client)
<div class="modal fade" id="showClientModal{{$client->id}}" tabindex="-1" role="dialog"
    aria-labelledby="showClientModalLabel{{$client->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showClientModalLabel{{$client->id}}"><i class="fas fa-eye"></i> Show Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="firstname"><i class="fas fa-user"></i> First Name</label>
                    <input type="text" value="{{$client->firstname}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="lastname"><i class="fas fa-user"></i> Last Name</label>
                    <input type="text" value="{{$client->lastname}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> User Name</label>
                    <input type="text" value="{{$client->username}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-user"></i> Email</label>
                    <input type="text" value="{{$client->email}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-user"></i> Phone</label>
                    <input type="text" value="{{$client->phone}}" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="address"><i class="fas fa-user"></i> Address</label>
                    <input type="text" value="{{$client->address}}" class="form-control" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<script>
    $(document).ready(function(){
        $('.btn-show').click(function(){
            var clientId = $(this).data('client-id');
            $('#showClientModal' + clientId).modal('show');
        });
    });
</script>

    <!-- Edit Student Modal (for each student) -->
    @foreach($clients as $client)
    <div class="modal fade" id="editStudentModal{{$client->id}}" tabindex="-1" role="dialog"
        aria-labelledby="editStudentModalLabel{{$client->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{route('updateClient')}} ">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel {{$client->id}}"><i class="fas fa-edit"></i> Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value=" {{$client->id}}">
                        <div class="form-group">
                            <label for="firstname"><i class="fas fa-user"></i> FirstName</label>
                            <input type="text" name="firstname" value=" {{$client->firstname}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname"><i class="fas fa-user"></i> LastName</label>
                            <input type="text" name="lastname" value=" {{$client->lastname}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> UserName</label>
                            <input type="text" name="username" value=" {{$client->username}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" value="{{$client->email}} " class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone"><i class="fas fa-envelope"></i> phoneNumber</label>
                            <input type="text" name="phone" value="{{$client->phone}} " class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><i class="fas fa-address-card"></i> Address</label>
                            <input type="text" name="address" value="{{$client->address}} " class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</body>
