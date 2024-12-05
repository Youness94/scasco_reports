@extends('layouts.master')
@section('title')
@lang('translation.task-details')
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title mb-3 flex-grow-1 text-start">Dernier rendez-vous</h6>
                <div class="mb-2">
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop"
                        colors="primary:#405189,secondary:#02a8b5" style="width:90px;height:90px">
                    </lord-icon>
                </div>
                @php
                $latestAppointment = $potentialCase->appointments()->latest()->first();
                @endphp
                @if($latestAppointment)
                <h3 class="mb-1">{{ \Carbon\Carbon::parse($latestAppointment->date_appointment)->format('d M Y') }}</h3>
                <h5 class="fs-14 mb-4">{{ $latestAppointment->place }}</h5>
                @else
                <h3 class="mb-1">Aucun rendez-vous disponible</h3>
                <h5 class="fs-14 mb-4">N/A</h5>
                @endif
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <form class="mt-4" autocomplete="off" method="POST" action="{{ route('update.status.potential.case', ['id' => $potentialCase->id]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-4 align-items-center">
                        <div class="col-lg-8">
                            <select id="case_status" class="form-control @error('case_status') is-invalid @enderror" name="case_status">
                                @foreach (['pending', 'completed', 'processing', 'cancelled'] as $case_status)
                                @php
                                // Manually define the translation mapping
                                $statusTranslations = [
                                'pending' => 'En attente',
                                'completed' => 'Terminé',
                                'processing' => 'En cours',
                                'cancelled' => 'Annulé',
                                ];
                                $translatedStatus = ucfirst($statusTranslations[$case_status]);
                                @endphp
                                <option value="{{ $case_status }}" {{ old('case_status', $potentialCase->case_status) == $case_status ? 'selected' : '' }}>
                                    {{ $translatedStatus }}
                                </option>
                                @endforeach
                            </select>
                            @error('case_status')
                            <span class="invalid-feedback" role="alert">
                                <span class="text-danger">{{ $message }}</span>
                            </span>
                            @enderror
                        </div>
                        <!--end col-->

                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-success w-100">Modifier</button>
                        </div>
                        <!--end col-->
                    </div>
                </form>
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Numéro d'Affaire</td>
                                <td>{{$potentialCase->case_number}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Client</td>
                                <td>{{$potentialCase->client->client_first_name}} {{$potentialCase->client->client_first_name}}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Statu</td>
                                <td>
                                    @switch($potentialCase->case_status)
                                    @case('pending')
                                    <a class="badge bg-secondary-subtle text-warning">En attente</a>
                                    @break
                                    @case('completed')
                                    <a class="badge bg-secondary-subtle text-success">Complété</a>
                                    @break
                                    @case('cancelled')
                                    <a class="badge bg-secondary-subtle text-danger">Annulé</a>
                                    @break
                                    @default
                                    <a class="badge bg-secondary-subtle text-muted">Pas de statut</a>
                                    @endswitch
                                </td>

                            </tr>
                            <tr>
                                <td class="fw-medium">Date de création</td>
                                <td>{{ \Carbon\Carbon::parse($potentialCase->created_at )->format('F d, Y') ?? 'N/V' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h6 class="card-title mb-0 flex-grow-1">Créateur</h6>

                </div>

                <ul class="list-unstyled vstack gap-3 mb-0">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <!-- <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                    class="avatar-xs rounded-circle shadow"> -->
                                @if(!empty($potentialCase->creator->photo) && file_exists(public_path('photos/admin_images/' . $potentialCase->creator->photo)))
                                <img class="rounded-circle" src="{{ url('photos/admin_images/'.$potentialCase->creator->photo) }}" alt="profile" width="50">

                                @else
                                <img class="rounded-circle" src="{{ url('/photos/image_not_found/imagenotfound.jpg') }}" alt="profile" width="31">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile" class="text-body">{{$potentialCase->creator->first_name}} {{$potentialCase->creator->first_name}}</a></h6>
                                <p class="text-muted mb-0">Nom</p>
                            </div>

                        </div>
                    </li>
                    <!-- <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                    class="avatar-xs rounded-circle shadow">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile" class="text-body">Thomas
                                        Taylor</a></h6>
                                <p class="text-muted mb-0">UI/UX Designer</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown shadow-none"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                    class="avatar-xs rounded-circle shadow">
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile" class="text-body">Nancy
                                        Martino</a></h6>
                                <p class="text-muted mb-0">Web Designer</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-sm fs-16 text-muted dropdown shadow-none"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
        <!--end card-->
    </div>
    <!---end col-->
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">Services et Branches</h6>
                    <!-- <p>It will be as simple as occidental in fact, it will be Occidental. To an English person, it will
                        seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental
                        is. The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in
                        their grammar, their pronunciation and their most common words.</p> -->

                    <div class="row">
                        @foreach($potentialCase->services as $service)
                        <div class="col-12 col-md-4 mb-3">
                            <h6 class="mb-3 fw-semibold text-uppercase">{{ $service->name }}</h6>

                            <ul class="ps-3 list-unstyled vstack gap-2">
                                @if($service->branches->isNotEmpty())
                                @foreach($service->branches as $branch)
                                <li>
                                    <div class="form-check">
                                        <!-- <input class="form-check-input" type="" value="" id="productTask{{ $branch->id }}"> -->
                                        <label class="form-check-label" for="productTask{{ $branch->id }}">
                                            {{ $branch->name }}
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                                @else
                                <p>Aucune branche disponible</p>
                                @endif
                            </ul>
                        </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                Commentaires
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                Les rendez-vous
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                Les comptes rendus
                            </a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        <h5 class="card-title mb-4">Commentaires</h5>

                        <div data-simplebar style="height: 508px;" class="px-3 mx-n3 mb-2">
                            @foreach($potentialCase->caseHistories->sortByDesc('created_at') as $history)
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    @if(!empty($history->user->photo) && file_exists(public_path('photos/admin_images/' . $history->user->photo)))
                                    <img class="rounded-circle" src="{{ url('photos/admin_images/'.$history->user->photo) }}" alt="profile" width="50">
                                    @else
                                    <img class="rounded-circle" src="{{ url('/photos/image_not_found/imagenotfound.jpg') }}" alt="profile" width="31">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13"><a href="pages-profile" class="text-body">{{$history->user->first_name}} {{$history->user->last_name}}</a> <small class="text-muted">{{ $history->created_at->format('d M Y - h:iA') }}</small></h5>
                                    <p class="text-muted">{{$history->comment}}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <form class="mt-4" autocomplete="off" method="POST" action="{{ route('store.comment.potential.case', ['id' => $potentialCase->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Laisser des Commentaires</label>
                                    <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3"
                                        name="comment" placeholder="Entrez des commentaires"></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <!-- <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                            class="ri-attachment-line fs-16"></i></button> -->
                                    <button type="submit" class="btn btn-success">Poster un Commentaire</button>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <h6 class="card-title mb-4 pb-2">Les rendez-vous</h6>
                        <div class="table-responsive table-card">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Client</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Lieu de rendez-vous</th>
                                        <th scope="col">Date de rendez-vous</th>
                                        <th scope="col">Date de création</th>
                                        <th scope="col">créé par</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($potentialCase->appointments as $appointment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0 text-body">{{$appointment->client->client_first_name}} {{$appointment->client->client_last_name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$appointment->client->client_phone}}</td>
                                        <td>{{$appointment->place}}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_appointment)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->created_at)->format('d M Y - h:iA') }}</td>
                                        <td>{{$appointment->creator->first_name}}</td>
                                        <!-- <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="btn btn-light btn-icon"
                                                    id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    <i class="ri-equalizer-fill"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuLink1"
                                                    data-popper-placement="bottom-end"
                                                    style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="profile-1" role="tabpanel">
                        <h6 class="card-title mb-4 pb-2">Les comptes rendus</h6>
                        <div class="table-responsive table-card">
                            <table class="table align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">#ID</th>
                                        <th scope="col">Date de création</th>
                                        <th scope="col">Les Rendez-Vous</th>
                                        <th scope="col">Némuro d'affaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($potentialCase->reports as $report)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-2">
                                                    {{$report->id}}
                                                </div>
                                            </div>
                                        </th>
                                        <td>{{ \Carbon\Carbon::parse($report->date_report)->format('d M Y - h:iA') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($report->appointment->date_appointment)->format('d M Y') }} {{ $report->appointment->place }}</td>
                                        <td>{{ $report->potential_case->case_number }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun rapport disponible pour cette affaire.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--edn tab-pane-->

                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->


@endsection
@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection