<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kyc\VerificationRequest;
use App\Http\Resources\UserResource;
use App\Services\VerificationService;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    public function __construct(protected VerificationService $verificationService) {}

    public function store(VerificationRequest $request): JsonResponse
    {
        $user = $request->user();
        $this->verificationService->submitKycAndProfile($user, $request->validated());

        // Recharge l'utilisateur avec ses relations pour renvoyer le profil et l'adresse à jour
        $user->load(['profile', 'address']);

        return response()->json([
            'message' => 'Informations de vérification et KYC enregistrées avec succès',
            'data' => [
                'user' => new UserResource($user),
            ],
        ], 200);
    }
}
