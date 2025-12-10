<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponder
{
    /**
     * Build success response
     * @param mixed $data -> string message for success false
     * @param bool $success
     * @param int $code
     * @param string $message
     * @param string $location
     * @return JsonResponse
     */
    public function httpResponse(mixed $data, bool $success = true, int $code = 200, string $message = "message.operation_successful", string $location = "/welcome"): JsonResponse
    {
        return response()->json(["data" => $data, "message" => $message, "success" => $success, "location" => $location], $code);
    }
}
