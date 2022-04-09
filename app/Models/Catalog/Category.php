<?php
declare(strict_types=1);

namespace App\Models\Catalog;

use App\Models\Catalog\Traits\CategoryRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, CategoryRelationTrait, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
    ];
}
