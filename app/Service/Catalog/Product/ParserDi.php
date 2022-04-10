<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product;

use App\Api\Data\ParserDiInterface;
use App\Service\Catalog\Product\ProductProcessorPool\ProductIndexProcessor;
use App\Service\Catalog\Product\ProductProcessorPool\ProductRemoverProcessor;
use App\Service\Catalog\Product\ProductProcessorPool\ProductSaverProcessor;
use App\Service\Catalog\Product\ProductProcessorPool\ProductUpdaterProcessor;

class ParserDi implements ParserDiInterface
{
    private $productIndexProcessor;
    private $productRemoverProcessor;
    private $productSaverProcessor;
    private $productUpdaterProcessor;

    public function __construct(
        ProductIndexProcessor $productIndexProcessor,
        ProductRemoverProcessor $productRemoverProcessor,
        ProductSaverProcessor $productSaverProcessor,
        ProductUpdaterProcessor $productUpdaterProcessor
    ) {
        $this->productIndexProcessor = $productIndexProcessor;
        $this->productRemoverProcessor = $productRemoverProcessor;
        $this->productSaverProcessor = $productSaverProcessor;
        $this->productUpdaterProcessor = $productUpdaterProcessor;
    }

    public function matchProcessors(): array
    {
        return [
            'index' => $this->productIndexProcessor,
            'destroy' => $this->productRemoverProcessor,
            'store' => $this->productSaverProcessor,
            'update' => $this->productUpdaterProcessor,
        ];
    }
}