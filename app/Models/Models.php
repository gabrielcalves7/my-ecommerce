<?php

namespace App\Models;

use App\Helpers\Helper;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Models extends Model
{

    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    ];


    public function getFillable()
    {
        return $this->fillable;
    }

    public function unfilterableFields(): array
    {
        return ["image", "actions"];
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

    public function deleteField($field, $fieldValue)
    {
        try {
            $field = self::query()
                ->where($field, $fieldValue)
                ->where('deleted', '!=', true)
                ->first();
            if ($field) {
                $field->update(['deleted' => true]);
                return [
                    "success" => true,
                    "message" => [
                        "type" => "system-message",
                        "content" => "Data deleted successfully."
                    ]
                ];
            }
            return [
                "success" => false,
                "message" => [
                    "type" => "system-message",
                    "content" => "There was an error deleting your data.",
                    "error" => "We couldn't find this item in our system."
                ]
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                "success" => false,
                "message" => [
                    "type" => "exception",
                    "content" => $e->getMessage()
                ]
            ];
        }
    }

    public static function getAll(): Builder|Collection
    {
        return self::all();
    }

    public static function getAllOrderedBy(Builder|Collection $query, $orderBy, bool $orderAsc): Collection
    {
        return $query->orderBy($orderBy, $orderAsc ? 'asc' : 'desc');
    }

    public function searchModel(Builder|Collection $query, $field, $value): Builder|Collection
    {
        return $query->where($this->getTableAndFieldName($field), 'like', '%' . $value . '%');
    }

    public function orderModel($query, $orderBy, $orderAsc): Builder|Collection
    {
        return $query->orderBy($orderBy, $orderAsc ? 'asc' : 'desc');
    }

    public function handlePaginatedListsFilters($query, $queryParams)
    {
        $orderParams = self::removeOrderParamsFromQueryParams($queryParams);

        $orderBy = $orderParams['order'];
        $orderAsc = $orderParams['asc'];
        if ($orderBy && $orderAsc) {
            $query = $this->orderModel($query, $orderBy, $orderAsc);
        }
        if ($queryParams) {
            foreach ($queryParams as $key => $value) {
                $query = $this->searchModel($query, $key, $value);
            }
        }
        return $query;
    }

    public static function getAllLike($field, $value)
    {
        return self::getAllOrderedBy();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public static function removeOrderParamsFromQueryParams(&$queryParams): array
    {
        $keysToDelete = ['order', 'asc'];

        $storedValues = [];

        foreach ($keysToDelete as $value) {
            $storedValues[$value] = $queryParams[$value] ?? null;
        }

        unset($queryParams['order']);
        unset($queryParams['asc']);

        return $storedValues;
    }

    public function getFieldsForFormattedList(): array
    {
        return [

        ];
    }

    public function getRelatedTableBasedOnField(string $field): string
    {
        return Helper::findKeyByValue($this->getFieldsForFormattedList(), $field);
    }

    public function getTableAndFieldName(string $field)
    {
        $table = $this->getRelatedTableBasedOnField($field);
        return "$table." . $this->translateNames($field);
    }

    public function translateNames($name)
    {
        return match ($name) {
            "category_name" => 'name',
            default => $name,
        };
    }
}