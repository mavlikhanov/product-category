<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product\ProductProcessorPool;

use App\Http\Resources\Catalog\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRemoverProcessor extends AbstractProcessor implements \App\Api\Data\Catalog\ProductProcessorInterface
{
    const ACTION_PROCESS = 'destroy';

    public function canProcess(): bool
    {
        return parent::canProcess() && $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        $this->productRepository->delete($this->product);
        return ProductResource::collection($this->productRepository->getList());
    }
}