<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    private UploadableModelServiceProvider $uploadableModel;
    protected $table = 'product';
    protected $fillable = [
        "name",
        "price",
        "category",
        "description",
        "sku"
    ];

    public function __construct()
    {
        $this->uploadableModel = new UploadableModelServiceProvider();
    }

    public function uploadableModel()
    {
        return $this->uploadableModel;
    }

    public function AmazonS3Driver()
    {
        return $this->morphMany(
            AmazonS3Driver::class,
            'related',
            'related_table',
            'related_table_id'
        );
    }

    public function image()
    {
        $upload = $this->AmazonS3Driver()
            ->where('main', true)
            ->where('deleted', false)
            ->select('url');
        return $upload;
    }

    public function getRules($id = null): array
    {
        $v_CreateRules = [
            'name' => 'required|min:3|max:191',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'image' => 'mimes:jpg,jpeg,png,bmp|max:20000'
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
                "options" => ProductCategory::getAll()->pluck('name', 'id'),
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
