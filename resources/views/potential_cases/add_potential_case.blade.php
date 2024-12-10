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
                                        <div class=" mt-3">
                                            <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                                id="create-btn" data-bs-target="#showModal"><i
                                                    class="ri-add-line align-bottom me-1"></i> Ajouter Client</button>
                                        </div>

                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="branches">Branches</label>
                                        <select id="branches" name="branches[]" class="form-control" multiple>
                                            @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ in_array($branch->id, old('branches', [])) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dynamic Branch CA Inputs -->
                                    <div id="branch-ca-inputs" class="col-md-4 mb-3">
                                        <!-- Dynamically generated branch_ca inputs will go here -->
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
        <!-- Add Client Modal -->

        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form class="tablelist-form" autocomplete="off" method="POST" action="{{ route('store.client.potential.case') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div>
                                <label class="form-label" for="client_type">Type de client</label>
                                <select id="client_type" class="form-control @error('client_type') is-invalid @enderror" name="client_type">
                                    <option value="Particulier" {{ old('client_type') == 'Particulier' ? 'selected' : '' }}>Particulier</option>
                                    <option value="Entreprise" {{ old('client_type') == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                                </select>
                                @error('client_type')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="client_first_name">Prénom du Client</label>
                                <input type="text" class="form-control @error('client_first_name') is-invalid @enderror" name="client_first_name" value="{{ old('client_first_name') }}">
                                @error('client_first_name')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="client_last_name">Nom du Client</label>
                                <input type="text" class="form-control @error('client_last_name') is-invalid @enderror" name="client_last_name" value="{{ old('client_last_name') }}">
                                @error('client_last_name')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="city_id">Ville</label>
                                <select id="city_id" class="js-example-basic-single form-control @error('city_id') is-invalid @enderror" name="city_id">
                                    <option selected disabled value="">Choisissez une ville</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger">{{ $message }}</span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="client_address">Adresse du Client</label>
                                <input type="text" class="form-control @error('client_address') is-invalid @enderror" name="client_address" value="{{ old('client_address') }}">
                                @error('client_address')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="client_phone">Téléphone du Client</label>
                                <input type="text" class="form-control @error('client_phone') is-invalid @enderror" name="client_phone" value="{{ old('client_phone') }}">
                                @error('client_phone')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="client_email">E-mail du Client</label>
                                <input type="email" class="form-control @error('client_email') is-invalid @enderror" name="client_email" value="{{ old('client_email') }}">
                                @error('client_email')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="raison_sociale">Raison Sociale du Client</label>
                                <input type="text" class="form-control @error('raison_sociale') is-invalid @enderror" name="raison_sociale" value="{{ old('raison_sociale') }}">
                                @error('raison_sociale')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="RC">RC du Client</label>
                                <input type="text" class="form-control @error('RC') is-invalid @enderror" name="RC" value="{{ old('RC') }}">
                                @error('RC')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="ICE">ICE du Client</label>
                                <input type="text" class="form-control @error('ICE') is-invalid @enderror" name="ICE" value="{{ old('ICE') }}">
                                @error('ICE')
                                <span class="invalid-feedback" role="alert">
                                    <span class="text-danger"> {{ $message }} </span>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-success" id="add-btn">Ajouter Client</button>
                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
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
        <!--end modal -->
    </div> <!-- end col -->
</div><!--end row-->


</div>
</div>



@endsection
@section('script')
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Bootstrap JS (necessary for modal functionality) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize select2 for the branches dropdown
        $('#branches').select2({
            placeholder: "Select branches",
            closeOnSelect: false,
            templateResult: formatState,
            templateSelection: formatState
        });

        // Format the display of each option in select2
        function formatState(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var optimage = $(opt.element).data('image');
            var branchName = opt.text;
            if (!optimage) {
                return branchName;
            } else {
                var $opt = $('<span>' + branchName + '</span>');
                return $opt;
            }
        }

        // Store previously entered branch CA values
        var previousBranchCA = @json(old('branch_ca', []));

        // Function to save the current branch CA values for previously selected branches
        function saveBranchCAValues() {
            var branchInputs = $('#branch-ca-inputs .form-control');
            branchInputs.each(function() {
                var branchId = $(this).attr('id').replace('branch_ca_', ''); // Extract branch ID from input ID
                var branchCAValue = $(this).val(); // Get the current branch CA value
                if (branchId) {
                    previousBranchCA[branchId] = branchCAValue; // Store the value in the object
                }
            });
        }

        // Event listener for changes in the branches dropdown
        $('#branches').on('change', function() {
            var selectedBranches = $(this).val(); // Get the selected branch IDs
            var branchInputs = $('#branch-ca-inputs'); // Container for branch CA input fields

            // Iterate over selected branches and generate input fields
            selectedBranches.forEach(function(branchId) {
                // If the input for this branch doesn't already exist, create it
                if ($('#branch_ca_' + branchId).length === 0) {
                    var branchName = $('#branches option[value="' + branchId + '"]').text(); // Get branch name
                    var branchCAValue = previousBranchCA[branchId] || ''; // Retrieve previous CA value, if exists

                    var inputHtml = `
                    <div class="mb-3" id="branch_input_${branchId}">
                        <label for="branch_ca_${branchId}" class="form-label">${branchName} Branch CA</label>
                        <input type="number" class="form-control" name="branch_ca[${branchId}]" id="branch_ca_${branchId}" placeholder="Enter CA for ${branchName}" value="${branchCAValue}" required step="0.01" min="0">
                    </div>
                    `;
                    branchInputs.append(inputHtml); // Append the input for this branch
                }
            });

            // Save the current branch CA values for future reference
            saveBranchCAValues();
        });

        // Initial population of inputs for already selected branches (if any)
        var initialBranches = $('#branches').val();
        if (initialBranches) {
            var initialBranchInputs = $('#branch-ca-inputs');
            initialBranchInputs.empty(); // Empty the container before re-appending
            initialBranches.forEach(function(branchId) {
                if ($('#branch_ca_' + branchId).length === 0) { // Avoid duplicating the inputs
                    var branchName = $('#branches option[value="' + branchId + '"]').text();
                    var branchCAValue = previousBranchCA[branchId] || ''; // Get previous CA value if available
                    var inputHtml = `
                    <div class="mb-3" id="branch_input_${branchId}">
                        <label for="branch_ca_${branchId}" class="form-label">${branchName} Branch CA</label>
                        <input type="number" class="form-control" name="branch_ca[${branchId}]" id="branch_ca_${branchId}" placeholder="Enter CA for ${branchName}" value="${branchCAValue}" required step="0.01" min="0">
                    </div>
                    `;
                    initialBranchInputs.append(inputHtml); // Append the input field for this branch
                }
            });

            // Save the current branch CA values for initial population
            saveBranchCAValues();
        }
    });
</script>

<script>
    $(document).ready(function() {
        // Handle Add Client Modal submission
        $('form.tablelist-form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('store.client.potential.case') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        // Add the new client to the dropdown
                        var newOption = new Option(response.client_name, response.client_id, true, true);
                        $('#client_id').append(newOption).trigger('change');

                        // Close the modal
                        $('#showModal').modal('hide');

                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred while adding the client.');
                }
            });
        });
    });
</script>
@endsection