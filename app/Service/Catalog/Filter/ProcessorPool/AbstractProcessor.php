<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter\ProcessorPool;

use App\Api\Data\Catalog\FilterProcessorInterface;
use App\Http\Resources\Catalog\FilterResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractProcessor implements FilterProcessorInterface
{
    protected $request;
    protected $product;

    public function setRequest(Request $request): FilterProcessorInterface
    {
        $this->request = $request;
        return $this;
    }

    public function setProduct(Builder $product): FilterProcessorInterface
    {
        $this->product = $product;
        return $this;
    }

    public function getCollection(): JsonResource
    {
        return FilterResource::collection($this->product->get());
    }
}