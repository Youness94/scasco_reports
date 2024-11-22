@extends('layouts.master')
@section('title')
@lang('Modifier utilisateurs')
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
@slot('title') Modifier Utilisateur @endslot
@endcomponent
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- <div class="page-header mb-3 mb-lg-4 mt-3">
            <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Modifier utilisateur</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="{{ route('all.client.users') }}">Utilisateurs</a></li>
                        <li class="breadcrumb-item active">Modifier utilisateur</li>
                    </ul>
                </div>
            </div>
        </div> -->

        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Informations utilisateur</div>
                    <div class="card-body">
                        <form action="{{ route('client.user.update', ['id' => $client_user->id]) }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Prénom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ $client_user->first_name }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $client_user->id }}">
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Nom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $client_user->last_name }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $client_user->id }}">
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>E-mail <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="email" value="{{ $client_user->email }}">
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Status: <span class="login-danger"></span></label>
                                    <select class="form-control select @error('status') is-invalid @enderror" name="status_user" id="status_user">

                                        <option value="Active" {{ old('status',$client_user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status',$client_user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>


                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Role<span class="login-danger"></span></label>
                                    <select class="form-control select @error('role_name') is-invalid @enderror" name="roles" id="roles">

                                        @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ old('roles', $client_user->roles->pluck('name')->first()) == $role ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- city_id -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="city_id">Ville</label>
                                    <select id="city_id" class="form-control @error('city_id') is-invalid @enderror" name="city_id">
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $client_user->clients->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>





                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Date de Mise à Jour <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="updated_at" value="{{ $client_user->updated_at }}" readonly>
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Soumettre</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection