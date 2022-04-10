<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter;

use App\Models\Catalog\Product;
use App\Service\Catalog\AbstractBaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterManager extends AbstractBaseManager
{
    private $filterProcessorPool;
    private $request;

    public function __construct(
        FilterProcessorPool $filterProcessorPool
    ) {
        $this->filterProcessorPool = $filterProcessorPool;
    }

    public function setRequest(Request $request): FilterManager
    {
        $this->request = $request;
        return $this;
    }

    protected function process(): ?JsonResource
    {
        $product = Product::query();

        $result = null;
        foreach ($this->filterProcessorPool->getProcessors() as $processor) {
            $processor->setProduct($product)->setRequest($this->request);
            if ($processor->canProcess()) {
                $result = $processor->process();
            }
        }
        return $result->getCollection();
    }
}