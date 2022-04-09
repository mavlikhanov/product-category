<?php
declare(strict_types=1);

namespace App\Models\Catalog\Traits;

use App\Models\Catalog\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait ProductRelationTrait
{
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}