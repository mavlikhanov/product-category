<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product\ProductProcessorPool;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductUpdaterProcessor extends AbstractProcessor implements \App\Api\Data\Catalog\ProductProcessorInterface
{
    const ACTION_PROCESS = 'update';

    public function canProcess(): bool
    {
        return parent::canProcess() && $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        return new ProductResource($this->productRepository->update($this->product, $this->getPreparedData()));
    }
}