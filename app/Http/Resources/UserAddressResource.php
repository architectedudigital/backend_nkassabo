<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'province' => $this->province,
            'district' => $this->district,
            'quartier' => $this->quartier,
            'rue' => $this->rue,
            'numero_maison' => $this->numero_maison,
            'appartement' => $this->appartement,
            'code_postal' => $this->code_postal,
        ];
    }
}