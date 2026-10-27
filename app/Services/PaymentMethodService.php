<?php
namespace App\Services;

use App\Models\PaymentMethod;
use App\Models\User;

class PaymentMethodService
{
    public function addMethod(User $user, array $data): PaymentMethod
    {
        if ($data['est_par_defaut'] ?? false) {
            $user->paymentMethods()->update(['est_par_defaut' => false]);
        }

        return $user->paymentMethods()->create([
            'type' => $data['type'],
            'identifiant_compte' => $data['identifiant_compte'],
            'est_par_defaut' => $data['est_par_defaut'] ?? false,
        ]);
    }

    public function removeMethod(User $user, int $methodId): bool
    {
        $method = $user->paymentMethods()->findOrFail($methodId);
        return $method->delete();
    }
}