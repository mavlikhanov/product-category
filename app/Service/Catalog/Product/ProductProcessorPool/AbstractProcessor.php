<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product\ProductProcessorPool;

use App\Api\Data\Catalog\ProductProcessorInterface;
use App\Api\Data\ProductInterface;
use App\Repository\Catalog\ProductRepository;
use Illuminate\Http\Request;

abstract class AbstractProcessor implements ProductProcessorInterface
{
    protected $id;
    protected $request;
    protected $actionName;
    protected $productRepository;
    protected $product;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function setRequest(Request $request): ProductProcessorInterface
    {
        $this->request = $request;
        return $this;
    }

    public function setActionName(string $actionName): ProductProcessorInterface
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setId(int $id): ProductProcessorInterface
    {
        $this->id = $id;
        return $this;
    }

    public function canProcess(): bool
    {
        if (!$this->id) {
            return false;
        }
        $this->product = $this->productRepository->getById($this->id);
        return true;
    }

    protected function getPreparedData(): array
    {
        $data = [];
        if ($this->request->title) {
            $data[ProductInterface::TITLE] = $this->request->title;
        }
        if ($this->request->description) {
            $data[ProductInterface::DESCRIPTION] = $this->request->description;
        }
        if ($this->request->price) {
            $data[ProductInterface::PRICE] = (float)$this->request->price;
        }
        if ($this->request->is_published) {
            $data[ProductInterface::IS_PUBLISHED] = (bool)$this->request->is_published;
        }
        if ($this->request->category_ids) {
            $data[ProductInterface::CATEGORY_IDS] = $this->request->category_ids;
        }
        return $data;
    }
}