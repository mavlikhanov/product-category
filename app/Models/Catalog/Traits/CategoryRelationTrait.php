<?php
declare(strict_types=1);

namespace App\Models\Catalog\Traits;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CategoryRelationTrait
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}