<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category;

use App\Service\Catalog\Category\CategoryProcessorPool\CategoryIndexProcessor;
use App\Service\Catalog\Category\CategoryProcessorPool\CategoryRemoverProcessor;
use App\Service\Catalog\Category\CategoryProcessorPool\CategorySaverProcessor;
use App\Service\Catalog\Category\CategoryProcessorPool\CategoryUpdaterProcessor;

class ParserDi
{
    private $categorySaverProcessor;
    private $categoryUpdaterProcessor;
    private $categoryRemoverProcessor;
    private $categoryIndexProcessor;

    public function __construct(
        CategorySaverProcessor $categorySaverProcessor,
        CategoryUpdaterProcessor $categoryUpdaterProcessor,
        CategoryRemoverProcessor $categoryRemoverProcessor,
        CategoryIndexProcessor $categoryIndexProcessor
    ) {
        $this->categorySaverProcessor = $categorySaverProcessor;
        $this->categoryUpdaterProcessor = $categoryUpdaterProcessor;
        $this->categoryRemoverProcessor = $categoryRemoverProcessor;
        $this->categoryIndexProcessor = $categoryIndexProcessor;
    }

    public function matchProcessors(): array
    {
        return [
            'store' => $this->categorySaverProcessor,
            'update' => $this->categoryUpdaterProcessor,
            'destroy' => $this->categoryRemoverProcessor,
            'index' => $this->categoryIndexProcessor,
        ];
    }
}