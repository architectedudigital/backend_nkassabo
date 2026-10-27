<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class VerificationService
{
    public function submitKycAndProfile(User $user, array $data): void
    {
        DB::transaction(function () use ($user, $data) {
            $user->update([
                'a_une_candidature_existante' => $data['a_une_candidature_existante'] ?? false,
                'numero_identifiant_parrain' => $data['numero_identifiant_parrain'] ?? null,
                'nom_parrain' => $data['nom_parrain'] ?? null,
                'pdpl_accepte_le' => now(),
            ]);

            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'prenom' => $data['prenom'],
                    'nom' => $data['nom'],
                    'date_naissance' => $data['date_naissance'],
                    'type_piece_identite' => $data['type_piece_identite'],
                    'numero_piece_identite' => $data['numero_piece_identite'],
                ]
            );

            $user->address()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'province' => $data['province'],
                    'district' => $data['district'],
                    'quartier' => $data['quartier'],
                    'rue' => $data['rue'],
                    'numero_maison' => $data['numero_maison'],
                    'appartement' => $data['appartement'] ?? null,
                    'code_postal' => $data['code_postal'],
                ]
            );
        });
    }
}