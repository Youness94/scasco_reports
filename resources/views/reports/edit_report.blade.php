@extends('layouts.master')
@section('title')
@lang('Modifier Compte Rendu')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.clients') }}">Les Positions</a> @endslot
@slot('title') Modifier Compte Rendu @endslot
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
            <form method="POST" action="{{ route('update.report', ['id' => $report->id]) }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Compte Rendu</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">

                                                      <!-- Potential Case -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="potencial_case_id">Numéro d'affaire</label>
                                                            <select id="potencial_case_id" class="form-control @error('potencial_case_id') is-invalid @enderror" name="potencial_case_id">
                                                                  @foreach ($potential_cases as $potential_case)
                                                                  <option value="{{ $potential_case->id }}"
                                                                        {{ old('potencial_case_id', $report->potencial_case_id) == $potential_case->id ? 'selected' : '' }}>
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
                                                      <!-- Appointment -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="appointment_id">Rendez-vous</label>
                                                            <select id="appointment_id" class="js-example-basic-single form-control @error('appointment_id') is-invalid @enderror" name="appointment_id">
                                                                  <option selected disabled value="">Choisissez un rendez-vous</option>
                                                                  <!-- Options will be populated by AJAX -->
                                                                  @foreach ($appointments as $appointment)
                                                                  <option value="{{ $appointment->id }}"
                                                                        {{ old('appointment_id', $report->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                                                        {{ $appointment->date_appointment }} - {{ $appointment->place }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('appointment_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>
                                                      <!-- Description -->
                                                      <div class="col-md-8 mb-3">

                                                            <label class="form-label" for="contenu">Description</label>
                                                            <textarea type="text" class="form-control @error('contenu') is-invalid @enderror" name="contenu">{{ old('contenu', $report->contenu) }}</textarea>
                                                            @error('potencial_case_id')
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript">
      // When the user changes the potential case, load the corresponding appointments
      $('#potencial_case_id').change(function() {
            var potencialCaseId = $(this).val();

            if (potencialCaseId) {
                  $.ajax({
                        url: '/get-appointments-by-case/' + potencialCaseId, // URL to fetch appointments
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                              // Clear the current options in the appointment dropdown
                              $('#appointment_id').empty();
                              // Add a default "Choose an appointment" option
                              $('#appointment_id').append('<option selected disabled value="">Choisissez un rendez-vous</option>');

                              // Populate the appointment dropdown with the available options
                              $.each(data, function(key, appointment) {
                                    $('#appointment_id').append('<option value="' + appointment.id + '">' + appointment.date_appointment + ' - ' + appointment.place + '</option>');
                              });

                              // Preselect the previously selected appointment, if it exists
                              var oldAppointmentId = '{{ old("appointment_id", $report->appointment_id) }}';
                              if (oldAppointmentId) {
                                    $('#appointment_id').val(oldAppointmentId); // Set the selected appointment
                              }
                        },
                        error: function(xhr, status, error) {
                              console.error("Error fetching appointments: " + error);
                        }
                  });
            } else {
                  // If no potential case is selected, reset the appointment dropdown
                  $('#appointment_id').empty().append('<option selected disabled value="">Choisissez un rendez-vous</option>');
            }
      });

      // Initialize the appointment dropdown with the preselected appointment (if any)
      $(document).ready(function() {
            var potencialCaseId = $('#potencial_case_id').val(); // Get the selected potential case ID
            if (potencialCaseId) {
                  // Trigger change event to populate appointments on page load
                  $('#potencial_case_id').trigger('change');
            } else {
                  // Ensure the default option is selected when no potential case is selected
                  $('#appointment_id').val('');
            }
      });
</script>
@endsection