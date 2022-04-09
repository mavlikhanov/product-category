<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category\CategoryProcessorPool;

use App\Api\Data\Catalog\CategoryProcessorInterface;
use App\Http\Resources\Catalog\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryUpdaterProcessor extends AbstractProcessor implements CategoryProcessorInterface
{
    const ACTION_PROCESS = 'update';

    public function canProcess(): bool
    {
        return parent::canProcess() && $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        return new CategoryResource($this->categoryRepository->update($this->category, $this->getPreparedData()));
    }
}