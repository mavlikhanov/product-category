<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter;

use App\Api\Data\ParserDiInterface;
use App\Service\Catalog\Filter\ProcessorPool\CategoryIdProcessor;
use App\Service\Catalog\Filter\ProcessorPool\CategoryName;
use App\Service\Catalog\Filter\ProcessorPool\DeletedProcessor;
use App\Service\Catalog\Filter\ProcessorPool\PriceProcessor;
use App\Service\Catalog\Filter\ProcessorPool\ProductNameProcessor;
use App\Service\Catalog\Filter\ProcessorPool\PublishedProcessor;

class ParserDi implements ParserDiInterface
{
    private $productNameProcessor;
    private $categoryIdProcessor;
    private $categoryName;
    private $priceProcessor;
    private $publishedProcessor;
    private $deletedProcessor;

    public function __construct(
        ProductNameProcessor $productNameProcessor,
        CategoryIdProcessor $categoryIdProcessor,
        CategoryName $categoryName,
        PriceProcessor $priceProcessor,
        PublishedProcessor $publishedProcessor,
        DeletedProcessor $deletedProcessor
    ) {
        $this->productNameProcessor = $productNameProcessor;
        $this->categoryIdProcessor = $categoryIdProcessor;
        $this->categoryName = $categoryName;
        $this->priceProcessor = $priceProcessor;
        $this->publishedProcessor = $publishedProcessor;
        $this->deletedProcessor = $deletedProcessor;
    }

    public function matchProcessors(): array
    {
        return [
            'productNameProcessor' => $this->productNameProcessor,
            'categoryIdProcessor' => $this->categoryIdProcessor,
            'categoryName' => $this->categoryName,
            'priceProcessor' => $this->priceProcessor,
            'publishedProcessor' => $this->publishedProcessor,
            'deletedProcessor' => $this->deletedProcessor,
        ];
    }
}