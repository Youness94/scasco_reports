@extends('layouts.master')
@section('title')
@lang('Modifier client')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.clients') }}">Les Positions</a> @endslot
@slot('title') Modifier Client @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header mb-3 mb-lg-4 mt-3">

            </div>

            <!-- <div class="row"> -->

            <!-- <div class="col-xxl-12"> -->
            <!-- <div class="card">
                              <div class="card-body d-flex flex-column">-->
            <!-- <div class="live-preview flex-grow-1"> -->
            <form method="POST" action="{{ route('update.client', ['id' => $client->id]) }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Client</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Client Type -->

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_type">Type de client</label>
                                                            <select id="client_type" class="form-control @error('client_type') is-invalid @enderror" name="client_type">
                                                                  <option value="Particulier" {{ old('client_type',$client->client_type) == 'Particulier' ? 'selected' : '' }}>Particulier</option>
                                                                  <option value="Entreprise" {{ old('client_type',$client->client_type) == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                                                            </select>
                                                            @error('Type de client')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- First Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_first_name">Prénom du Client</label>
                                                            <input type="text" class="form-control @error('client_first_name') is-invalid @enderror" name="client_first_name" value="{{ $client->client_first_name }}">
                                                            @error('client_first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Last Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_last_name">Nom du Client</label>
                                                            <input type="text" class="form-control @error('client_last_name') is-invalid @enderror" name="client_last_name" value="{{ $client->client_last_name }}">
                                                            @error('client_last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- City -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="city_id">Ville</label>
                                                            <select id="city_id" class="form-control @error('city_id') is-invalid @enderror" name="city_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  @foreach ($cities as $city)
                                                                  <option value="{{ $city->id }}" {{ old('city_id',$client->city_id) == $city->id ? 'selected' : '' }}>
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

                                                      <!-- Client Address -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_address">Adresse du Client</label>
                                                            <input type="text" class="form-control @error('client_address') is-invalid @enderror" name="client_address" value="{{ $client->client_address }}">
                                                            @error('client_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Client Phone -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_phone">Téléphone du Client</label>
                                                            <input type="text" class="form-control @error('client_phone') is-invalid @enderror" name="client_phone" value="{{ $client->client_phone }}">
                                                            @error('client_phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Client Email -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_email">E-mail du Client</label>
                                                            <input type="email" class="form-control @error('client_email') is-invalid @enderror" name="client_email" value="{{ $client->client_email }}">
                                                            @error('client_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Raison Sociale -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="raison_sociale">Raison Sociale du Client</label>
                                                            <input type="text" class="form-control @error('raison_sociale') is-invalid @enderror" name="raison_sociale" value="{{ $client->raison_sociale }}">
                                                            @error('raison_sociale')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- RC -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="RC">RC du Client</label>
                                                            <input type="text" class="form-control @error('RC') is-invalid @enderror" name="RC" value="{{ $client->RC }}">
                                                            @error('RC')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- ICE -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="ICE">ICE du Client</label>
                                                            <input type="text" class="form-control @error('ICE') is-invalid @enderror" name="ICE" value="{{ $client->ICE }}">
                                                            @error('ICE')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>


                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-body d-flex flex-row">
                                          <div class="flex-grow-1">
                                          </div>
                                          <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </form>
            <!-- </div>

                              </div>-->
            <!-- </div> -->
      </div> <!-- end col -->
</div><!--end row-->


</div>
</div>



@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection