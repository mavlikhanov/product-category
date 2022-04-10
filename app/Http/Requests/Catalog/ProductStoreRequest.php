<?php
declare(strict_types=1);

namespace App\Http\Requests\Catalog;

use App\Api\Data\ProductInterface;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ProductInterface::TITLE        => 'required|max:255',
            ProductInterface::PRICE        => 'required',
            ProductInterface::CATEGORY_IDS => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            ProductInterface::TITLE  => __('product.' . ProductInterface::TITLE),
            ProductInterface::PRICE  => __('product.' . ProductInterface::PRICE),
        ];
    }
}
