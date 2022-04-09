<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category\CategoryProcessorPool;

use App\Api\Data\Catalog\CategoryProcessorInterface;
use App\Http\Resources\Catalog\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexProcessor extends AbstractProcessor implements CategoryProcessorInterface
{
    const ACTION_PROCESS = 'index';

    public function canProcess(): bool
    {
        return $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        return CategoryResource::collection($this->categoryRepository->getList());
    }
}