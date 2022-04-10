<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;

class PublishedProcessor extends AbstractProcessor implements FilterProcessorInterface
{
    const FILTER_NAME = 'is_published';

    public function canProcess(): bool
    {
        return $this->request->has(self::FILTER_NAME);
    }

    public function process(): FilterProcessorInterface
    {
        $this->product->where(self::FILTER_NAME, $this->request->get(self::FILTER_NAME));
        return $this;
    }
}