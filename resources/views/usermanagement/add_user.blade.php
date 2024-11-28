@extends('layouts.master')
@section('title')
@lang('Ajouter admin')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.admins') }}">Admins</a> @endslot
@slot('title') Ajouter admin @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
      <div class="content container-fluid">
            <div class="page-header mb-3 mb-lg-4 mt-3">
                  <!-- <div class="row align-items-center">
                        <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <h3 class="page-title">Ajouter admin</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <ul class="breadcrumb ml-auto">
                                    <li class="breadcrumb-item"><a href="{{ route('all.admins') }}">admins</a></li>
                                    <li class="breadcrumb-item active">Ajouter admin</li>
                              </ul>
                        </div>
                  </div> -->
            </div>

            <div class="row">
                  <div class="col-sm-12">
                        <div class="card comman-shadow">
                              <div class="card-header">Informations Admin</div>
                              <div class="card-body">
                                    {{-- Add User Form --}}
                                    <form method="POST" action="{{ route('store.admin') }}" class="forms-sample" enctype="multipart/form-data">
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
                                                      <label>Téléphone: <span class="login-danger">*</span></label>
                                                      <input type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}">
                                                      @error('phonenumber')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <!-- Role -->
                                                <div class="col-12 col-sm-4 mb-3">
                                                      <label>Position<span class="login-danger">*</span></label>
                                                      <select class="form-control select @error('roles') is-invalid @enderror" name="roles[]" id="roles" value="{{ old('roles') }}">
                                                            <option selected disabled>Position</option>
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role }}">{{ $role }}</option>
                                                            @endforeach
                                                      </select>
                                                      @error('roles')
                                                      <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <!-- responsibles -->
                                                <div class="col-md-4 mb-3" id="responsible_div" style="display:none;">
                                                      <label class="form-label" for="responsible_id">Responsable</label>
                                                      <select id="responsible_id" class="js-example-basic-single form-control @error('responsible_id') is-invalid @enderror" name="responsible_id">
                                                            <option selected disabled value="">Choisissez Responsable</option>
                                                            @foreach ($responsibles as $responsible)
                                                            <option value="{{ $responsible->id }}" {{ old('responsible_id') == $responsible->id ? 'selected' : '' }}>
                                                                  {{ $responsible->first_name }} {{ $responsible->last_name }}
                                                            </option>
                                                            @endforeach
                                                      </select>
                                                      @error('responsible_id')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
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

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rolesSelect = document.getElementById('roles');
        const responsibleDiv = document.getElementById('responsible_div');

        rolesSelect.addEventListener('change', function () {
            const selectedRole = this.value;
            if (selectedRole === 'Admin' || selectedRole === 'Commercial') {
                responsibleDiv.style.display = 'block';
            } else {
                responsibleDiv.style.display = 'none';
            }
        });
    });
</script>
@endsection