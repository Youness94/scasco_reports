
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Modifier Compte Rendu'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.clients')); ?>">Les Positions</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Modifier Compte Rendu <?php $__env->endSlot(); ?>
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
            <form method="POST" action="<?php echo e(route('update.report', ['id' => $report->id])); ?>" class="forms-sample" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
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
                                                            <select id="potencial_case_id" class="form-control <?php $__errorArgs = ['potencial_case_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="potencial_case_id">
                                                                  <?php $__currentLoopData = $potential_cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $potential_case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($potential_case->id); ?>"
                                                                        <?php echo e(old('potencial_case_id', $report->potencial_case_id) == $potential_case->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($potential_case->case_number); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['potencial_case_id'];
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
                                                      <!-- Appointment -->
                                                      <div class="col-md-4 mb-3">
                                                            <label class="form-label" for="appointment_id">Rendez-vous</label>
                                                            <select id="appointment_id" class="js-example-basic-single form-control <?php $__errorArgs = ['appointment_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="appointment_id">
                                                                  <option selected disabled value="">Choisissez un rendez-vous</option>
                                                                  <!-- Options will be populated by AJAX -->
                                                                  <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                  <option value="<?php echo e($appointment->id); ?>"
                                                                        <?php echo e(old('appointment_id', $report->appointment_id) == $appointment->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($appointment->date_appointment); ?> - <?php echo e($appointment->place); ?>

                                                                  </option>
                                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['appointment_id'];
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
                                                      <!-- Description -->
                                                      <div class="col-md-8 mb-3">

                                                            <label class="form-label" for="contenu">Description</label>
                                                            <textarea type="text" class="form-control <?php $__errorArgs = ['contenu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="contenu"><?php echo e(old('contenu', $report->contenu)); ?></textarea>
                                                            <?php $__errorArgs = ['potencial_case_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <span class="invalid-feedback" role="alert">
                                                                  <span class="text-danger"> <?php echo e($message); ?> </span>
                                                            </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
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
                              var oldAppointmentId = '<?php echo e(old("appointment_id", $report->appointment_id)); ?>';
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\scasco_reports\resources\views/reports/edit_report.blade.php ENDPATH**/ ?>