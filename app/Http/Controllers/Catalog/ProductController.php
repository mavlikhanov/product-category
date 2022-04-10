<?php
declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\ProductRequest;
use App\Http\Requests\Catalog\ProductStoreRequest;
use App\Service\Catalog\Product\ProductManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    private $productManager;
    
    public function __construct(ProductManager $productManager)
    {
        $this->productManager = $productManager;
    }
    
    public function index(): JsonResource
    {
        return $this->productManager
            ->setActionName(__FUNCTION__)
            ->manage();
    }
    
    public function store(ProductStoreRequest $request): JsonResource
    {
        return $this->productManager
            ->setActionName(__FUNCTION__)
            ->setRequest($request)
            ->manage();
    }
    
    public function update(ProductRequest $request, int $id): JsonResource
    {
        return $this->productManager
            ->setActionName(__FUNCTION__)
            ->setRequest($request)
            ->setEntityId($id)
            ->manage();
    }
    
    public function destroy(int $id): JsonResource
    {
        return $this->productManager
            ->setActionName(__FUNCTION__)
            ->setEntityId($id)
            ->manage();
    }
}
