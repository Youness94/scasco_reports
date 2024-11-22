@extends('layouts.master')
@section('title')
@lang('Détails de la devis')
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('all.quotes') }}">Devis</a> @endslot
@slot('title')
Détails de la devis
@endslot
@endcomponent

<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="{{ URL::to('img/logo.png') }}" alt="" height="45">
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
                                <p class="fw-medium mb-2" id="billing-name">{{ $quote->user->first_name ?? '---'}}</p>

                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="card-body p-4 border-top border-top-dashed ">
                        <div class="row g-3">
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Numéro de devis</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-no">{{$quote->quote_number}}</span></h5>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                <h5 class="fs-14 mb-0"><span id="invoice-date">{{ $quote->created_at->format('Y-m-d') }}</span> <small class="text-muted" id="invoice-time">{{ $quote->created_at->format('h:iA') }}</small></h5>
                            </div>
                            <!--end col-->
                            <!-- <div class="col-lg-3 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Devis</p>
                                <span class="text-success">MATU</span>
                            </div> -->

                            <!--end col-->
                            <div class="col-lg-4 col-6">
                                <p class="text-muted mb-2 text-uppercase fw-semibold">Montant Total</p>
                                <h5 class="fs-14 mb-0"><span id="total-amount" class="text-success">{{ optional($quote->quotes->first())->prime_totale_annuelle ?? 0 }} </span>DH</h5>
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
                                        <th scope="col" class="text-center" ></th>
                                        <th class="text-start" scope="col">Prime Nette</th>
                                        <th class="text-start" scope="col">Taxe</th>
                                        <th class="text-center" scope="col">Prime</th>
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-start">Responsabilité civile</h6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->responsabilite_civile ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->responsabilite_civile_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{ optional($quote->quotes->first())->responsabilite_civile + optional($quote->quotes->first())->responsabilite_civile_tax }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">
                                            <h6 class="mb-0 text-start">Défense et recours</h6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->defense_et_recours ?? 0 }}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->defense_et_recours_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{ optional($quote->quotes->first())->defense_et_recours + optional($quote->quotes->first())->defense_et_recours_tax }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">
                                            <h6 class="mb-0 text-start">Incendie</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->incendie ?? 0 }} </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->incendie_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{( optional($quote->quotes->first())->incendie ?? 0) + (optional($quote->quotes->first())->incendie_tax ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">
                                            <h6 class="mb-0 text-start">Vol</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->vol ?? 0 }}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->vol_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->vol ?? 0) + (optional($quote->quotes->first())->vol_tax ?? 0 ) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">
                                            <h6 class="mb-0 text-start">Bris de glâce</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->bris_de_glace ?? 0 }}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->bris_de_glace_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->bris_de_glace ?? 0) + (optional($quote->quotes->first())->bris_de_glace_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Tierce</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->tierce ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->tierce_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{( optional($quote->quotes->first())->tierce ?? 0) + (optional($quote->quotes->first())->tierce_tax ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Dommages collision déplafonnée</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->dommages_collision_deplafonnee ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->dommages_collision_deplafonnee_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{( optional($quote->quotes->first())->dommages_collision_deplafonnee ?? 0) + (optional($quote->quotes->first())->dommages_collision_deplafonnee_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Dommages collision &lt;15 ans</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->dommages_collision_moins_15_ans ?? 0 }}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->dommages_collision_moins_15_ans_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->dommages_collision_moins_15_ans ?? 0) + (optional($quote->quotes->first())->dommages_collision_moins_15_ans_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Innondations</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->innondations ?? 0 }}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->innondations_tax ?? 0 }}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->innondations ?? 0) + (optional($quote->quotes->first())->innondations_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Rachat de vétusté</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->rachat_de_vetuste ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->rachat_de_vetuste_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->rachat_de_vetuste ?? 0) + (optional($quote->quotes->first())->rachat_de_vetuste_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Perte Financière</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->perte_financiere ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->perte_financiere_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->perte_financiere ?? 0) + (optional($quote->quotes->first())->perte_financiere_tax ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start"> Protection des passagers</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->responsabilite_civile ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->responsabilite_civile_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{( optional($quote->quotes->first())->responsabilite_civile ?? 0 )+ (optional($quote->quotes->first())->responsabilite_civile_tax ?? 0) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Assistance</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->protection_des_passagers ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->protection_des_passagers_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{ (optional($quote->quotes->first())->protection_des_passagers ?? 0) + ( optional($quote->quotes->first())->protection_des_passagers_tax ?? 0)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="category">

                                            <h6 class="mb-0 text-start">Evénements catastrophiques</6>
                                        </td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->evenements_catastrophiques ?? 0}}</td>
                                        <td class="text-start">{{ optional($quote->quotes->first())->evenements_catastrophiques_tax ?? 0}}</td>
                                        <td class="text-start">
                                            {{( optional($quote->quotes->first())->evenements_catastrophiques ?? 0) + (optional($quote->quotes->first())->evenements_catastrophiques_tax ?? 0 )}}
                                        </td>
                                    </tr>
                                    <!-- <tr class="summary">
                                        <td class="category">

                                            <h4 class="mb-0 text-start fs-14 my-1 fw-normal text-info">Prime HT</h4>
                                        </td>
                                        <td class="text-start fs-14 my-1 fw-normal text-info">{{ optional($quote->quotes->first())->prime_ht ?? 0}}</td>
                                        <td class="text-start fs-14 my-1 fw-normal text-info">{{ optional($quote->quotes->first())->prime_ht_tax ?? 0}}</td>
                                        <td class="text-start fs-14 my-1 fw-normal text-info">
                                            {{ (optional($quote->quotes->first())->prime_ht ?? 0) + (optional($quote->quotes->first())->prime_ht_tax ?? 0) }}
                                        </td>
                                    </tr> -->




                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <div class=" card-body border-top border-top-dashed mt-2">
                            <div class="table-borderless text-center table-nowrap align-middle mb-0">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div>
                                                        <h5 class="fs-14 my-1 text-info"><a href="apps-ecommerce-product-details" class="text-reset">
                                                                {{ optional($quote->quotes->first())->prime_ht ?? 0}}
                                                            </a></h5>
                                                        <span class="text-muted">Prime HT</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal text-info">{{ optional($quote->quotes->first())->prime_ht_tax ?? 0}}</h5>
                                                <span class="text-muted">Taxe</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal text-info"> {{ (optional($quote->quotes->first())->prime_ht ?? 0) + (optional($quote->quotes->first())->prime_ht_tax ?? 0) }}</h5>
                                                <span class="text-muted">Taxe P.F</span>
                                            </td>



                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>

                                    <tr>
                                        <td>Timbres</td>
                                        <td class="text-end">{{ optional($quote->quotes->first())->timbres ?? 0}}</td>
                                    </tr>
                                    <tr>
                                        <td>Taxe parafiscale</td>
                                        <td class="text-end">{{ optional($quote->quotes->first())->taxe_parafiscale ?? 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>Prime Totale annuelle <small class="text-muted"></small></td>
                                        <td class="text-end">{{ optional($quote->quotes->first())->prime_totale_annuelle ?? 0 }} </td>
                                    </tr>
                                    <tr>
                                        <td>Prorata</td>
                                        <td class="text-end">{{ optional($quote->quotes->first())->prorata ?? 0 }}</td>
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
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/invoicedetails.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection