@extends('layouts.master')
@section('title')
@lang('Ajouter des permissions aux rôles')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.roles') }}">Liste des Roles</a> @endslot
@slot('title') Ajouter des permissions aux rôles @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">

       
    
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                <div class="card-header">
                        <h5 class="card-title mb-0">Ajouter des permissions aux rôles</h5>
                    </div>
                    <div class="row g-4 m-2">
                        <div class="col-sm-auto">
                            <div>

                                <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button> -->
                                <!-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
                            </div>
                        </div>

                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="live-preview flex-grow-1">
                            <form method="POST" action="{{ route('give.permission.to.role', ['id' => $role->id]) }}" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-2 mb-3">
                                        <label class="form-check">
                                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} class="form-check-input" />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Soumettre</button>
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