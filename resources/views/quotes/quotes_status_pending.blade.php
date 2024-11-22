@extends('layouts.master')
@section('title')
@lang('Les devis')
@endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('accueil') }}">Tableau de Bord</a> @endslot
@slot('title') Les Devis @endslot
@endcomponent
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

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
                        <div class="card-header">
                            <h5 class="card-title mb-0">Les Devis</h5>
                        </div>
                        <div class="row g-4 m-2">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('add.quote') }}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Ajouter</a>
                                    <!-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add</button> -->
                                    <!-- <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button> -->
                                </div>
                            </div>

                        </div>
                        <form method="POST" action="{{ route('quote.infos.bulk.status.update') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Quote Number</th>
                                            <th>Current Status</th>
                                            <!-- <th>New Status</th> -->
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($quotes as $index => $quote)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="quote_info_ids[]" value="{{ $quote->id }}">
                                            </td>
                                            <td>{{ $quote->quote_number }}</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success text-uppercase">
                                                    @if ($quote->latestStatus)
                                                    @switch($quote->latestStatus->quote_status)
                                                    @case('pending')
                                                    <a class="text-warning">En attente</a>
                                                    @break
                                                    @case('completed')
                                                    <a class="text-success">Complété</a>
                                                    @break
                                                    @case('processing')
                                                    <a class="text-primary">En cours de traitement</a>
                                                    @break
                                                    @case('cancelled')
                                                    <a class="text-danger">Annulé</a>
                                                    @break
                                                    @default
                                                    <a class="text-muted">Statut inconnu</a>
                                                    @endswitch
                                                    @else
                                                    <a class="text-muted">Pas de statut</a>
                                                    @endif
                                                </span>
                                            </td>
                                            <!-- <form action="{{ route('quote.info.status.update', ['id' => $quote->id, 'status' => '']) }}" method="POST" id="statusForm">
                                                @csrf
                                                @method('PUT')
                                                <td>
                                                    <select name="quote_statuses[{{ $quote->id }}]" required>
                                                        @php
                                                        $latestStatus = $quote->quotes_status->last() ? $quote->quotes_status->last()->quote_status : null;
                                                        @endphp
                                                        <option value="pending" {{ old('order_status', $latestStatus) === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="completed" {{ old('order_status', $latestStatus) === 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="processing" {{ old('order_status', $latestStatus) === 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="cancelled" {{ old('order_status', $latestStatus) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </td>
                                            </form> -->
                                            <td>
                                                {{ $quote->latestStatus->note ?? 'N/A'}}
                                                <!-- <input type="text" name="notes[{{ $quote->id }}]" class="form-control" placeholder="Note"> -->
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 m-2">
                                <div class="col-md-4 mb-3">
                                    <select name="bulk_status" id="bulk_status" class="form-control @error('bulk_status') is-invalid @enderror" required>
                                        <option value="">Select Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="processing">Processing</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                    @error('bulk_status')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <textarea name="bulk_note" class="form-control @error('bulk_note') is-invalid @enderror" placeholder="Enter note for all selected quotes" required></textarea>
                                    @error('bulk_note')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
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