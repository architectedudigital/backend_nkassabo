<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentMethodRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Services\PaymentMethodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct(protected PaymentMethodService $paymentMethodService) {}

    public function index(Request $request): JsonResponse
    {
        $paymentMethods = $request->user()->paymentMethods;

        return response()->json([
            'data' => PaymentMethodResource::collection($paymentMethods),
        ], 200);
    }

    public function store(PaymentMethodRequest $request): JsonResponse
    {
        $method = $this->paymentMethodService->addMethod($request->user(), $request->validated());

        return response()->json([
            'message' => 'Méthode de paiement ajoutée',
            'data' => new PaymentMethodResource($method),
        ], 201);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $this->paymentMethodService->removeMethod($request->user(), $id);

        return response()->json([
            'message' => 'Méthode de paiement supprimée',
        ], 200);
    }
}