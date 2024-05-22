<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Models
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        "name",
        "price",
        "category",
        "description",
        "image",
        "sku"
    ];

    public function getRules($id = null): array
    {
        $v_CreateRules = [
            'name' => 'required|min:3|max:191',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'image'
        ];

        $v_EditRules = [
            'id' => 'required|exists:product,id',
        ];

        if ($id == null) {
            return $v_CreateRules;
        }

        return array_merge($v_EditRules, $v_CreateRules);
    }

    public function createForm(): array
    {
        return [
            [
                "name" => "name",
                "type" => "text",
                "label" => "name"
            ],
            [
                "name" => "price",
                "type" => "text",
                "label" => "price"
            ],
            [
                "name" => "description",
                "type" => "text",
                "label" => "description"
            ],
            [
                "name" => "sku",
                "type" => "text",
                "label" => "sku"
            ],
            [
                "name" => "category",
                "type" => "select",
                "label" => "category",
                "options" => ProductCategory::getAll(),
                "selected" => isset($this->category) ? $this->category : "",
            ],
            [
                "name" => "image",
                "type" => "image",
                "label" => "image"
            ],
        ];
    }

    public static function getAll(): Builder|Collection
    {
        return self::join('product_category', 'product.category', '=', 'product_category.id')
            ->select('product_category.name as category_name', 'product.*');
    }

    public function getFieldsForFormattedList(): array
    {
        return [
            "tables" => [
                'product' => [
                    "image",
                    "name",
                    "price",
                    "sku",
                    "description",
                ],
                'product_category' => [
                    "category_name",
                ]
            ],
            "non-tables" => ['actions']
        ];
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }


}
