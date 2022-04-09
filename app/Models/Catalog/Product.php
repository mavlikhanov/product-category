<?php
declare(strict_types=1);

namespace App\Models\Catalog;

use App\Models\Catalog\Traits\ProductRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, ProductRelationTrait;

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_published',
    ];
}
