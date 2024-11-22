@extends('layouts.master')
@section('title')
@lang('Modifier Role')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.permissions') }}">Liste des Permissions</a> @endslot
@slot('title') Modifier Permission @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header mb-3 mb-lg-4 mt-3">
                  <!-- <div class="row align-items-center">
                        <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <h3 class="page-title">Modifier Permission</h3>
                        </div>
                        <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                              <ul class="breadcrumb ml-auto">
                                    <li class="breadcrumb-item"><a href="{{ route('all.permissions') }}">Liste des Permissions</a></li>
                                    <li class="breadcrumb-item active">Modifier Permission</li>
                              </ul>
                        </div>
                  </div> -->
            </div>

            <div class="row">
                  <div class="col-xxl-12">
                        <div class="card">
                              <div class="card-body d-flex flex-column">
                                    <div class="live-preview flex-grow-1">
                                          <form method="POST" action="{{ route('update.permission', ['id' => $permission->id]) }}" class="forms-sample" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                      <div class="col-12 col-sm-4 mb-3">
                                                            <label>Role : <span class="login-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ $permission->name }}">
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
            </div> <!-- end col -->
      </div><!--end row-->


</div>
</div>




@endsection


<!-- 
<div class="row">
      <div class="col-12 col-sm-4 mb-3"> -->