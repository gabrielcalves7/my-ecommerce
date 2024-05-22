<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Models extends Authenticatable
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
                ->first()
            ;
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
}