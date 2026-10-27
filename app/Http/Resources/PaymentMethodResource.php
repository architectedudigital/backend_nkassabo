<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'identifiant_compte' => $this->identifiant_compte,
            'est_par_defaut' => $this->est_par_defaut,
            'created_at' => $this->created_at,
        ];
    }
}