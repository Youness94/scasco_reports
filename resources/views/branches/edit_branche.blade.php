@extends('layouts.master')
@section('title')
@lang('Modifier branche')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.branches') }}">Les Positions</a> @endslot
@slot('title') Modifier Brnache @endslot
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
            <form method="POST" action="{{ route('update.branche', ['id' => $branche->id]) }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Branche</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">

                                                      <div class="col-md-6 mb-3">

                                                            <label class="form-label" for="name">Nom du Branche</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $branche->name }}">
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                      <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="service_id">Service</label>
                                                            <select id="service_id" class="form-control @error('service_id') is-invalid @enderror" name="service_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  @foreach ($services as $service)
                                                                  <option value="{{ $service->id }}" {{ old('service_id',$branche->service_id) == $service->id ? 'selected' : '' }}>
                                                                        {{ $service->name }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('service_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                      <div class="col-md-8 mb-3">
                                                            <label class="form-label" for="description">Description</label>
                                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $branche->description) }}</textarea>
                                                            @error('description')
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