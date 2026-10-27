<?php
namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:50'],
            'identifiant_compte' => ['required', 'string', 'max:255'],
            'est_par_defaut' => ['boolean'],
        ];
    }
}