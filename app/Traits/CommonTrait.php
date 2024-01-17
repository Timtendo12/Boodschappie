<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait CommonTrait {
    public function CommonResponse($data, $message, $code = 200, $confetti = false): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'confetti' => $confetti
        ], $code);
    }
}
