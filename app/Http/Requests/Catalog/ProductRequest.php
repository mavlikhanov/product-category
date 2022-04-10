<?php
declare(strict_types=1);

namespace App\Http\Requests\Catalog;

use App\Api\Data\ProductInterface;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            ProductInterface::TITLE => 'max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            ProductInterface::TITLE  => __('product.' . ProductInterface::TITLE),
        ];
    }
}
