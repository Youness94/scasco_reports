@extends('layouts.master')
@section('title')
@lang('Les admins')
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
@slot('title') List des Admins  @endslot
@endcomponent 
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- <div class="page-header mb-3 mb-lg-4 mt-3">
            <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Modifier admin</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="{{ route('all.admins') }}">Admins</a></li>
                        <li class="breadcrumb-item active">Modifier admin</li>
                    </ul>
                </div>
            </div>
        </div> -->

        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-header">Informations Admin</div>
                    <div class="card-body">
                        <form action="{{ route('admin.update', ['id' => $user->id]) }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Prénom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                                </div>


                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Nom <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                                </div>

                                <div class="col-12 col-sm-4 mb-3">
                                    <label>E-mail <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                </div>

                                <!-- 
                                     <div class="col-xxl-12">
                                        <label>Phone  <span class="login-danger">*</span></label>
                                        <input type="number" class="form-control" name="phonenumber" value="{{ $user->phonenumber }}">
                                    </div>
                              -->

                                <!-- <div class="col-12 col-sm-4 mb-3">
                                    <label>Status <span class="login-danger">*</span></label>
                                    <select class="form-control select" name="status">
                                        <option disabled>{{ old('status') }}</option>
                                        <option value="Active" {{ $user->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ $user->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div> -->
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Status: <span class="login-danger"></span></label>
                                    <select class="form-control select @error('status') is-invalid @enderror" name="status_user" id="status_user">

                                        <option value="Active" {{ old('status',$user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status',$user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>


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
                                        <option value="{{ $role }}" {{ old('roles', $user->roles->pluck('name')->first()) == $role ? 'selected' : '' }}>
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
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Type d'utilisateur <span class="login-danger"></span></label>
                                    <select class="form-control select" name="user_type">
                                        <option disabled>{{ old('user_type') }}</option>
                                        <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="Client" {{ $user->user_type == 'Client' ? 'selected' : '' }}>Client</option>
                                    </select>
                                </div>

                                <!-- <div class="mb-3">
                                    <label class="form-label" for="image">Image upload</label>
                                    <input class="form-control" name="photo" type="file" id="image">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="image">Image Preview</label>
                                    <img id="photo" class="wd-80 rounded-circle" src="{{ (!empty($user->photo)) ? url('upload/admin_images/'.$user->photo) : url('upload/no_image.jpg')}}" alt="profile">
                                </div> -->

                                <!-- <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Position <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="position" value="{{ $user->position }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Department <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="department" value="{{ $user->department }}">
                                    </div>
                                </div> -->
                                <div class="col-12 col-sm-4 mb-3">
                                    <label>Date de Mise à Jour <span class="login-danger"></span></label>
                                    <input type="text" class="form-control" name="updated_at" value="{{ $user->updated_at }}" readonly>
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