
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Créer affaire'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.potential_cases')); ?>">Les Affaires</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Créer Affaire <?php $__env->endSlot(); ?>
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
            <form method="POST" action="<?php echo e(route('store.potential_case')); ?>" class="forms-sample" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
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
                                                            <select id="client_id" class="js-example-basic-single form-control <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="client_id">
                                                                  <option selected disabled value="">Choisissez une ville</option>
                                                                  <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($client->id); ?>" <?php echo e(old('client_id') == $client->id ? 'selected' : ''); ?>>
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

                                                      <!-- Service -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="services">Select Services</label>
                                                            <select id="services" name="services[]" class="form-control" multiple>
                                                                  <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                      </div>
                                                       <!-- Branche -->
                                                      <div id="branches-container" class="col-md-4 mb-3"></div>
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
     
        $('#services').select2({
            placeholder: "Select Services",
            closeOnSelect: false,
            templateResult: formatState,
            templateSelection: formatState
        });

        function formatState (opt) {
            if (!opt.id) {
                return opt.text;
            }
            var optimage = $(opt.element).data('image');
            if(!optimage){
                return opt.text;
            } else {
                var $opt = $(
                    '<span><input type="checkbox" /> ' + opt.text + '</span>'
                );
                return $opt;
            }
        };

        // service selection
        $('#services').on('change', function() {
            var serviceIds = $(this).val();

            $.ajax({
                url: "<?php echo e(route('getBranchesByService')); ?>",
                method: 'GET',
                data: {
                    service_ids: serviceIds
                },
                success: function(response) {
                    $('#branches-container').empty();

                    if (response.length) {
                        response.forEach(function(service) {
                            var html = `
                                <div class="mb-3">
                                    <label class="form-label">Branches pour ${service.name}</label>
                                    <select name="branches[${service.id}][]" class="form-control branches-select" multiple>
                            `;
                            service.branches.forEach(function(branch) {
                                html += `<option value="${branch.id}">${branch.name}</option>`;
                            });
                            html += `
                                    </select>
                                </div>
                            `;
                            $('#branches-container').append(html);
                        });

                        // 
                        $('.branches-select').select2({
                            placeholder: "Select Branches",
                            closeOnSelect: false,
                            templateResult: formatState,
                            templateSelection: formatState
                        });
                    } else {
                        $('#branches-container').append('<p>No branches available for selected services.</p>');
                    }
                },
                error: function() {
                    alert('Error loading branches');
                }
            });
        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/potential_cases/add_potential_case.blade.php ENDPATH**/ ?>