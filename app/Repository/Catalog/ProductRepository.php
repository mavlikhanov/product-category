<?php
declare(strict_types=1);

namespace App\Repository\Catalog;

use App\Api\Data\ProductInterface;
use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductRepository
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $data): Product
    {
        $categories = $this->getCategories($data);
        $product = Product::create($data);
        if (!$categories) {
            return $product;
        }
        $product->categories()->attach($categories);
        return $product;
    }

    public function getById(int $id): Product
    {
        $product = Product::find($id);
        if (!$product || !$product->id) {
            throw new \Exception("Product with id #{$id} doest not exist");
        }
        return $product;
    }

    public function update(Product $product, array $data): Product
    {
        $categories = $this->getCategories($data);
        if (!$product->update($data)) {
            throw new \Exception("Product with id #{$product->id} cannot update");
        }
        DB::beginTransaction();
        try {
            $product->categories()->detach($product->categories);
            if ($categories) {
                $product->categories()->attach($categories);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        return $this->getById($product->id);
    }

    public function delete(Product $product): void
    {
        DB::beginTransaction();
        $product->categories()->detach($product->categories);
        if (!$product->delete()) {
            DB::rollBack();
            throw new ModelNotFoundException("Product with id #{$product->id} cannot delete");
        }
        DB::commit();
    }

    public function getList()
    {
        return Product::get();
    }

    private function getCategories(array $data)
    {
        if (!isset($data[ProductInterface::CATEGORY_IDS])) {
            throw new \Exception('Categories must be passed');
        }
        $categoryIds = json_decode($data[ProductInterface::CATEGORY_IDS]);
        if (count($categoryIds) < 2 || count($categoryIds) > 10) {
            throw new \Exception('Product must have from two to ten categories');
        }
        try {
            $categories = $this->categoryRepository->getByIds($categoryIds);
        } catch (\Exception $exception) {}
        return $categories;
    }
}