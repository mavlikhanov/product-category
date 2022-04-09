<?php
declare(strict_types=1);

namespace App\Http\Requests\Catalog;

use App\Api\Data\CategoryInterface;
use App\Http\Requests\Request;

class CategoryRequest extends Request
{
    public function rules(): array
    {
        return [
            CategoryInterface::TITLE => 'max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            CategoryInterface::TITLE  => __('catalog.' . CategoryInterface::TITLE),
        ];
    }
}
