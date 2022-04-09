<?php
declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\CategoryRequest;
use App\Http\Requests\Catalog\CategoryStoreRequest;
use App\Service\Catalog\Category\CategoryManager;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    private $categoryManager;

    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    public function index(): JsonResource
    {
        return $this->categoryManager
            ->setActionName(__FUNCTION__)
            ->manage();
    }

    public function store(CategoryStoreRequest $request): JsonResource
    {
        return $this->categoryManager
            ->setActionName(__FUNCTION__)
            ->setRequest($request)
            ->manage();
    }

    public function update(CategoryRequest $request, int $id): JsonResource
    {
        return $this->categoryManager
            ->setActionName(__FUNCTION__)
            ->setRequest($request)
            ->setEntityId($id)
            ->manage();
    }

    public function destroy(int $id): JsonResource
    {
        return $this->categoryManager
            ->setActionName(__FUNCTION__)
            ->setEntityId($id)
            ->manage();
    }
}
