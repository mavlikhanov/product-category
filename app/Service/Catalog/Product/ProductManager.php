<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product;

use App\Service\Catalog\AbstractBaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductManager extends AbstractBaseManager
{
    private $productProcessorPool;
    private $actionName;
    private $request;
    private $id;
    
    public function __construct(ProductProcessorPool $productProcessorPool)
    {
        $this->productProcessorPool = $productProcessorPool;
    }

    public function setActionName(string $actionName): ProductManager
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setRequest(Request $request): ProductManager
    {
        $this->request = $request;
        return $this;
    }

    public function setEntityId(int $id): ProductManager
    {
        $this->id = $id;
        return $this;
    }

    protected function process(): ?JsonResource
    {
        foreach ($this->productProcessorPool->getProcessors() as $processor) {
            $processor->setActionName($this->actionName);
            if ($this->request) {
                $processor->setRequest($this->request);
            }
            if ($this->id) {
                $processor->setId($this->id);
            }
            if ($processor->canProcess()) {
                return $processor->process();
            }
        }
        return null;
    }
}