@extends('layouts.master')
@section('title')
@lang('Créer Compte rendu')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.clients') }}">Les Comptes rendus</a> @endslot
@slot('title') Créer Compte rendu @endslot
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
            <form method="POST" action="{{ route('store.report') }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Compte rendu</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Potencial Case -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="potencial_case_id">Numéro d'affaire</label>
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

                                                      <!-- Appointment -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="appointment_id">Rendez-vous</label>
                                                            <select id="appointment_id" class="js-example-basic-single form-control @error('appointment_id') is-invalid @enderror" name="appointment_id">
                                                                  <option selected disabled value="">Choisissez un rendez-vous</option>
                                                                  <!-- Options will be populated by AJAX -->
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
                                                            <textarea type="text" class="form-control @error('contenu') is-invalid @enderror" name="contenu" value="{{ old('contenu') }}"></textarea>
                                                            @error('contenu')
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

                  <!-- Submit Button -->
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript">
  
    $('#potencial_case_id').change(function() {
        var potencialCaseId = $(this).val(); 
        
        if(potencialCaseId) {
            $.ajax({
                url: '/get-appointments-by-case/' + potencialCaseId, 
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                   
                    $('#appointment_id').empty();

                   
                    $('#appointment_id').append('<option selected disabled value="">Choisissez un rendez-vous</option>');
                    
                   
                    $.each(data, function(key, appointment) {
                        $('#appointment_id').append('<option value="'+appointment.id+'">'+appointment.date_appointment+' - '+appointment.place+'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching appointments: " + error);
                }
            });
        } else {
           
            $('#appointment_id').empty().append('<option selected disabled value="">Choisissez un rendez-vous</option>');
        }
    });
</script>
@endsection