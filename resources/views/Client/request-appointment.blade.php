@extends('Admin.admin')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Demande de Rendez-vous') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('request-appointment') }}">
                            @csrf

                            <input type="hidden" name="client_id" value="{{ $client_id }}">

                            <div class="form-group row">
                                <label for="appointment_date" class="col-md-4 col-form-label text-md-right">{{ __('Date du rendez-vous') }}</label>

                                <div class="col-md-6">
                                    <input id="appointment_date" type="date" class="form-control @error('appointment_date') is-invalid @enderror" name="appointment_date" required autofocus>

                                    @error('appointment_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Soumettre') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
