<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category;

use App\Service\Catalog\AbstractBaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryManager extends AbstractBaseManager
{
    private $categoryProcessorPool;
    private $actionName;
    private $request;
    private $id;

    public function __construct(CategoryProcessorPool $categoryProcessorPool)
    {
        $this->categoryProcessorPool = $categoryProcessorPool;
    }

    public function setActionName(string $actionName): CategoryManager
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setRequest(Request $request): CategoryManager
    {
        $this->request = $request;
        return $this;
    }

    public function setEntityId(int $id): CategoryManager
    {
        $this->id = $id;
        return $this;
    }

    protected function process(): ?JsonResource
    {
        foreach ($this->categoryProcessorPool->getProcessors() as $processor) {
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