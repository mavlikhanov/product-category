<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;

class DeletedProcessor extends AbstractProcessor implements FilterProcessorInterface
{
    const FILTER_NAME = 'is_deleted';

    public function canProcess(): bool
    {
        return $this->request->has(self::FILTER_NAME);
    }

    public function process(): FilterProcessorInterface
    {
        if ($this->request->get(self::FILTER_NAME)) {
            $this->product = $this->product->getQuery();
            $this->product->whereNotNull('deleted_at');
        }
        return $this;
    }
}