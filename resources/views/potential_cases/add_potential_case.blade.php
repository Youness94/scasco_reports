@extends('layouts.master')
@section('title')
@lang('Créer affaire')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.potential_cases') }}">Les Affaires</a> @endslot
@slot('title') Créer Affaire @endslot
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
            <form method="POST" action="{{ route('store.potential_case') }}" class="forms-sample" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Affaire</div>

                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">


                                                      <!-- First Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_first_name">Prénom du Client</label>
                                                            <input type="text" class="form-control @error('client_first_name') is-invalid @enderror" name="client_first_name" value="{{ old('client_first_name') }}">
                                                            @error('client_first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Last Name -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_last_name">Nom du Client</label>
                                                            <input type="text" class="form-control @error('client_last_name') is-invalid @enderror" name="client_last_name" value="{{ old('client_last_name') }}">
                                                            @error('client_last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> {{ $message }} </span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Client -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_id">Client</label>
                                                            <select id="client_id" class="js-example-basic-single form-control @error('client_id') is-invalid @enderror" name="client_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  @foreach ($clients as $client)
                                                                  <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                                                        {{ $client->client_first_name }} {{ $client->client_last_name }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('client_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Service -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_id">Services</label>
                                                            <select name="services[]" id="services" class="form-control" multiple required>
                                                                  <option value="">Sélectionnez les Services</option>
                                                                  @foreach($services as $service)
                                                                  <option value="{{ $service->id }}" {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}>{{ $service->name }}</option>
                                                                  @endforeach
                                                            </select>
                                                            @error('client_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Branche -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="branches">Sélectionnez les Services</label>
                                                            <select name="branches[]" id="branches" class="form-control" multiple>
                                                                  <!-- Branches will be populated here via AJAX -->
                                                            </select>
                                                          
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

<script>
    // Event listener for Service Selection
    $('#services').change(function() {
        var serviceIds = $(this).val(); // Get the selected service IDs

        if (serviceIds.length) {
            $.ajax({
                url: "{{ route('getBranchesByService') }}", // Update with the correct route
                method: 'GET',
                data: { service_ids: serviceIds },
                success: function(response) {
                    var branchSelect = $('#branches');
                    branchSelect.empty(); // Clear the current branches

                    if (response.length) {
                        // Append the new branch options to the dropdown
                        response.forEach(function(branch) {
                            branchSelect.append('<option value="' + branch.id + '">' + branch.name + '</option>');
                        });
                    } else {
                        branchSelect.append('<option value="">No branches available</option>');
                    }
                },
                error: function() {
                    alert('Error loading branches');
                }
            });
        } else {
            $('#branches').empty(); // Clear branch dropdown if no service is selected
        }
    });
</script>
@endsection