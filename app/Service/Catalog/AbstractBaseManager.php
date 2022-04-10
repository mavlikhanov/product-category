<?php
declare(strict_types=1);

namespace App\Service\Catalog;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractBaseManager
{
    public function manage(): JsonResource
    {
        try {
            $data = $this->process();
        } catch (ModelNotFoundException $exception) {
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], 404));
        }
        catch (\Exception $exception) {
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], 422));
        }
        if (!$data) {
            throw new HttpResponseException(response()->json(['message' => 'Error with passed data'], 422));
        }
        return $data;
    }

    abstract protected function process(): ?JsonResource;
}