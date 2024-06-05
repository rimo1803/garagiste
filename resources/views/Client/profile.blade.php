@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profil Utilisateur</div>

                    <div class="card-body">
                        <p><strong>Nom d'utilisateur:</strong> {{ $user->username }}</p>
                        <p><strong>Prénom:</strong> {{ $user->firstname }}</p>
                        <p><strong>Nom:</strong> {{ $user->lastname }}</p>
                        <p><strong>Adresse:</strong> {{ $user->address }}</p>
                        <p><strong>Téléphone:</strong> {{ $user->phone }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Rôle:</strong> {{ $user->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
