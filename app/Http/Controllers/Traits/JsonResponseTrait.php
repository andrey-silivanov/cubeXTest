<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse,
    Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class JsonResponseTrait
 * @package Hub\Http\Traits
 */
trait JsonResponseTrait
{
    /**
     * @param JsonResource $resource
     * @param  $data
     * @param null $key
     *
     * @return array|JsonResponse
     */
    public function transformDataForResponse(JsonResource $resource, $data = [], $key = null): array
    {
        if(is_null($resource->resource)) return [];

        return collect($resource->response()->getData())->flatten()->toArray();
    }

    /**
     * @param array $data
     * @param null $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function entityCreatedResponse($data = [], $message = null, array $headers = [], $options = 0): JsonResponse
    {
        // 200, not 201!
        return $this->apiResponse(200, $data, $message, $headers, $options);
    }

    /**
     * @param array $data
     * @param null $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function successResponse(array $data = [], $message = null, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(200, $data, $message, $headers, $options);
    }

    /**
     * @param array $data
     * @param null $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function invalidResponse(array $data = [], $message = null, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(422, $data, $message, $headers, $options);
    }

    /**
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function noContentResponse(array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(200, [], null, $headers, $options);
    }

    /**
     * @param string $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function notFoundResponse($message, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(404, [], $message, $headers, $options);
    }

    /**
     * @param string $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function unauthorizedResponse($message = null, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(401, [], $message, $headers, $options);
    }

    /**
     * @param string $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function badRequestResponse($message = null, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(400, [], $message, $headers, $options);
    }

    /**
     * @param string $message
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    protected function internalErrorResponse($message, array $headers = [], $options = 0): JsonResponse
    {
        return $this->apiResponse(500, [], $message, $headers, $options);
    }

    /**
     * Make Json response
     *
     * @param int $code Response code
     * @param array $data Optional result data
     * @param null $message Optional message
     * @param array $headers Optional headers
     * @param int $options Optional options
     *
     * @return JsonResponse
     */
    public function apiResponse(
        int $code,
        array $data = [],
        $message = null,
        array $headers = [],
        int $options = 0
    ): JsonResponse
    {
        // Set code
        $respData['code'] = $code;

        // Set message
        if (!is_null($message)) {
            $respData['message'] = $message;
        }

        // Reformat depending on the status code
        switch ($code) {
            case 200:
                if (isset($data['paginate'])) {
                    $paginate = $data['paginate'];
                    unset($data['paginate']);
                    $respData['paginate'] = $paginate;
                }
                $respData['result'] = (count($data) == 1) ? $data[0] : $data;
                break;

            case 422:
                $errors = [];
                foreach ($data as $field => $error) {
                    $errors[$field] = [
                        $error,
                    ];
                }
                $respData['errors'] = (array)$errors;
                break;
        }

        return response()->json($respData, $code, $headers, $options);
    }
}