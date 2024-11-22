
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('Détails de la devis'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> <a href="<?php echo e(route('all.quotes')); ?>">Devis</a> <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>
Détails de la devis
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="<?php echo e(URL::to('img/logo.png')); ?>" alt="" height="45">
                                <div class="mt-sm-5 mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                    <p class="text-muted mb-1" id="address-details">Etage 3, 261,bd Abdelmoumen Appt.9 Imm A, Casablanca</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Code postal:</span> 20100</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                <!-- <h6><span class="text-muted fw-normal">Legal
                                        Registration No:</span>
                                    <span id="legal-register-no">987654</span>
                                </h6> -->
                                <!-- <h6><span class="text-muted fw-normal">Email:</span>
                                    <span id="email">velzon@themesbrand.com</span>
                                </h6> -->
                                <h6><span class="text-muted fw-normal">Site web:</span> <a href="https://scascoassurances.com/" class="link-primary" target="_blank" id="website">www.scascoassurances.com</a></h6>
                                <h6 class="mb-0"><span class="text-muted fw-normal">Numéro de Contact: </span><span id="contact-no"> +212 6 61 35 68 84 <br> +212 6 66 96 96 23 <br> +212 6 61 32 73 67</span></h6>
                            </div>
                        </div>
                    </div>
                    <!--end card-header-->
                </div>
                <!--end col-->
                <!-- <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed">
                        <div class="row g-3">
                            <div class="col-6  text-end">
                                <h6 class="text-muted text-uppercase fw-semibold">Client</h6>
                                <p class="fw-medium mb-2" id="billing-name"></p>

                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed ">
                        <div class="row g-3">
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Numéro de devis</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-no"> <?php echo e($quote->quote_number); ?></span></h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date"><?php echo e($quote->created_at->format('Y-m-d')); ?></span> <small class="text-muted" id="invoice-time"><?php echo e($quote->created_at->format('h:iA')); ?></small></h5>
                            </div>
                            <!--end col-->
                            <!-- <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Devis</p>
                                <span class="text-success"></span>
                            </div> -->

                            <!--end col-->
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Montant Total</p>
                                <h5 class="fs-14 mb-0"><span id="total-amount" class="text-success"><?php echo e($quote->quotes->first()->prime_totale_annuelle); ?> </span>DH</h5>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->

                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                <thead>
                                    <tr class="table-active">
                                        <!-- <th scope="col" class="text-center"></th> -->
                                        <th scope="col" class="text-center">Garanties</th>
                                        <th scope="col" class="text-center">Capital</th>
                                        <th scope="col" class="text-center">Garantie Assurée</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr>
                                        <!-- <th scope="row">01</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Responsabilité civile</span>
                                            <p class="text-muted mb-0"></p>
                                        </td>

                                        <td class="text-end">minimum prévu par l'article 123 de la loi 17-99</td>
                                        <td class="text-center">Oui</td>
                                    </tr>
                                    <tr>
                                        <!-- <th scope="row">02</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Dommage au véhicule</span>
                                        </td>
                                        <td><?php echo e($quote->valeur_neuf ?? '---'); ?></td>
                                        <td class="text-center">Oui</td>
                                    </tr>
                                    <tr>
                                        <!-- <th scope="row">02</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Incendie</span>
                                        </td>
                                        <td><?php echo e($quote->valeur_neuf ?? '---'); ?></td>
                                        <td class="text-center">Oui</td>
                                    </tr>
                                    <tr>
                                        <!-- <th scope="row">02</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Vol</span>
                                        </td>
                                        <td><?php echo e($quote->valeur_neuf ?? '---'); ?></td>

                                        <?php if(  $quote->vol == '1'): ?>
                                        <td class="text-center">Oui</td>
                                        <?php else: ?>
                                        <td class="text-center">Non</td>
                                        <?php endif; ?>

                                    </tr>

                                    <tr>
                                        <!-- <th scope="row">04</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Bris de glâce</span>
                                        </td>
                                        <td><?php echo e($quote->valeur_glaces ?? '---'); ?></td>
                                        <?php if(  $quote->bris_de_glace == '1'): ?>
                                        <td class="text-center">Oui</td>
                                        <?php else: ?>
                                        <td class="text-center">Non</td>
                                        <?php endif; ?>
                                    </tr>

                                    
                                    
                                    <tr>
                                        <!-- <th scope="row">04</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Dommages collision &lt;15 ans</span>
                                        </td>
                                        <td><?php echo e($quote->dommage_collision_value ?? '---'); ?></td>
                                        <?php if(  $quote->dommage_collision == '1'): ?>
                                        <td class="text-center">Oui</td>
                                        <?php else: ?>
                                        <td class="text-center">Non</td>
                                        <?php endif; ?>
                                    </tr>


                                    <tr>
                                        <!-- <th scope="row">04</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Rachat de vétusté</span>
                                        </td>
                                        <td><?php echo e($quote->valeur_neuf ?? '---'); ?></td>
                                        <?php if(  $quote->rachat_de_vetustes == '1'): ?>
                                        <td class="text-center">Oui</td>
                                        <?php else: ?>
                                        <td class="text-center">Non</td>
                                        <?php endif; ?>
                                    </tr>

                               

                                    <tr>
                                        <!-- <th scope="row">04</th> -->
                                        <td class="text-start">
                                            <span class="fw-medium">Assistance</span>
                                        </td>
                                        <td><?php echo e($quote->toit_panoramique ?? '---'); ?></td>
                                        <?php if(  $quote->bris_toit_panoramique == '1'): ?>
                                        <td class="text-center">Oui</td>
                                        <?php else: ?>
                                        <td class="text-center">Non</td>
                                        <?php endif; ?>
                                    </tr>

                                    



                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                     
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>

                                <tr>
                                        <td>Timbres</td>
                                        <td class="text-end"><?php echo e($quote->quotes->first()->timbres ?? 0); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Taxe parafiscale</td>
                                        <td class="text-end"><?php echo e($quote->quotes->first()->taxe_parafiscale ?? 0); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Prime Totale annuelle <small class="text-muted"></small></td>
                                        <td class="text-end"><?php echo e($quote->quotes->first()->prime_totale_annuelle ?? 0); ?> </td>
                                    </tr>
                                    <tr>
                                        <td>Prorata</td>
                                        <td class="text-end"><?php echo e($quote->quotes->first()->prorata ?? 0); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end table-->

                            </table>
                            <!--end table-->
                        </div>

                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Imprimer</a>
                            <!-- <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a> -->
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/invoicedetails.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YOUNESS-DEVL\Desktop\material\resources\views/quotes/quote_details_client.blade.php ENDPATH**/ ?>