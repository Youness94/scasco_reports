
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.task-details'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                <?php
                $latestAppointment = $potentialCase->appointments()->latest()->first();
                ?>
                <?php if($latestAppointment): ?>
                <h3 class="mb-1"><?php echo e(\Carbon\Carbon::parse($latestAppointment->date_appointment)->format('d M Y')); ?></h3>
                <h5 class="fs-14 mb-4"><?php echo e($latestAppointment->place); ?></h5>
                <?php else: ?>
                <h3 class="mb-1">No appointment available</h3>
                <h5 class="fs-14 mb-4">N/A</h5>
                <?php endif; ?>
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <form class="mt-4">
                    <div class="mb-4">
                        <select id="appointment_status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status">
                            <!-- <option value="">Select Task board</option> -->
                            <?php $__currentLoopData = ['pending', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e(old('status', $potentialCase->status) == $status ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst($status)); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <span class="text-danger"><?php echo e($message); ?></span>
                        </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>
                </form>
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Numéro d'Affaire</td>
                                <td><?php echo e($potentialCase->case_number); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Client</td>
                                <td><?php echo e($potentialCase->client->client_first_name); ?> <?php echo e($potentialCase->client->client_first_name); ?></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Statu</td>
                                <td>
                                    <?php switch($potentialCase->case_status):
                                    case ('pending'): ?>
                                    <a class="badge bg-secondary-subtle text-warning">En attente</a>
                                    <?php break; ?>
                                    <?php case ('completed'): ?>
                                    <a class="badge bg-secondary-subtle text-success">Complété</a>
                                    <?php break; ?>
                                    <?php case ('cancelled'): ?>
                                    <a class="badge bg-secondary-subtle text-danger">Annulé</a>
                                    <?php break; ?>
                                    <?php default: ?>
                                    <a class="badge bg-secondary-subtle text-muted">Pas de statut</a>
                                    <?php endswitch; ?>
                                </td>

                            </tr>
                            <tr>
                                <td class="fw-medium">Date de création</td>
                                <td><?php echo e(\Carbon\Carbon::parse($potentialCase->created_at )->format('F d, Y') ?? 'N/V'); ?></td>
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
                                <!-- <img src="<?php echo e(URL::asset('build/images/users/avatar-8.jpg')); ?>" alt=""
                                    class="avatar-xs rounded-circle shadow"> -->
                                <?php if(!empty($potentialCase->creator->photo) && file_exists(public_path('photos/admin_images/' . $potentialCase->creator->photo))): ?>
                                <img class="rounded-circle" src="<?php echo e(url('photos/admin_images/'.$potentialCase->creator->photo)); ?>" alt="profile" width="50">

                                <?php else: ?>
                                <img class="rounded-circle" src="<?php echo e(url('/photos/image_not_found/imagenotfound.jpg')); ?>" alt="profile" width="31">
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-1"><a href="pages-profile" class="text-body"><?php echo e($potentialCase->creator->first_name); ?> <?php echo e($potentialCase->creator->first_name); ?></a></h6>
                                <p class="text-muted mb-0">Nom</p>
                            </div>

                        </div>
                    </li>
                    <!-- <li>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="<?php echo e(URL::asset('build/images/users/avatar-8.jpg')); ?>" alt=""
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
                                <img src="<?php echo e(URL::asset('build/images/users/avatar-2.jpg')); ?>" alt=""
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
                        <?php $__currentLoopData = $potentialCase->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-md-4 mb-3">
                            <h6 class="mb-3 fw-semibold text-uppercase"><?php echo e($service->name); ?></h6>

                            <ul class="ps-3 list-unstyled vstack gap-2">
                                <?php if($service->branches->isNotEmpty()): ?>
                                <?php $__currentLoopData = $service->branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="form-check">
                                        <!-- <input class="form-check-input" type="" value="" id="productTask<?php echo e($branch->id); ?>"> -->
                                        <label class="form-check-label" for="productTask<?php echo e($branch->id); ?>">
                                            <?php echo e($branch->name); ?>

                                        </label>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <p>No branches available</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $potentialCase->caseHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <?php if(!empty($history->user->photo) && file_exists(public_path('photos/admin_images/' . $history->user->photo))): ?>
                                    <img class="rounded-circle" src="<?php echo e(url('photos/admin_images/'.$history->user->photo)); ?>" alt="profile" width="50">
                                    <?php else: ?>
                                    <img class="rounded-circle" src="<?php echo e(url('/photos/image_not_found/imagenotfound.jpg')); ?>" alt="profile" width="31">
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13"><a href="pages-profile" class="text-body"><?php echo e($history->user->frist_name); ?> <?php echo e($history->user->last_name); ?></a> <small class="text-muted"><?php echo e($history->created_at->format('d M Y - h:iA')); ?></small></h5>
                                    <p class="text-muted"><?php echo e($history->comment); ?></p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <form class="mt-4">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Laisser des Commentaires</label>
                                    <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Entrez des commentaires"></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i
                                            class="ri-attachment-line fs-16"></i></button>
                                    <a href="javascript:void(0);" class="btn btn-success">Poster un Commentaire</a>
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
                                    <?php $__currentLoopData = $potentialCase->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-3 flex-grow-1">
                                                    <h6 class="fs-15 mb-0 text-body"><?php echo e($appointment->client->client_first_name); ?> <?php echo e($appointment->client->client_last_name); ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo e($appointment->client->client_phone); ?></td>
                                        <td><?php echo e($appointment->place); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($appointment->date_appointment)->format('d M Y')); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($appointment->created_at)->format('d M Y - h:iA')); ?></td>
                                        <td><?php echo e($appointment->creator->first_name); ?></td>
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                    <?php $__empty_1 = true; $__currentLoopData = $potentialCase->reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-2">
                                                    <?php echo e($report->id); ?>

                                                </div>
                                            </div>
                                        </th>
                                        <td><?php echo e(\Carbon\Carbon::parse($report->date_report)->format('d M Y - h:iA')); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($report->appointment->date_appointment)->format('d M Y')); ?> <?php echo e($report->appointment->place); ?></td>
                                        <td><?php echo e($report->potential_case->case_number); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun rapport disponible pour cette affaire.</td>
                                    </tr>
                                    <?php endif; ?>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/potential_cases/potential_case_details.blade.php ENDPATH**/ ?>