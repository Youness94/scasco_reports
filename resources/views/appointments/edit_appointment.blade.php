@extends('layouts.master')
@section('title')
@lang('Modifier rendez-Vous')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.clients') }}">Les Rendez-Vous</a> @endslot
@slot('title') Modifier Rendez-Vous @endslot
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
            <form method="POST" action="{{ route('update.appointment', ['id' => $appointment->id]) }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Rendez-Vous</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Affaire -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="potencial_case_id">Némuro D'Affaire</label>
                                                            <select id="potencial_case_id" class="form-control @error('potencial_case_id') is-invalid @enderror" name="potencial_case_id">

                                                                  @foreach ($potential_cases as $potential_case)
                                                                  <option value="{{ $potential_case->id }}" {{ old('potencial_case_id',$appointment->potential_case->potencial_case_id) == $potential_case->id ? 'selected' : '' }}>
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

                                                      <!-- Client -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_id">Client</label>
                                                            <input type="text" class="form-control @error('client_id') is-invalid @enderror" name="client_id" id="client_id" value="{{ $appointment->potential_case->client->client_first_name }} {{ $appointment->potential_case->client->client_first_name }}" readonly>
                                                            @error('client_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Lieu de rendez-vous -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="place">Lieu de rendez-vous</label>
                                                            <input type="text" class="form-control @error('place') is-invalid @enderror" name="place" value="{{ $appointment->place }}">
                                                            @error('place')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- date -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="date_appointment">Date de rendez-vous</label>
                                                            <input type="date" class="form-control @error('date_appointment') is-invalid @enderror" name="date_appointment" value="{{ old('date_appointment', \Carbon\Carbon::parse($appointment->date_appointment)->format('Y-m-d')) }}">
                                                            @error('date_appointment')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Status -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="status">Statut</label>
                                                            <select id="appointment_status" class="form-control @error('status') is-invalid @enderror" name="status">
                                                                  @foreach (['pending', 'completed', 'cancelled'] as $status)
                                                                  <option value="{{ $status }}" {{ old('status', $appointment->status) == $status ? 'selected' : '' }}>
                                                                        {{ ucfirst($status) }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('status')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
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
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

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