<?php
declare(strict_types=1);

namespace App\Models\Catalog;

use App\Models\Catalog\Traits\CategoryRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CategoryRelationTrait;

    protected $fillable = [
        'title',
        'description',
    ];
}
