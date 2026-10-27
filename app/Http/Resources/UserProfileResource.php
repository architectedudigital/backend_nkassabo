<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'date_naissance' => $this->date_naissance,
            'type_piece_identite' => $this->type_piece_identite,
            'numero_piece_identite' => $this->numero_piece_identite,
        ];
    }
}