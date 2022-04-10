<?php
declare(strict_types=1);

namespace App\Service\Catalog\Product;

use App\Api\Data\Catalog\ProductProcessorInterface;
use App\Api\Data\ProcessorPoolInterface;

class ProductProcessorPool implements ProcessorPoolInterface
{
    private $parserDi;

    public function __construct(ParserDi $parserDi)
    {
        $this->parserDi = $parserDi;
    }

    /**
     * @return ProductProcessorInterface[]
     */
    public function getProcessors(): array
    {
        return $this->parserDi->matchProcessors();
    }
}