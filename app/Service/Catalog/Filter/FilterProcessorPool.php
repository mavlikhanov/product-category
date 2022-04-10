<?php
declare(strict_types=1);

namespace App\Service\Catalog\Filter;

use App\Api\Data\Catalog\FilterProcessorInterface;
use App\Api\Data\ProcessorPoolInterface;

class FilterProcessorPool implements ProcessorPoolInterface
{
    private $parserDi;

    public function __construct(ParserDi $parserDi)
    {
        $this->parserDi = $parserDi;
    }

    /**
     * @return FilterProcessorInterface[]
     */
    public function getProcessors(): array
    {
        return $this->parserDi->matchProcessors();
    }
}