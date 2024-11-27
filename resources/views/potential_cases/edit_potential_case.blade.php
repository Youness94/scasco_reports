@extends('layouts.master')
@section('title')
@lang('Modifier Affaire')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.potential_cases') }}">Les Affaires</a> @endslot
@slot('title') Modifier Affaire @endslot
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
            <form method="POST" action="{{ route('update.potential_case', ['id' => $potentialCase->id]) }}" class="forms-sample" enctype="multipart/form-data">

                  @csrf
                  <div class="row">
                        <div class="col-md-12">
                              <div class="card">
                                    <div class="card-header">Modifier l'Affaire</div>
                                    <div class="card-body d-flex flex-column">
                                          <div class="live-preview flex-grow-1">
                                                <div class="row">
                                                      <!-- Select Client -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="client_id">Ville</label>
                                                            <select id="client_id" class="form-control @error('client_id') is-invalid @enderror" name="client_id">
                                                                  @foreach ($clients as $client)
                                                                  <option value="{{ $client->id }}" {{ old('client_id', $potentialCase->client_id) == $client->id ? 'selected' : '' }}>
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

                                                      <!-- Select Services -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="services">Sélectionner les Services</label>
                                                            <select id="services" name="services[]" class="form-control @error('services') is-invalid @enderror" multiple>
                                                                  @foreach ($services as $service)
                                                                  <option value="{{ $service->id }}"
                                                                        {{ in_array($service->id, old('services', $potentialCase->services->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                        {{ $service->name }}
                                                                  </option>
                                                                  @endforeach
                                                            </select>
                                                            @error('services')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger">{{ $message }}</span>
                                                            </span>
                                                            @enderror
                                                      </div>

                                                      <!-- Branches -->
                                                      <div id="branches-container" class="col-md-4 mb-3">
                                                            @foreach ($services as $service)
                                                            @if($potentialCase->services->contains('id', $service->id))
                                                            <div class="service-branches" data-service-id="{{ $service->id }}">
                                                                  <label class="form-label">Branches pour {{ $service->name }}</label>
                                                                  <select name="branches[{{ $service->id }}][]" class="form-control branches-select" multiple>
                                                                        @foreach ($service->branches as $branch)
                                                                        <option value="{{ $branch->id }}"
                                                                              @if($potentialCase->services->where('id', $service->id)->first())
                                                                              {{ in_array($branch->id, json_decode($potentialCase->services->where('id', $service->id)->first()->pivot->branch_ids, true) ?? []) ? 'selected' : '' }}
                                                                              @endif>
                                                                              {{ $branch->name }}
                                                                        </option>
                                                                        @endforeach
                                                                  </select>
                                                            </div>
                                                            @endif
                                                            @endforeach
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
            var branchesContainer = $('#branches-container');


            $('#services').on('change', function() {
                  var selectedServiceIds = $(this).val();

                  // remove deselected
                  branchesContainer.find('.service-branches').each(function() {
                        var serviceId = $(this).data('service-id').toString();
                        if (!selectedServiceIds.includes(serviceId)) {
                              removeBranchesFromService(serviceId);
                              $(this).remove();
                        }
                  });

                  // new selected services 
                  selectedServiceIds.forEach(function(serviceId) {
                        if (branchesContainer.find(`.service-branches[data-service-id=${serviceId}]`).length === 0) {
                              addBranchesForService(serviceId);
                        }
                  });
            });

            // add branches for a selected service
            function addBranchesForService(serviceId) {
                  $.ajax({
                        url: '{{ route('editBranchesByService') }}',
                        method: 'GET',
                        data: {
                              service_id: serviceId
                        },
                        success: function(response) {
                              var branches = response.branches;
                              var serviceBranchesHtml = `
                    <div class="service-branches" data-service-id="${serviceId}">
                        <label class="form-label">Branches pour ${response.service_name}</label>
                        <select name="branches[${serviceId}][]" class="form-control" multiple>
                            ${branches.map(branch => `<option value="${branch.id}">${branch.name}</option>`).join('')}
                        </select>
                    </div>
                `;
                              branchesContainer.append(serviceBranchesHtml);
                        }
                  });
            }

            // remove branches for a deselected service
            function removeBranchesFromService(serviceId) {
                  $.ajax({
                        url: '{{ route('removeBranchesFromService') }}',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                              if (response.success) {
                                    console.log(`Branches for service ID ${serviceId} removed successfully.`);
                              }
                        }
                  });
            }

            // update branches for a selected service
            branchesContainer.on('change', 'select', function() {
                  var serviceId = $(this).closest('.service-branches').data('service-id');
                  var selectedBranchIds = $(this).val();

                  $.ajax({
                        url: '{{ route('updateBranchesForService') }}',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              branch_ids: selectedBranchIds,
                              _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                              if (response.success) {
                                    console.log(`Branches for service ID ${serviceId} updated successfully.`);
                              }
                        }
                  });
            });
      });
</script>
<script>
      $(document).ready(function() {
            // ==========
            $('#services').select2({
                  placeholder: "Sélectionner les Services",
                  width: '100%',
                  templateSelection: formatState,
                  templateResult: formatState,
                  closeOnSelect: false
            });

            // =================
            $('.branches-select').select2({
                  placeholder: "Sélectionner les Branches",
                  width: '100%',
                  templateSelection: formatState,
                  templateResult: formatState,
                  closeOnSelect: false
            });

            function formatState(opt) {
                  if (!opt.id) {
                        return opt.text;
                  }

                  var optimage = $(opt.element).data('image');
                  if (!optimage) {
                        return opt.text;
                  } else {
                        var $opt = $(
                              '<span><input type="checkbox" /> ' + opt.text + '</span>'
                        );
                        return $opt;
                  }
            }
      });
</script>
@endsection