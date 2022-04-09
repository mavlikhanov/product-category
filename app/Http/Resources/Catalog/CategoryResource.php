<?php
declare(strict_types=1);

namespace App\Http\Resources\Catalog;

use App\Api\Data\CategoryInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            CategoryInterface::ID          => $this->id,
            CategoryInterface::TITLE       => $this->title,
            CategoryInterface::DESCRIPTION => $this->description,
        ];
    }
}
