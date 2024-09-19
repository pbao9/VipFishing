<?php

namespace App\Api\V1\Support;


use Illuminate\Http\JsonResponse;

trait Response
{
    protected static array $EMPTY_ARRAY = [];

    /**
     * Return a standardized success JSON response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function jsonResponseSuccess(mixed $data, string $message = '', int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message ?: __('Thực hiện thành công.'),
            'data' => $data
        ], $status);
    }


    /**
     * Return a standardized error JSON response.
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    protected function jsonResponseError(string $message = '', int $status = 400): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message ?: __('Thực hiện không thành công.'),
            'data' => null
        ], $status);
    }

}
