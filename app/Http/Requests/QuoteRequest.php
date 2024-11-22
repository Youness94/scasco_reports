<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            // quote_infos validation rules
            'city_id' => 'required|exists:cities,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'address_line' => 'required|string',
            'cheque_quantity' => 'nullable|numeric',
            
            'valeur_neuf' => 'required|numeric|between:0,999999.99',
            'valeur_venale' => 'required|numeric|between:0,999999.99',
            'puissance_fiscale' => 'required|numeric|between:0,999999.99',
            'energie' => 'required|in:ESSENCE,DIESEL',
            'valeur_glaces' => 'required|numeric|between:0,999999.99',
            'valeur_retroviseurs' => 'nullable|numeric|between:0,999999.99',
            'CRM' => 'nullable|numeric',
            'date_effet' => 'required|date',
            'date_echeance' => 'required|date|after:date_effet',
            'prorata_days' => 'nullable|numeric',
            'date_MEC' => 'required|date',
            'age_du_vehicule_by_years' => 'required|numeric|between:0,99.99',
            'vol' => 'nullable|boolean',
            'bris_de_glace' => 'nullable|boolean',
            'tierce' => 'nullable|boolean',
            'tierce_value' => 'nullable|numeric|between:0,1',
            'dommage_collision_deplafonnee' => 'nullable|boolean',
            'dommage_collision' => 'nullable|boolean',
            'dommage_collision_value' => 'nullable|numeric',
            'innondations' => 'nullable|boolean',
            'rachat_de_vetustes' => 'nullable|boolean',
            'perte_financiere' => 'nullable|boolean',
            'protection_des_passagers' => 'nullable|boolean',
            'protection_des_passagers_formule' => 'nullable|in:formule 1,formule 2,formule 3',
            'assistance' => 'required|boolean',
            'assistance_type' => 'nullable|in:basique,economique,standard,elargie,gold,vip',
            'date_creation' => 'nullable|date',
            'created_by' => 'nullable|exists:users,id',

            // quotes validation rules
            'responsabilite_civile' => 'nullable|numeric',
            'responsabilite_civile_tax' => 'nullable|numeric',
            'defense_et_recours' => 'nullable|numeric',
            'defense_et_recours_tax' => 'nullable|numeric',
            'incendie' => 'nullable|numeric',
            'incendie_tax' => 'nullable|numeric',
            'vol' => 'nullable|numeric',
            'vol_tax' => 'nullable|numeric',
            'bris_de_glace' => 'nullable|numeric',
            'bris_de_glace_tax' => 'nullable|numeric',
            'tierce' => 'nullable|numeric',
            'tierce_tax' => 'nullable|numeric',
            'dommages_collision_deplafonnee' => 'nullable|numeric',
            'dommages_collision_deplafonnee_tax' => 'nullable|numeric',
            'dommages_collision_moins_15_ans' => 'nullable|numeric',
            'dommages_collision_moins_15_ans_tax' => 'nullable|numeric',
            'innondations' => 'nullable|numeric',
            'innondations_tax' => 'nullable|numeric',
            'rachat_de_vetuste' => 'nullable|numeric',
            'rachat_de_vetuste_tax' => 'nullable|numeric',
            'perte_financiere' => 'nullable|numeric',
            'perte_financiere_tax' => 'nullable|numeric',
            'protection_des_passagers' => 'nullable|numeric',
            'protection_des_passagers_tax' => 'nullable|numeric',
            'assistance' => 'nullable|numeric',
            'assistance_tax' => 'nullable|numeric',
            'evenements_catastrophiques' => 'nullable|numeric',
            'evenements_catastrophiques_tax' => 'nullable|numeric',
            'prime_ht' => 'nullable|numeric',
            'prime_ht_tax' => 'nullable|numeric',
            'timbres' => 'nullable|numeric',
            'taxe_parafiscale' => 'nullable|numeric',
            'prime_totale_annuelle' => 'nullable|numeric',
            'prorata' => 'nullable|numeric',

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
            'prime_totale_annuelle' => 'nullable|numeric',
            'prorata' => 'nullable|numeric',

            'quote_info_id' => 'nullable|exists:quote_infos,id',
        ];
    }

    public function messages()
    {
        return [
            // quote_infos validation messages
            'valeur_neuf.required' => 'La valeur neuf est requise.',
            'valeur_neuf.numeric' => 'La valeur neuf doit être un nombre.',
            'valeur_neuf.between' => 'La valeur neuf doit être comprise entre 0 et 999999.99.',

            'valeur_venale.required' => 'La valeur vénale est requise.',
            'valeur_venale.numeric' => 'La valeur vénale doit être un nombre.',
            'valeur_venale.between' => 'La valeur vénale doit être comprise entre 0 et 999999.99.',

            'puissance_fiscale.required' => 'La puissance fiscale est requise.',
            'puissance_fiscale.numeric' => 'La puissance fiscale doit être un nombre.',
            'puissance_fiscale.between' => 'La puissance fiscale doit être comprise entre 0 et 999999.99.',

            'energie.required' => 'L\'énergie est requise.',
            'energie.in' => 'L\'énergie doit être soit ESSENCE soit DIESEL.',

            'valeur_glaces.required' => 'La valeur des glaces est requise.',
            'valeur_glaces.numeric' => 'La valeur des glaces doit être un nombre.',
            'valeur_glaces.between' => 'La valeur des glaces doit être comprise entre 0 et 999999.99.',

            'valeur_retroviseurs.required' => 'La valeur des rétroviseurs est requise.',
            'valeur_retroviseurs.numeric' => 'La valeur des rétroviseurs doit être un nombre.',
            'valeur_retroviseurs.between' => 'La valeur des rétroviseurs doit être comprise entre 0 et 999999.99.',

            'CRM.required' => 'Le CRM est requis.',
            'CRM.numeric' => 'Le CRM doit être un nombre.',

            'date_effet.required' => 'La date d\'effet est requise.',
            'date_effet.date' => 'La date d\'effet doit être une date valide.',

            'date_echeance.required' => 'La date d\'échéance est requise.',
            'date_echeance.date' => 'La date d\'échéance doit être une date valide.',
            'date_echeance.after' => 'La date d\'échéance doit être après la date d\'effet.',

            'prorata.required' => 'Le prorata est requis.',
            'prorata.integer' => 'Le prorata doit être un entier.',
            'prorata.min' => 'Le prorata doit être supérieur ou égal à 0.',

            'date_MEC.required' => 'La date MEC est requise.',
            'date_MEC.date' => 'La date MEC doit être une date valide.',

            'age_du_vehicule_by_years.required' => 'L\'âge du véhicule en années est requis.',
            'age_du_vehicule_by_years.numeric' => 'L\'âge du véhicule en années doit être un nombre.',
            'age_du_vehicule_by_years.between' => 'L\'âge du véhicule en années doit être compris entre 0 et 99.99.',

            'vol.boolean' => 'Le champ vol doit être vrai ou faux.',
            'bris_de_glace.boolean' => 'Le champ bris de glace doit être vrai ou faux.',
            'tierce.boolean' => 'Le champ tierce doit être vrai ou faux.',

            'tierce_value.required' => 'La valeur de tierce est requise.',
            'tierce_value.numeric' => 'La valeur de tierce doit être un nombre.',
            'tierce_value.between' => 'La valeur de tierce doit être comprise entre 0 et 1.',

            'dommage_collision_deplafonnee.boolean' => 'Le champ dommage collision déplafonnée doit être vrai ou faux.',
            'dommage_collision.boolean' => 'Le champ dommage collision doit être vrai ou faux.',

            'dommage_collision_value.required' => 'La valeur de dommage collision est requise.',
            'dommage_collision_value.numeric' => 'La valeur de dommage collision doit être un nombre.',

            'innondations.boolean' => 'Le champ inondations doit être vrai ou faux.',
            'rachat_de_vetustes.boolean' => 'Le champ rachat de vétustés doit être vrai ou faux.',
            'perte_financiere.boolean' => 'Le champ perte financière doit être vrai ou faux.',
            'protection_des_passagers.boolean' => 'Le champ protection des passagers doit être vrai ou faux.',

            'protection_des_passagers_formule.required' => 'La formule de protection des passagers est requise.',
            'protection_des_passagers_formule.in' => 'La formule de protection des passagers doit être soit formule 1, formule 2, soit formule 3.',

            'assistance.boolean' => 'Le champ assistance doit être vrai ou faux.',

            'assistance_type.required' => 'Le type d\'assistance est requis.',
            'assistance_type.in' => 'Le type d\'assistance doit être basique, économique, standard, élargie, gold ou vip.',

            'date_creation.required' => 'La date de création est requise.',
            'date_creation.date' => 'La date de création doit être une date valide.',

            'created_by.required' => 'L\'identifiant de l\'utilisateur qui a créé est requis.',
            'created_by.exists' => 'L\'identifiant de l\'utilisateur doit exister dans la table des utilisateurs.',
            'updated_by.exists' => 'L\'identifiant de l\'utilisateur mis à jour doit exister dans la table des utilisateurs.',

            // quotes validation messages
            'responsabilite_civile.numeric' => 'La responsabilité civile doit être un nombre.',
            'responsabilite_civile_tax.numeric' => 'La taxe de responsabilité civile doit être un nombre.',
            'defense_et_recours.numeric' => 'La défense et recours doit être un nombre.',
            'defense_et_recours_tax.numeric' => 'La taxe de défense et recours doit être un nombre.',
            'incendie.numeric' => 'L\'incendie doit être un nombre.',
            'incendie_tax.numeric' => 'La taxe d\'incendie doit être un nombre.',
            'vol.numeric' => 'Le vol doit être un nombre.',
            'vol_tax.numeric' => 'La taxe de vol doit être un nombre.',
            'bris_de_glace.numeric' => 'Le bris de glace doit être un nombre.',
            'bris_de_glace_tax.numeric' => 'La taxe de bris de glace doit être un nombre.',
            'tierce.numeric' => 'La tierce doit être un nombre.',
            'tierce_tax.numeric' => 'La taxe de tierce doit être un nombre.',
            'dommages_collision_deplafonnee.numeric' => 'Les dommages collision déplafonnés doivent être un nombre.',
            'dommages_collision_deplafonnee_tax.numeric' => 'La taxe de dommages collision déplafonnés doit être un nombre.',
            'dommages_collision_moins_15_ans.numeric' => 'Les dommages collision moins de 15 ans doivent être un nombre.',
            'dommages_collision_moins_15_ans_tax.numeric' => 'La taxe de dommages collision moins de 15 ans doit être un nombre.',
            'innondations.numeric' => 'Les inondations doivent être un nombre.',
            'innondations_tax.numeric' => 'La taxe d\'inondations doit être un nombre.',
            'rachat_de_vetuste.numeric' => 'Le rachat de vétuste doit être un nombre.',
            'rachat_de_vetuste_tax.numeric' => 'La taxe de rachat de vétuste doit être un nombre.',
            'perte_financiere.numeric' => 'La perte financière doit être un nombre.',
            'perte_financiere_tax.numeric' => 'La taxe de perte financière doit être un nombre.',
            'protection_des_passagers.numeric' => 'La protection des passagers doit être un nombre.',
            'protection_des_passagers_tax.numeric' => 'La taxe de protection des passagers doit être un nombre.',
            'assistance.numeric' => 'L\'assistance doit être un nombre.',
            'assistance_tax.numeric' => 'La taxe d\'assistance doit être un nombre.',
            'evenements_catastrophiques.numeric' => 'Les événements catastrophiques doivent être un nombre.',
            'evenements_catastrophiques_tax.numeric' => 'La taxe des événements catastrophiques doit être un nombre.',

            'prime_ht.numeric' => 'La prime HT doit être un nombre.',
            'prime_ht_tax.numeric' => 'La taxe de la prime HT doit être un nombre.',
            'timbres.numeric' => 'Les timbres doivent être un nombre.',
            'taxe_parafiscale.numeric' => 'La taxe parafiscale doit être un nombre.',
            'prime_totale_annuelle.numeric' => 'La prime totale annuelle doit être un nombre.',
            'prorata.numeric' => 'Le prorata doit être un nombre.',

            // client_quotes validation messages
            'responsabilite_civile.boolean' => 'Le champ responsabilité civile doit être vrai ou faux.',
            'responsabilite_civile_tax.boolean' => 'Le champ responsabilité civile tax doit être vrai ou faux.',
            'defense_et_recours.boolean' => 'Le champ défense et recours doit être vrai ou faux.',
            'defense_et_recours_tax.boolean' => 'Le champ défense et recours tax doit être vrai ou faux.',
            'incendie.boolean' => 'Le champ incendie doit être vrai ou faux.',
            'incendie_tax.boolean' => 'Le champ incendie tax doit être vrai ou faux.',
            'vol.boolean' => 'Le champ vol doit être vrai ou faux.',
            'vol_tax.boolean' => 'Le champ vol tax doit être vrai ou faux.',
            'bris_de_glace.boolean' => 'Le champ bris de glace doit être vrai ou faux.',
            'bris_de_glace_tax.boolean' => 'Le champ bris de glace tax doit être vrai ou faux.',
            'tierce.boolean' => 'Le champ tierce doit être vrai ou faux.',
            'tierce_tax.boolean' => 'Le champ tierce tax doit être vrai ou faux.',
            'dommages_collision_deplafonnee.boolean' => 'Le champ dommages collision déplafonnée doit être vrai ou faux.',
            'dommages_collision_deplafonnee_tax.boolean' => 'Le champ dommages collision déplafonnée tax doit être vrai ou faux.',
            'dommages_collision_moins_15_ans.boolean' => 'Le champ dommages collision moins de 15 ans doit être vrai ou faux.',
            'dommages_collision_moins_15_ans_tax.boolean' => 'Le champ dommages collision moins de 15 ans tax doit être vrai ou faux.',
            'innondations.boolean' => 'Le champ inondations doit être vrai ou faux.',
            'innondations_tax.boolean' => 'Le champ inondations tax doit être vrai ou faux.',
            'rachat_de_vetuste.boolean' => 'Le champ rachat de vétuste doit être vrai ou faux.',
            'rachat_de_vetuste_tax.boolean' => 'Le champ rachat de vétuste tax doit être vrai ou faux.',
            'perte_financiere.boolean' => 'Le champ perte financière doit être vrai ou faux.',
            'perte_financiere_tax.boolean' => 'Le champ perte financière tax doit être vrai ou faux.',
            'protection_des_passagers.boolean' => 'Le champ protection des passagers doit être vrai ou faux.',
            'protection_des_passagers_tax.boolean' => 'Le champ protection des passagers tax doit être vrai ou faux.',
            'assistance.boolean' => 'Le champ assistance doit être vrai ou faux.',
            'assistance_tax.boolean' => 'Le champ assistance tax doit être vrai ou faux.',
            'evenements_catastrophiques.boolean' => 'Le champ événements catastrophiques doit être vrai ou faux.',
            'evenements_catastrophiques_tax.boolean' => 'Le champ événements catastrophiques tax doit être vrai ou faux.',

            'prime_ht.boolean' => 'Le champ prime HT doit être vrai ou faux.',
            'prime_ht_tax.boolean' => 'Le champ prime HT tax doit être vrai ou faux.',
            'timbres.boolean' => 'Le champ timbres doit être vrai ou faux.',
            'taxe_parafiscale.boolean' => 'Le champ taxe parafiscale doit être vrai ou faux.',
            'prime_totale_annuelle.boolean' => 'Le champ prime totale annuelle doit être vrai ou faux.',
            'prorata.boolean' => 'Le champ prorata doit être vrai ou faux.',

            'quote_info_id.exists' => 'L\'identifiant quote_info doit exister dans la table quote_infos.',
        ];
    }
}
