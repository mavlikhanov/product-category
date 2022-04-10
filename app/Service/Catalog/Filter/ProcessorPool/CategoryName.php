<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;

class CategoryName extends AbstractProcessor implements FilterProcessorInterface
{
    const FILTER_NAME = 'category_name';

    public function canProcess(): bool
    {
        return $this->request->has(self::FILTER_NAME);
    }

    public function process(): FilterProcessorInterface
    {
        $this->product->whereHas('categories', function ($query) {
            $query->where('title', 'like', '%' . $this->request->get(self::FILTER_NAME) . '%');
        });
        return $this;
    }
}