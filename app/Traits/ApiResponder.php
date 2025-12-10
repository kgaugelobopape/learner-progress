<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

trait ApiResponser
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
    public function httpResponse(mixed $data, bool $success = true, int $code = Response::HTTP_OK, string $message = "message.operation_successful", string $location = "/welcome"): JsonResponse
    {
        return response()->json(["data" => $data, "message" => $message, "success" => $success, "location" => $location], $code);
    }

    /**
     * Build success response
     * @param string|array $message
     * @param int $code
     * @param string $location
     * @return JsonResponse
     */
    public function errorResponse($message, int $code, string $location = "/home"): JsonResponse
    {
        return response()->json(["error" => $message, "code" => $code, "location" => $location], $code);
    }
}
