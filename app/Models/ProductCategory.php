<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Models
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category');
    }

    public function getRules($id = null): array
    {
        $v_CreateRules = [
            'name' => 'required|min:3|max:191',
        ];

        $v_EditRules = [
            'id' => 'required|exists:product,id',
        ];

        if ($id == null) {
            return $v_CreateRules;
        }

        return array_merge($v_EditRules, $v_CreateRules);
    }

    public static function getAll(): Builder|Collection
    {
        return self::withCount('products');
    }

    public function getFieldsForFormattedList(): array
    {
        return [
            "tables" => [
                'category' => [
                    "name",
                    "products_count",
                ],
            ],
            "non-tables" => ['actions']
        ];
    }

    public function createForm(): array
    {
        return [
            [
                "name" => "name",
                "type" => "text",
                "label" => "name"
            ],
        ];
    }
}
