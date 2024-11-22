<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city_id' => 'sometimes|exists:cities,id',
            'payment_method_id' => 'sometimes|exists:payment_methods,id',
            'address_line' => 'sometimes|string',

            'valeur_neuf' => 'sometimes|numeric|between:0,999999.99',
            'valeur_venale' => 'sometimes|numeric|between:0,999999.99',
            'puissance_fiscale' => 'sometimes|numeric|between:0,999999.99',
            'energie' => 'sometimes|in:ESSENCE,DIESEL',
            'valeur_glaces' => 'sometimes|numeric|between:0,999999.99',
            'valeur_retroviseurs' => 'sometimes|numeric|between:0,999999.99',
            'CRM' => 'sometimes|numeric',
            'date_effet' => 'sometimes|date',
            'date_echeance' => 'sometimes|date|after:date_effet',
            'prorata_days' => 'sometimes|numeric',
            'date_MEC' => 'sometimes|date',
            'age_du_vehicule_by_years' => 'sometimes|numeric|between:0,99.99',
            'vol' => 'sometimes|boolean',
            'bris_de_glace' => 'sometimes|boolean',
            'tierce' => 'sometimes|boolean',
            'tierce_value' => 'sometimes|numeric|between:0,1',
            'dommage_collision_deplafonnee' => 'sometimes|boolean',
            'dommage_collision' => 'sometimes|boolean',
            'dommage_collision_value' => 'sometimes|numeric',
            'innondations' => 'sometimes|boolean',
            'rachat_de_vetustes' => 'sometimes|boolean',
            'perte_financiere' => 'sometimes|boolean',
            'protection_des_passagers' => 'sometimes|boolean',
            'protection_des_passagers_formule' => 'sometimes|in:formule 1,formule 2,formule 3',
            'assistance' => 'sometimes|boolean',
            'assistance_type' => 'sometimes|in:basique,economique,standard,elargie,gold,vip',
            'date_creation' => 'sometimes|date',
            'created_by' => 'sometimes|exists:users,id',

            // quotes validation rules
            'responsabilite_civile' => 'sometimes|numeric',
            'responsabilite_civile_tax' => 'sometimes|numeric',
            'defense_et_recours' => 'sometimes|numeric',
            'defense_et_recours_tax' => 'sometimes|numeric',
            'incendie' => 'sometimes|numeric',
            'incendie_tax' => 'sometimes|numeric',
            'vol' => 'sometimes|numeric',
            'vol_tax' => 'sometimes|numeric',
            'bris_de_glace' => 'sometimes|numeric',
            'bris_de_glace_tax' => 'sometimes|numeric',
            'tierce' => 'sometimes|numeric',
            'tierce_tax' => 'sometimes|numeric',
            'dommages_collision_deplafonnee' => 'sometimes|numeric',
            'dommages_collision_deplafonnee_tax' => 'sometimes|numeric',
            'dommages_collision_moins_15_ans' => 'sometimes|numeric',
            'dommages_collision_moins_15_ans_tax' => 'sometimes|numeric',
            'innondations' => 'sometimes|numeric',
            'innondations_tax' => 'sometimes|numeric',
            'rachat_de_vetuste' => 'sometimes|numeric',
            'rachat_de_vetuste_tax' => 'sometimes|numeric',
            'perte_financiere' => 'sometimes|numeric',
            'perte_financiere_tax' => 'sometimes|numeric',
            'protection_des_passagers' => 'sometimes|numeric',
            'protection_des_passagers_tax' => 'sometimes|numeric',
            'assistance' => 'sometimes|numeric',
            'assistance_tax' => 'sometimes|numeric',
            'evenements_catastrophiques' => 'sometimes|numeric',
            'evenements_catastrophiques_tax' => 'sometimes|numeric',
            'prime_ht' => 'sometimes|numeric',
            'prime_ht_tax' => 'sometimes|numeric',
            'timbres' => 'sometimes|numeric',
            'taxe_parafiscale' => 'sometimes|numeric',
            'prime_totale_annuelle' => 'sometimes|numeric',
            'prorata' => 'sometimes|numeric',

            // client_quotes validation rules
            'responsabilite_civile' => 'boolean',
            'responsabilite_civile_tax' => 'boolean',
            'defense_et_recours' => 'boolean',
            'defense_et_recours_tax' => 'boolean',
            'incendie' => 'boolean',
            'incendie_tax' => 'boolean',
            'vol' => 'boolean',
            'vol_tax' => 'boolean',
            'bris_de_glace' => 'boolean',
            'bris_de_glace_tax' => 'boolean',
            'tierce' => 'boolean',
            'tierce_tax' => 'boolean',
            'dommages_collision_deplafonnee' => 'boolean',
            'dommages_collision_deplafonnee_tax' => 'boolean',
            'dommages_collision_moins_15_ans' => 'boolean',
            'dommages_collision_moins_15_ans_tax' => 'boolean',
            'innondations' => 'boolean',
            'innondations_tax' => 'boolean',
            'rachat_de_vetuste' => 'boolean',
            'rachat_de_vetuste_tax' => 'boolean',
            'perte_financiere' => 'boolean',
            'perte_financiere_tax' => 'boolean',
            'protection_des_passagers' => 'boolean',
            'protection_des_passagers_tax' => 'boolean',
            'assistance' => 'boolean',
            'assistance_tax' => 'boolean',
            'evenements_catastrophiques' => 'boolean',
            'evenements_catastrophiques_tax' => 'boolean',
            'prime_ht' => 'boolean',
            'prime_ht_tax' => 'boolean',
            'timbres' => 'boolean',
            'taxe_parafiscale' => 'boolean',
            'prime_totale_annuelle' => 'sometimes|numeric',
            'prorata' => 'sometimes|numeric',

            'quote_info_id' => 'sometimes|exists:quote_infos,id',
        ];
    }
}
