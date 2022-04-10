<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;

class PriceProcessor extends AbstractProcessor implements FilterProcessorInterface
{
    const FILTER_NAME = 'price';

    public function canProcess(): bool
    {
        return $this->request->has(self::FILTER_NAME);
    }

    public function process(): FilterProcessorInterface
    {
        $priceRange = json_decode($this->request->get(self::FILTER_NAME));
        if (isset($priceRange->from)) {
            $this->product->where(self::FILTER_NAME, '>', (float)$priceRange->from);
        }
        if (isset($priceRange->to)) {
            $this->product->where(self::FILTER_NAME, '<', (float)$priceRange->to);
        }
        return $this;
    }
}