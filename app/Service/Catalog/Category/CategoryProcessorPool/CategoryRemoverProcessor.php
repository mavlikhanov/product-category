<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category\CategoryProcessorPool;

use App\Api\Data\Catalog\CategoryProcessorInterface;
use App\Http\Resources\Catalog\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryRemoverProcessor extends AbstractProcessor implements CategoryProcessorInterface
{
    const ACTION_PROCESS = 'destroy';

    public function canProcess(): bool
    {
        return parent::canProcess() && $this->actionName == self::ACTION_PROCESS;
    }

    public function process(): JsonResource
    {
        $this->categoryRepository->delete($this->category);
        return CategoryResource::collection($this->categoryRepository->getList());
    }
}