<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product\ProductProcessorPool;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexProcessor extends AbstractProcessor implements \App\Api\Data\Catalog\ProductProcessorInterface
{
    const ACTION_PROCESS = 'index';

    public function canProcess(): bool
    {
        return $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        return ProductResource::collection($this->productRepository->getList());
    }
}