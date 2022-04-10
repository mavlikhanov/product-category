<?php
declare(strict_types=1);

namespace App\Api\Data\Catalog;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

interface FilterProcessorInterface
{
    public function canProcess(): bool;
    public function process(): FilterProcessorInterface;
    public function setRequest(Request $request): FilterProcessorInterface;
    public function setProduct(Builder $product): FilterProcessorInterface;
    public function getCollection(): JsonResource;
}