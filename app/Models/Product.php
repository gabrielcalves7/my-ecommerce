<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "category",
        "description",
        "image",
    ];

    public function getRules($id = null): array
    {
        $v_CreateRules = [
            'name' => 'required|min:3|max:191',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required',
        ];

        $v_EditRules = [
            'id' => 'required|exists:product,id',
        ];

        if ($id == null) {
            return $v_CreateRules;
        }

        return array_merge($v_EditRules, $v_CreateRules);
    }

    protected $table = 'product';

    public static function getAll()
    {
        return self::join('product_category', 'product.category', '=', 'product_category.id')
            ->select('product_category.name as category_name', 'product.*');
    }


    public function updateOrCreate($data)
    {
        try {
            return (bool)self::query()->updateOrCreate(['id' => $data['id'] ?? null], $data);
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
