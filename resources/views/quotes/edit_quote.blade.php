@extends('layouts.master')
@section('title')
@lang('modifier devis')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.quotes') }}">Matu Devis</a> @endslot
@slot('title') modifier devis @endslot
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
            <form method="POST" action="{{ route('update.quote', ['id' => $quoteInfo->id]) }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Informations Client</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- client informations -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="city_id">Ville</label>
                                                            <select id="city_id" class="form-control @error('city_id') is-invalid @enderror" name="city_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  @foreach ($cities as $city)
                                                                  <option value="{{ $city->id }}" {{ old('city_id',$quoteInfo->city_id) == $city->id ? 'selected' : '' }}>
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
                                                      <div class="col-md-4 mb-3">

                                                            <label class="form-label" for="address_line">Address</label>
                                                            <input type="text" class="form-control @error('address_line') is-invalid @enderror" name="address_line" value="{{$quoteInfo->address_line }}">
                                                      </div>

                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="payment_method_id">Méthode de paiement</label>
                                                            <select id="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror" name="payment_method_id">
                                                                  <option selected disabled value="">choisissez une méthode</option>
                                                                  @foreach ($payment_methods as $payment_method)
                                                                  <option value="{{ $payment_method->id }}" {{ old('payment_method_id',$quoteInfo->payment_method_id) == $payment_method->id ? 'selected' : '' }}>
                                                                        {{ $payment_method->name }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('payment_method_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Cheque Quantity -->
                                                      <div id="quantity-section" class="col-md-6 mb-3">
                                                            <label class="form-label">Détails des Chèques</label>
                                                            <div class="row">
                                                            <div class="col-md-4 mb-3">
                                                                        <!-- Cheque Quantity Input -->
                                                                        <input type="number" id="cheque_quantity" name="cheque_quantity" class="form-control"
                                                                              value="{{ count($quoteInfo->chequesInfos ?? []) }}" min="0" readonly>
                                                                  </div>
                                                            </div>
                                                      </div>

                                                      <!-- Cheques List -->
                                                      <div id="cheques-wrapper">
                                                            @foreach($quoteInfo->chequesInfos ?? [] as $index => $cheque)
                                                            <div id="cheque-{{ $index }}" class="cheque-group">
                                                                  <label>Chéque numéro {{ $index + 1 }}</label>
                                                                  <div class="row">
                                                                        <div class="col-md-4">
                                                                              <input type="text" name="cheques[{{ $index }}][cheque_number]" class="form-control"
                                                                                    value="{{ $cheque->cheque_number }}" placeholder="Cheque Number">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                              <input type="date" name="cheques[{{ $index }}][cheque_date]" class="form-control"
                                                                                    value="{{ $cheque->cheque_date }}" placeholder="Cheque Date">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                              <!-- Remove Button for Each Cheque -->
                                                                              <button type="button" class="btn btn-danger remove-cheque-btn">Remove</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                            @endforeach
                                                      </div>

                                                      <!-- Add Button -->
                                                      <div class="col-md-4 mt-4">
                                                            <button type="button" class="btn btn-primary" id="add-cheque">Add Cheque</button>
                                                      </div>




                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!-- quote informations -->
                  <div class="col-md-12">
                        <div class="card">
                              <div class="card-header">Informations de devis</div>

                              <div class="card-body d-flex flex-column">
                                    <div class="live-preview flex-grow-1">
                                          <div class="row">
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label" for="date_effet">Date effet</label>
                                                      <input type="date" class="form-control @error('date_effet') is-invalid @enderror" name="date_effet" value="{{ $quoteInfo->date_effet }}">
                                                      @error('date_effet')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label" for="date_echeance">Date echeance</label>
                                                      <input type="date" class="form-control @error('date_echeance') is-invalid @enderror" name="date_echeance" value="{{ $quoteInfo->date_echeance }}">
                                                      @error('date_echeance')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                      <label class="form-label" for="prorata_days">Prorata en J</label>
                                                      <input type="number" class="form-control @error('prorata_days') is-invalid @enderror" name="prorata_days" value="{{ $quoteInfo->prorata_days}}" readonly>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="date_MEC">Date MEC</label>
                                                      <input type="date" class="form-control @error('date_MEC') is-invalid @enderror" name="date_MEC" placeholder="valeur venale" value="{{ $quoteInfo->date_MEC }}">
                                                      @error('date_MEC')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="age_du_vehicule_by_years">Âge du véhicule (Années)</label>
                                                      <input type="number" class="form-control @error('age_du_vehicule_by_years') is-invalid @enderror" name="age_du_vehicule_by_years" value="{{ $quoteInfo->age_du_vehicule_by_years }}" readonly>
                                                </div>


                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_neuf">Valeur à neuf</label>
                                                      <input type="number" class="form-control @error('valeur_neuf') is-invalid @enderror" name="valeur_neuf" id="valeur_neuf" value="{{ $quoteInfo->valeur_neuf }}">

                                                </div>

                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_venale">Valeur venale</label>
                                                      <input type="number" class="form-control @error('valeur_venale') is-invalid @enderror" name="valeur_venale" value="{{ $quoteInfo->valeur_venale }}">
                                                      @error('valeur_venale')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_glaces">Valeur glaces</label>
                                                      <input type="number" class="form-control @error('valeur_glaces') is-invalid @enderror" name="valeur_glaces" id="valeur_glaces" value="{{ $quoteInfo->valeur_glaces }}">
                                                      @error('valeur_glaces')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                      <label class="form-label" for="valeur_glaces">Valeur retroviseurs</label>
                                                      <input type="number" class="form-control @error('valeur_retroviseurs') is-invalid @enderror" id="valeur_retroviseurs" name="valeur_retroviseurs" value="{{$quoteInfo->valeur_retroviseurs }}">
                                                      @error('valeur_retroviseurs')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="energie">Type de energie</label>
                                                      <select id="energie" class="form-control @error('energie') is-invalid @enderror" name="energie">
                                                            <option value="DIESEL" {{ old('energie',$quoteInfo->energie) == 'DIESEL' ? 'selected' : '' }}>DIESEL</option>
                                                            <option value="ESSENCE" {{ old('energie',$quoteInfo->energie) == 'ESSENCE' ? 'selected' : '' }}>ESSENCE</option>
                                                            <option value="HYBRIDE" {{ old('energie',$quoteInfo->energie) == 'HYBRIDE' ? 'selected' : '' }}>HYBRIDE</option>
                                                            <option value="ELECTRIQUE" {{ old('energie',$quoteInfo->energie) == 'ELECTRIQUE' ? 'selected' : '' }}>ELECTRIQUE</option>
                                                      </select>
                                                      @error('energie')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="puissance_fiscale">Type de energie</label>
                                                      <select id="puissance_fiscale" class="form-control @error('puissance_fiscale') is-invalid @enderror" name="puissance_fiscale">
                                                            <option value="1" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '1' ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '2' ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '3' ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '4' ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '5' ? 'selected' : '' }}>5</option>
                                                            <option value="6" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '6' ? 'selected' : '' }}>6</option>
                                                            <option value="7" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '7' ? 'selected' : '' }}>7</option>
                                                            <option value="8" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '8' ? 'selected' : '' }}>8</option>
                                                            <option value="9" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '9' ? 'selected' : '' }}>9</option>
                                                            <option value="10" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '10' ? 'selected' : '' }}>10</option>
                                                            <option value="11" {{ old('puissance_fiscale',$quoteInfo->puissance_fiscale) == '11' ? 'selected' : '' }}>11</option>
                                                      </select>
                                                      @error('energie')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="vol">Vol</label>
                                                      <select id="vol" class="form-control @error('vol') is-invalid @enderror" name="vol">
                                                            <option value="0" {{ old('vol',$quoteInfo->vol) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('vol',$quoteInfo->vol) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('vol')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="bris_de_glace">Bris de glace</label>
                                                      <select id="bris_de_glace" class="form-control @error('bris_de_glace') is-invalid @enderror" name="bris_de_glace">
                                                            <option value="0" {{ old('bris_de_glace',$quoteInfo->bris_de_glace) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('bris_de_glace',$quoteInfo->bris_de_glace) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('bris_de_glace')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="dommage_collision">Dommage collision</label>
                                                      <select id="dommage_collision" class="form-control @error('dommage_collision') is-invalid @enderror" name="dommage_collision">
                                                            <option value="0" {{ old('dommage_collision',$quoteInfo->dommage_collision) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('dommage_collision',$quoteInfo->dommage_collision) == '1' ? 'selected' : '' }}>Oui</option>
                                                      </select>
                                                      @error('dommage_collision')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3" id="dommage_collision_value_container" style="display: none;">
                                                      <label class="form-label" for="dommage_collision_value">Plafond DC</label>
                                                      <select id="dommage_collision_value" class="form-control @error('dommage_collision_value') is-invalid @enderror" name="dommage_collision_value">
                                                            <option value="10000" {{ old('dommage_collision_value',$quoteInfo->dommage_collision_value) == '10000' ? 'selected' : '' }}>10,000</option>
                                                            <option value="20000" {{ old('dommage_collision_value',$quoteInfo->dommage_collision_value) == '20000' ? 'selected' : '' }}>20,000</option>
                                                            <option value="30000" {{ old('dommage_collision_value',$quoteInfo->dommage_collision_value) == '30000' ? 'selected' : '' }}>30,000</option>
                                                            <option value="40000" {{ old('dommage_collision_value',$quoteInfo->dommage_collision_value) == '40000' ? 'selected' : '' }}>40,000</option>
                                                            <option value="50000" {{ old('dommage_collision_value',$quoteInfo->dommage_collision_value) == '50000' ? 'selected' : '' }}>50,000</option>
                                                      </select>
                                                      @error('dommage_collision_value')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="tierce">Tierce</label>
                                                      <select id="tierce" class="form-control @error('tierce') is-invalid @enderror" name="tierce">
                                                            <option value="0" {{ old('tierce',$quoteInfo->tierce) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('tierce',$quoteInfo->tierce) == '1' ? 'selected' : '' }}>Oui</option>
                                                      </select>
                                                      @error('tierce')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3" id="tierce_value_container" style="display: none;">
                                                      <label class="form-label" for="tierce_value">Valeur de tierce</label>
                                                      <select id="tierce_value" class="form-control @error('tierce_value') is-invalid @enderror" name="tierce_value">
                                                            <option value="0.03" {{ old('tierce_value',$quoteInfo->tierce_value) == '0.03' ? 'selected' : '' }}>3%</option>
                                                            <option value="0.05" {{ old('tierce_value',$quoteInfo->tierce_value) == '0.05' ? 'selected' : '' }}>5%</option>
                                                            <option value="0.1" {{ old('tierce_value',$quoteInfo->tierce_value) == '0.1' ? 'selected' : '' }}>10%</option>
                                                            <option value="0.15" {{ old('tierce_value',$quoteInfo->tierce_value) == '0.15' ? 'selected' : '' }}>15%</option>
                                                            <option value="0.2" {{ old('tierce_value',$quoteInfo->tierce_value) == '0.2' ? 'selected' : '' }}>20%</option>
                                                      </select>
                                                      @error('tierce_value')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="assistance">Assistance</label>
                                                      <select id="assistance" class="form-control @error('assistance') is-invalid @enderror" name="assistance">
                                                            <option value="0" {{ old('assistance',$quoteInfo->assistance) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('assistance',$quoteInfo->assistance) == '1' ? 'selected' : '' }}>Oui</option>
                                                      </select>
                                                      @error('assistance')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3" id="assistance_type_container" style="display: none;">
                                                      <label class="form-label" for="assistance_type">Type d'assistance</label>
                                                      <select id="assistance_type" class="form-control @error('assistance_type') is-invalid @enderror" name="assistance_type">
                                                            <option value="basique" {{ old('assistance_type',$quoteInfo->assistance_type) == 'basique' ? 'selected' : '' }}>Basique</option>
                                                            <option value="economique" {{ old('assistance_type',$quoteInfo->assistance_type) == 'economique' ? 'selected' : '' }}>Economique</option>
                                                            <option value="standard" {{ old('assistance_type',$quoteInfo->assistance_type) == 'standard' ? 'selected' : '' }}>Standard</option>
                                                            <option value="elargie" {{ old('assistance_type',$quoteInfo->assistance_type) == 'elargie' ? 'selected' : '' }}>Elargie</option>
                                                            <option value="gold" {{ old('assistance_type',$quoteInfo->assistance_type) == 'gold' ? 'selected' : '' }}>Gold</option>
                                                            <option value="vip" {{ old('assistance_type',$quoteInfo->assistance_type) == 'vip' ? 'selected' : '' }}>VIP</option>
                                                      </select>
                                                      @error('assistance_type')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger">{{ $message }}</span>
                                                      </span>
                                                      @enderror
                                                </div>



                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="rachat_de_vetustes">Rachat de vetustes</label>
                                                      <select class="form-control @error('rachat_de_vetustes') is-invalid @enderror" name="rachat_de_vetustes" id="rachat_de_vetustes">
                                                            <option value="0" {{ old('rachat_de_vetustes',$quoteInfo->rachat_de_vetustes) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('rachat_de_vetustes',$quoteInfo->rachat_de_vetustes) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('rachat_de_vetustes')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="perte_financiere">Perte financiere</label>
                                                      <select class="form-control @error('perte_financiere') is-invalid @enderror" name="perte_financiere" id="perte_financiere">
                                                            <option value="0" {{ old('perte_financiere',$quoteInfo->perte_financiere) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('perte_financiere',$quoteInfo->perte_financiere) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('perte_financiere')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="innondations">Innondations</label>
                                                      <select id="innondations" class="form-control @error('innondations') is-invalid @enderror" name="innondations">
                                                            <option value="0" {{ old('innondations',$quoteInfo->innondations) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('innondations',$quoteInfo->innondations) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('innondations')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>



                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="dommage_collision_deplafonnee">Dommage collision déplafonnée</label>
                                                      <select id="dommage_collision_deplafonnee" class="form-control @error('dommage_collision_deplafonnee') is-invalid @enderror" name="dommage_collision_deplafonnee">
                                                            <option value="0" {{ old('dommage_collision_deplafonnee',$quoteInfo->dommage_collision_deplafonnee) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('dommage_collision_deplafonnee',$quoteInfo->dommage_collision_deplafonnee) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('dommage_collision_deplafonnee')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label" for="protection_des_passagers">Protection des passagers</label>
                                                      <select id="protection_des_passagers" class="form-control @error('protection_des_passagers') is-invalid @enderror" name="protection_des_passagers">
                                                            <option value="0" {{ old('protection_des_passagers',$quoteInfo->protection_des_passagers) == '0' ? 'selected' : '' }}>Non</option>
                                                            <option value="1" {{ old('protection_des_passagers',$quoteInfo->protection_des_passagers) == '1' ? 'selected' : '' }}>Oui</option>

                                                      </select>
                                                      @error('protection_des_passagers')
                                                      <span class="invalid-feedback" role="alert">
                                                            <span class="text-danger"> {{ $message }} </span>
                                                      </span>
                                                      @enderror
                                                </div>
                                                <div class="col-md-6 mb-3" id="protection_des_passagers_formule_container" style="display: none;">
                                                      <label class="form-label" for="protection_des_passagers_formule">Type de formule</label>
                                                      <select id="protection_des_passagers_formule" class="form-control @error('protection_des_passagers_formule') is-invalid @enderror" name="protection_des_passagers_formule">
                                                            <option value="formule 1" {{ old('protection_des_passagers_formule',$quoteInfo->protection_des_passagers_formule) == 'formule 1' ? 'selected' : '' }}>formule 1</option>
                                                            <option value="formule 2" {{ old('protection_des_passagers_formule',$quoteInfo->protection_des_passagers_formule) == 'formule 2' ? 'selected' : '' }}>formule 2</option>
                                                            <option value="formule 3" {{ old('protection_des_passagers_formule',$quoteInfo->protection_des_passagers_formule) == 'formule 3' ? 'selected' : '' }}>formule 3</option>
                                                      </select>
                                                      @error('protection_des_passagers_formule')
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

                              </div>
                        </div> -->
      </div> <!-- end col -->
</div><!--end row-->


</div>
</div>

<script>
      document.addEventListener('DOMContentLoaded', function() {
            function calculateVehicleAge() {
                  const dateMEC = new Date(document.querySelector('input[name="date_MEC"]').value);
                  const currentDate = new Date();

                  if (!isNaN(dateMEC.getTime())) {
                        const timeDifference = currentDate - dateMEC;
                        const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                        const ageInYears = daysDifference / 365.25; // Using 365.25 for more accurate year calculation
                        document.querySelector('input[name="age_du_vehicule_by_years"]').value = ageInYears.toFixed(2); // Format to 2 decimal places
                  } else {
                        document.querySelector('input[name="age_du_vehicule_by_years"]').value = '';
                  }
            }

            document.querySelector('input[name="date_MEC"]').addEventListener('change', calculateVehicleAge);
      });
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
            function calculateProrataDays() {
                  const dateEffetInput = document.querySelector('input[name="date_effet"]');
                  const dateEcheanceInput = document.querySelector('input[name="date_echeance"]');

                  const dateEffet = new Date(dateEffetInput.value);
                  const dateEcheance = new Date(dateEcheanceInput.value);

                  // Check if both dates are valid
                  if (!isNaN(dateEffet.getTime()) && !isNaN(dateEcheance.getTime())) {
                        const timeDifference = dateEcheance - dateEffet; // Difference in milliseconds
                        const prorataDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24)); // Convert to days

                        document.querySelector('input[name="prorata_days"]').value = prorataDays; // Update input with the result
                  } else {
                        document.querySelector('input[name="prorata_days"]').value = ''; // Clear input if dates are invalid
                  }
            }

            // Event listeners for date input changes
            document.querySelector('input[name="date_effet"]').addEventListener('change', calculateProrataDays);
            document.querySelector('input[name="date_echeance"]').addEventListener('change', calculateProrataDays);
      });
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
            function toggleVisibility(selectId, containerId) {
                  const selectElement = document.querySelector(selectId);
                  const containerElement = document.querySelector(containerId);
                  if (selectElement.value === '1') {
                        containerElement.style.display = 'block';
                  } else {
                        containerElement.style.display = 'none';
                  }
            }

            // Initial check on page load
            toggleVisibility('#dommage_collision', '#dommage_collision_value_container');
            toggleVisibility('#tierce', '#tierce_value_container');
            toggleVisibility('#assistance', '#assistance_type_container');
            toggleVisibility('#protection_des_passagers', '#protection_des_passagers_formule_container');

            // Event listeners for change
            document.querySelector('#dommage_collision').addEventListener('change', function() {
                  toggleVisibility('#dommage_collision', '#dommage_collision_value_container');
            });

            document.querySelector('#tierce').addEventListener('change', function() {
                  toggleVisibility('#tierce', '#tierce_value_container');
            });

            document.querySelector('#assistance').addEventListener('change', function() {
                  toggleVisibility('#assistance', '#assistance_type_container');
            });
            document.querySelector('#protection_des_passagers').addEventListener('change', function() {
                  toggleVisibility('#protection_des_passagers', '#protection_des_passagers_formule_container');
            });
      });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const chequesWrapper = document.getElementById('cheques-wrapper');
    const addChequeButton = document.getElementById('add-cheque');
    const chequeQuantityInput = document.getElementById('cheque_quantity');

    // Initialize cheque count from the number of cheques present in the DOM
    let chequeCount = {{ count($quoteInfo->chequesInfos ?? []) }};

    // Function to update cheque quantity input based on the number of cheques
    function updateChequeQuantity() {
        chequeQuantityInput.value = chequeCount;
    }

    // Add Cheque Logic
    addChequeButton.addEventListener('click', function () {
        // Create a new cheque input group
        const chequeGroup = document.createElement('div');
        chequeGroup.classList.add('cheque-group');
        chequeGroup.id = `cheque-${chequeCount}`;

        chequeGroup.innerHTML = `
            <label>Cheque ${chequeCount + 1}</label>
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="cheques[${chequeCount}][cheque_number]" class="form-control" placeholder="Cheque Number">
                </div>
                <div class="col-md-4">
                    <input type="date" name="cheques[${chequeCount}][cheque_date]" class="form-control" placeholder="Cheque Date">
                </div>
                <div class="col-md-4">
                    <!-- Remove Button for Each Cheque -->
                    <button type="button" class="btn btn-danger remove-cheque-btn">Remove</button>
                </div>
            </div>
        `;

        // Append the new cheque group to the wrapper
        chequesWrapper.appendChild(chequeGroup);

        // Increment cheque count and update the cheque_quantity input
        chequeCount++;
        updateChequeQuantity();
    });

    // Remove Cheque Logic
    chequesWrapper.addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('remove-cheque-btn')) {
            const chequeGroup = event.target.closest('.cheque-group');
            if (chequeGroup) {
                chequesWrapper.removeChild(chequeGroup);
                // Decrement cheque count and update the cheque_quantity input
                chequeCount--;
                updateChequeQuantity();
            }
        }
    });

    // Initialize the cheque quantity input on page load
    updateChequeQuantity();
});

</script>


@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection