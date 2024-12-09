@extends('layouts.master')

@section('title')
@lang('Les rendez-Vous')
@endsection

@section('css')
<!-- Datatable CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!-- Datatable responsive CSS -->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css" rel="stylesheet" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('accueil') }}">Tableau de Bord</a> @endslot
@slot('title') Les Rendez-Vous @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card card-h-100">
                    <div class="card-body">

                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                            id="create-btn" data-bs-target="#showModal"><i
                                class="ri-add-line align-bottom me-1"></i> Ajouter Rendez-Vous</button>

                    </div>
                </div>

            </div> <!-- end col-->

            <div class="col-xl-9">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!--end row-->

        <div style='clear:both'></div>

        <!-- Add Client Modal -->

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form class="tablelist-form" autocomplete="off" method="POST" action="{{ route('store.appointment') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="potencial_case_id">Némuro D'Affaire</label>
                                <select id="potencial_case_id" class="js-example-basic-single form-control @error('potencial_case_id') is-invalid @enderror" name="potencial_case_id">
                                    <option selected disabled value="">Choisissez une affaire</option>
                                    @foreach ($potential_cases as $potential_case)
                                    <option value="{{ $potential_case->id }}" {{ old('potencial_case_id') == $potential_case->id ? 'selected' : '' }}>
                                        {{ $potential_case->case_number }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('potencial_case_id')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="client_id">Client</label>
                                <input type="text" class="form-control @error('client_id') is-invalid @enderror" name="client_id" id="client_id" value="{{ old('client_id') }}" readonly>
                                @error('client_id')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="place">Lieu de rendez-vous</label>
                                <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ old('place') }}">
                                @error('place')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="date_appointment">Lieu de rendez-vous</label>
                                <input type="date" class="form-control @error('date_appointment') is-invalid @enderror" name="date_appointment" value="{{ old('date_appointment') }}">
                                @error('date_appointment')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>



                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Ajouter</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you Sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Record ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div> @endsection


@section('script')
<!-- FullCalendar 4+ JS -->
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
<script src="{{ URL::asset('build/libs/fullcalendar/index.global.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS (necessary for modal functionality) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Get appointments data from PHP
    var appointments = JSON.parse('{!! $appointments !!}'); 

    // Initialize FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: appointments,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        droppable: true,
        editable: true,

        // Use eventContent to customize how events are displayed
        eventContent: function(arg) {
            // Access client and place info from event data
            var clientInfo = arg.event.extendedProps.client;
            var placeInfo = arg.event.extendedProps.place;

            // Return the HTML for event display
            return {
                html: arg.event.title + '<br>' + 'Client : ' + clientInfo + '<br>' + 'Lieu : ' + placeInfo
            };
        }
    });

    // Render the calendar
    calendar.render();
});
</script>
<script>
    $(document).ready(function() {
        $('#potencial_case_id').change(function() {
            var potencial_case_id = $(this).val();
            if (potencial_case_id) {
                $.ajax({
                    url: '/get-client-by-case/' + potencial_case_id,
                    method: 'GET',
                    success: function(response) {
                        if (response.client_id) {

                            var firstName = response.client_first_name ? response.client_first_name : '';
                            var lastName = response.client_last_name ? response.client_last_name : '';

                            var fullName = firstName + (firstName && lastName ? ' ' : '') + lastName;

                            $('#client_id').val(fullName);
                        } else {
                            $('#client_id').val('');
                        }
                    },
                    error: function() {
                        alert('Client information could not be fetched.');
                    }
                });
            } else {
                $('#client_id').val('');
            }
        });
    });
</script>
@endsection