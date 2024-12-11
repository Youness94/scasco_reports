@extends('layouts.master')
@section('title')
@lang('Créer objectif')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.objectives') }}">Les Objectifs</a> @endslot
@slot('title') Créer Objectifs @endslot
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
            <form method="POST" action="{{ route('store.objective') }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Objectif</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="year_objective">Objectif</label>
                                                            <input type="number" class="form-control @error('year_objective') is-invalid @enderror" name="year_objective" value="{{ old('year_objective') }}">
                                                            @error('year_objective')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="commercial_id">Chargé d'affaire</label>
                                                            <select name="commercial_id" id="commercial_id" class="form-control">
                                                                  @foreach($users as $user)
                                                                  <option value="{{ $user->id }}" {{ old('commercial_id') == $user->id ? 'selected' : '' }}>
                                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('commercial_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="year">L'année d'objectif</label>
                                                            <input type="text" name="year" value="{{ date('Y') }}" class="form-control" readonly>
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
                                          <div class="flex-grow-1"></div>
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