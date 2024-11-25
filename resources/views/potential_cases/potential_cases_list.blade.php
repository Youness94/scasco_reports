@extends('layouts.master')
@section('title')
@lang('Les affaires')
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
@slot('title') Les Affaires @endslot
@endcomponent

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header mb-3 mb-lg-4 mt-3">
            <!-- <div class="row align-items-center">
                <div class="col-xl-8 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <h3 class="page-title">Liste des Associés</h3>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex flex-column justify-content-center">
                    <ul class="breadcrumb ml-auto">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Liste Associés</li>
                    </ul>
                </div>
            </div> -->
        </div>

        <div class="row mt-3">



            {{-- message --}}
            {!! Toastr::message() !!}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <h5 class="card-title mb-0">Les Affaires</h5>
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <a href="{{ route('add.potential_case') }}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajouter</a> <!-- Remove padding from button -->
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Numéro d'Affaire</th>
                                        <th>Client</th>
                                        <th>Statu</th>
                                        <th>Services</th>
                                        <th>Branches</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_potential_cases as $all_potential_case)
                                    <tr>
                                        <td>{{ $all_potential_case->case_number ?? N/V }}</td>
                                        <td>{{ $all_potential_case->clients->client_first_name ?? N/V}}</td>
                                        <td>{{ $all_potential_case->case_status ?? N/V }}</td>
                                        <!-- Display Services -->
                                        <td>
                                            @foreach($all_potential_case->services as $service)
                                            {{ $service->name ?? 'N/V' }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>

                                        <!-- Display Branches -->
                                        <td>
                                            @foreach(json_decode($all_potential_case->pivot->branch_ids) as $branchId)
                                            @php
                                            $branch = App\Models\Branch::find($branchId);
                                            @endphp
                                            {{ $branch->name ?? 'N/V' }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="{{route('edit.client',$client->id)}}" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Modifier</a></li>
                                                    <li><a href="{{route('display.potential_case',$potential_case->id)}}" class="dropdown-item edit-item-btn"><i class="ri-eye-line align-bottom me-2 text-muted"></i> Affaicher</a></li>
                                                    <li><a href="{{route('delete.potential_case',$potential_case->id)}}" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-2-fill align-bottom me-2 text-muted"></i> Supprimer</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>




    @endsection
    @section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    @endsection