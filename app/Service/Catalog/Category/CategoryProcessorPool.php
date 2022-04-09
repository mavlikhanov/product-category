<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category;

use App\Api\Data\Catalog\CategoryProcessorInterface;

class CategoryProcessorPool
{
    private $parserDi;

    public function __construct(ParserDi $parserDi)
    {
        $this->parserDi = $parserDi;
    }

    /**
     * @return CategoryProcessorInterface[]
     */
    public function getProcessors(): array
    {
        return $this->parserDi->matchProcessors();
    }
}