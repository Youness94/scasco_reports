@extends('layouts.master')
@section('title')
@lang('Ajouter utilisateurs')
@endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('accueil') }}">Tableau de Bord</a> @endslot
@slot('title') Ajouter Utilisateur @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mb-3 mb-lg-4 mt-3">
            <!-- <div class="row align-items-center">
                        <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <h3 class="page-title">Ajouter utilisateur</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <ul class="breadcrumb ml-auto">
                                    <li class="breadcrumb-item"><a href="{{ route('all.client.users') }}">utilisateur</a></li>
                                    <li class="breadcrumb-item active">Ajouter utilisateur</li>
                              </ul>
                        </div>
                  </div> -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-header">Informations utilisateur</div>
                    <div class="card-body">
                        {{-- Add User Form --}}
                        <form method="POST" action="{{ route('store.client.user') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Prénom : <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Nom: <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>E-mail: <span class="login-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Phone: <span class="login-danger">*</span></label>
                                    <input type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}">
                                    @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger"> {{ $message }} </span>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Role Name <span class="login-danger">*</span></label>
                                    <select class="form-control select @error('roles') is-invalid @enderror" name="roles" id="roles" value="{{ old('roles') }}">
                                        <option selected disabled>Role Type</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- city_id -->
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Villes<span class="login-danger">*</span></label>
                                    <select class="form-control select @error('city_id') is-invalid @enderror" name="city_id" id="city_id" value="{{ old('city_id') }}">
                                        <option selected disabled>Role Type</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Mot de Passe: <span class="login-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- End of Add User Form --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection