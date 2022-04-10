<?php
declare(strict_types=1);

namespace App\Http\Resources\Catalog;

use App\Api\Data\ProductInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ProductInterface::ID          => $this->id,
            ProductInterface::TITLE       => $this->title,
            ProductInterface::DESCRIPTION => $this->description,
            ProductInterface::PRICE       => $this->price,
            ProductInterface::CATEGORIES  => $this->categories,
        ];
    }
}
