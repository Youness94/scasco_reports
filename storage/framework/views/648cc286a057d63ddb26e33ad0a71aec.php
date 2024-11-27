
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier Affaire'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.potential_cases')); ?>">Les Affaires</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Affaire <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>


<?php echo Toastr::message(); ?>


<div class="page-wrapper">
      <div class="content container-fluid">

            <div class="page-header mb-3 mb-lg-4 mt-3">

            </div>

            <!-- <div class="row"> -->

            <!-- <div class="col-xxl-12"> -->
            <!-- <div class="card">
                              <div class="card-body d-flex flex-column">-->
            <!-- <div class="live-preview flex-grow-1"> -->
            <form method="POST" action="<?php echo e(route('update.potential_case', ['id' => $potentialCase->id])); ?>" class="forms-sample" enctype="multipart/form-data">

                  <?php echo csrf_field(); ?>
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
                                                            <select id="client_id" class="form-control <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_id">
                                                                  <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($client->id); ?>" <?php echo e(old('client_id', $potentialCase->client_id) == $client->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($client->client_first_name); ?> <?php echo e($client->client_last_name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['client_id'];
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

                                                      <!-- Select Services -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="services">Sélectionner les Services</label>
                                                            <select id="services" name="services[]" class="form-control <?php $__errorArgs = ['services'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" multiple>
                                                                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($service->id); ?>"
                                                                        <?php echo e(in_array($service->id, old('services', $potentialCase->services->pluck('id')->toArray())) ? 'selected' : ''); ?>>
                                                                        <?php echo e($service->name); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['services'];
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

                                                      <!-- Branches -->
                                                      <div id="branches-container" class="col-md-4 mb-3">
                                                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($potentialCase->services->contains('id', $service->id)): ?>
                                                            <div class="service-branches" data-service-id="<?php echo e($service->id); ?>">
                                                                  <label class="form-label">Branches pour <?php echo e($service->name); ?></label>
                                                                  <select name="branches[<?php echo e($service->id); ?>][]" class="form-control branches-select" multiple>
                                                                        <?php $__currentLoopData = $service->branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($branch->id); ?>"
                                                                              <?php if($potentialCase->services->where('id', $service->id)->first()): ?>
                                                                              <?php echo e(in_array($branch->id, json_decode($potentialCase->services->where('id', $service->id)->first()->pivot->branch_ids, true) ?? []) ? 'selected' : ''); ?>

                                                                              <?php endif; ?>>
                                                                              <?php echo e($branch->name); ?>

                                                                        </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  </select>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
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
                        url: '<?php echo e(route('editBranchesByService')); ?>',
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
                        url: '<?php echo e(route('removeBranchesFromService')); ?>',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              _token: '<?php echo e(csrf_token()); ?>'
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
                        url: '<?php echo e(route('updateBranchesForService')); ?>',
                        method: 'POST',
                        data: {
                              service_id: serviceId,
                              branch_ids: selectedBranchIds,
                              _token: '<?php echo e(csrf_token()); ?>'
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/potential_cases/edit_potential_case.blade.php ENDPATH**/ ?>