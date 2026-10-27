<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'email' => $data['email'],
            'indicatif_pays' => $data['indicatif_pays'],
            'numero_telephone' => $data['numero_telephone'],
            'mot_de_passe' => Hash::make($data['mot_de_passe']),
        ]);

        $token = $user->createToken('mobile_app_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['mot_de_passe'], $user->mot_de_passe)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants fournis sont incorrects.'],
            ]);
        }

        $token = $user->createToken('mobile_app_token')->plainTextToken;

        return ['user' => $user->load(['profile', 'address', 'paymentMethods']), 'token' => $token];
    }
}