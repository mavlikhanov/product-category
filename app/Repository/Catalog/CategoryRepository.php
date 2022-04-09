<?php
declare(strict_types=1);

namespace App\Repository\Catalog;

use App\Models\Catalog\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRepository
{
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function getById(int $id): Category
    {
        $category = Category::find($id);
        if (!$category || !$category->id) {
            throw new \Exception("Category with id #{$id} doest not exist");
        }
        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        if (!$category->update($data)) {
            throw new \Exception("Category with id #{$category->id} cannot update");
        }
        return $category;
    }

    public function delete(Category $category): void
    {
        if (!$category->products->isEmpty()) {
            throw new \Exception("You cannot delete category while one has products");
        }
        if (!$category->delete()) {
            throw new ModelNotFoundException("Category with id #{$category->id} cannot delete");
        }
    }

    public function getList()
    {
        return Category::get();
    }
}