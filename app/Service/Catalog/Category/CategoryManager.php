<?php
declare(strict_types=1);

namespace App\Service\Catalog\Category;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryManager
{
    private $categoryProcessorPool;
    private $actionName;
    private $request;
    private $id;

    public function __construct(CategoryProcessorPool $categoryProcessorPool)
    {
        $this->categoryProcessorPool = $categoryProcessorPool;
    }

    public function setActionName(string $actionName): CategoryManager
    {
        $this->actionName = $actionName;
        return $this;
    }

    public function setRequest(Request $request): CategoryManager
    {
        $this->request = $request;
        return $this;
    }

    public function setEntityId(int $id): CategoryManager
    {
        $this->id = $id;
        return $this;
    }

    public function manage(): JsonResource
    {
        try {
            $data = $this->process();
        } catch (ModelNotFoundException $exception) {
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], 404));
        }
        catch (\Exception $exception) {
            throw new HttpResponseException(response()->json(['message' => $exception->getMessage()], 422));
        }
        if (!$data) {
            throw new HttpResponseException(response()->json(['message' => 'Error with passed data'], 422));
        }
        return $data;
    }

    private function process(): ?JsonResource
    {
        foreach ($this->categoryProcessorPool->getProcessors() as $processor) {
            $processor->setActionName($this->actionName);
            if ($this->request) {
                $processor->setRequest($this->request);
            }
            if ($this->id) {
                $processor->setId($this->id);
            }
            if ($processor->canProcess()) {
                return $processor->process();
            }
        }
        return null;
    }
}