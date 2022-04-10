<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category\CategoryProcessorPool;

use App\Api\Data\Catalog\CategoryProcessorInterface;
use App\Api\Data\CategoryInterface;
use App\Repository\Catalog\CategoryRepository;
use Illuminate\Http\Request;

abstract class AbstractProcessor implements CategoryProcessorInterface
{
    protected $id;
    protected $request;
    protected $actionName;
    protected $categoryRepository;
    protected $category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function setRequest(Request $request): CategoryProcessorInterface
    {
        $this->request = $request;
        return $this;
    }

    public function setActionName(string $actionName): CategoryProcessorInterface
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setId(int $id): CategoryProcessorInterface
    {
        $this->id = $id;
        return $this;
    }

    public function canProcess(): bool
    {
        if (!$this->id) {
            return false;
        }
        $this->category = $this->categoryRepository->getById($this->id);
        return true;
    }

    protected function getPreparedData(): array
    {
        return [
            CategoryInterface::TITLE       => $this->request->title,
            CategoryInterface::DESCRIPTION => $this->request->description ?? null,
        ];
    }
}