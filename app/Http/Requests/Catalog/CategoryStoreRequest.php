<?php

namespace App\Http\Requests\Catalog;

use App\Api\Data\CategoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            CategoryInterface::TITLE => 'required|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            CategoryInterface::TITLE  => __('catalog.' . CategoryInterface::TITLE),
        ];
    }
}
