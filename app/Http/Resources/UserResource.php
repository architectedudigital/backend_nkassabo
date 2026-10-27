<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'indicatif_pays' => $this->indicatif_pays,
            'numero_telephone' => $this->numero_telephone,
            'a_une_candidature_existante' => $this->a_une_candidature_existante,
            'numero_identifiant_parrain' => $this->numero_identifiant_parrain,
            'nom_parrain' => $this->nom_parrain,
            'pdpl_accepte_le' => $this->pdpl_accepte_le,
            
            // Relations (chargées si présentes)
            'profile' => new UserProfileResource($this->whenLoaded('profile')),
            'address' => new UserAddressResource($this->whenLoaded('address')),
            'payment_methods' => PaymentMethodResource::collection($this->whenLoaded('paymentMethods')),
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}