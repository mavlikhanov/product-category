<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product\ProductProcessorPool;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSaverProcessor extends AbstractProcessor implements \App\Api\Data\Catalog\ProductProcessorInterface
{
    const ACTION_PROCESS = 'store';

    public function canProcess(): bool
    {
        return $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        return new ProductResource($this->productRepository->create($this->getPreparedData()));
    }
}