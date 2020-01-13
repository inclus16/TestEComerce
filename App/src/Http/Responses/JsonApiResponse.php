<?php


namespace App\Http\Responses;


use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiResponse
{
    public static function success(array $data = []): JsonResponse
    {
        return self::create(true, 200, $data);
    }

    public static function error(int $code, array $errors): JsonResponse
    {
        return self::create(false, $code, $errors);
    }

    private static function create(bool $success, int $code = 200, array $data = []): JsonResponse
    {
        $responseData = [];
        $responseData['success'] = $success;
        if ($success) {
            $responseData['data'] = $data;
        } else {
            $responseData['errors'] = $data;
        }
        return new JsonResponse($responseData, $code);
    }
}
