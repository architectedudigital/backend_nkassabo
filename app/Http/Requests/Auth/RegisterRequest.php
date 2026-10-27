<?php

namespace App\Http\Requests\Auth;
namespace App\Http\Requests\Kyc;

use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'type_piece_identite' => ['required', 'in:carte_nationale,passeport'],
            'numero_piece_identite' => ['required', 'string', 'unique:user_profiles,numero_piece_identite'],
            'province' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'quartier' => ['required', 'string', 'max:255'],
            'rue' => ['required', 'string', 'max:255'],
            'numero_maison' => ['required', 'string', 'max:50'],
            'appartement' => ['nullable', 'string', 'max:50'],
            'code_postal' => ['required', 'string', 'max:20'],
            'a_une_candidature_existante' => ['boolean'],
            'numero_identifiant_parrain' => ['nullable', 'string', 'max:255'],
            'nom_parrain' => ['nullable', 'string', 'max:255'],
            'pdpl_accepte' => ['required', 'accepted'],
        ];
    }
}