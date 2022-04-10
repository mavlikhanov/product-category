<?php
declare(strict_types=1);

namespace App\Api\Data;

interface ProductInterface
{
    const ID           = 'id';
    const TITLE        = 'title';
    const DESCRIPTION  = 'description';
    const PRICE        = 'price';
    const IS_PUBLISHED = 'is_published';
    const CATEGORY_IDS = 'category_ids';
    const CATEGORIES   = 'categories';
}