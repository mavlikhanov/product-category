<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;

class ProductNameProcessor extends AbstractProcessor implements FilterProcessorInterface
{
    const FILTER_NAME = 'product_name';

    public function canProcess(): bool
    {
        return $this->request->has('product_name');
    }

    public function process(): FilterProcessorInterface
    {
        $this->product->where('title', 'like', '%' . $this->request->get(self::FILTER_NAME) . '%');
        return $this;
    }
}