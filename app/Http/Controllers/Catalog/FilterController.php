<?php
declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterController extends Controller
{
    private $filterManager;

    public function __construct(\App\Service\Catalog\Filter\FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
    }

    public function filter(Request $request): JsonResource
    {
        return $this->filterManager->setRequest($request)->manage();
    }
}
