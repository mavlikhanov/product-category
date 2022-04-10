<?php
declare(strict_types=1);

namespace App\Api\Data\Catalog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

interface ProductProcessorInterface
{
    public function setRequest(Request $request);
    public function setActionName(string $actionName);
    public function canProcess(): bool;
    public function process(): JsonResource;
    public function setId(int $id);
}