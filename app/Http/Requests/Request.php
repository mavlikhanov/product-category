<?php
declare(strict_types=1);

namespace App\Http\Requests;

use App\Api\Data\HTTP_STATUS;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class Request extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(['data' => [],
            'errors' => [
                'message' => HTTP_STATUS::BAD_REQUEST_MESSAGE,
                'errors' => $validator->errors()
            ]], HTTP_STATUS::BAD_REQUEST);

        throw new ValidationException($validator, $response);
    }
}
