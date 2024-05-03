<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type_id',
        'password',
        'document',
        'birthDate'
    ];

    public function createForm(User $user = null): array
    {
        $fields = [
            [
                "name" => "name",
                "type" => "text",
                "label" => "name"
            ],
            [
                "name" => "email",
                "type" => "email",
                "label" => "email"
            ],
            [
                "name" => "birthDate",
                "type" => "date",
                "label" => "birthDate"
            ],
            [
                "name" => "user_type_id",
                "type" => "select",
                "label" => "userType",
                "options" => UserType::getAll(),
                "selected" => $user ? $user->user_type_id : "",
            ],
            [
                "name" => "password",
                "type" => "password",
                "label" => "password"
            ],
            [
                "name" => "document",
                "type" => "tel",
                "label" => "document"
            ],
        ];
        return $fields;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    protected $table = 'user';

    public function phone()
    {
        return $this->hasMany(Phone::class);
    }

    public function mainPhone()
    {
        return $this->hasOne(Phone::class)->where('main', '1')->select('number');
    }

    public function getRules($id = null): array
    {
        $v_CreateRules = [
            'name' => 'required|min:3|max:191',
            'email' => 'required',
            'password' => 'required|min:6',
            'user_type_id' => 'required|numeric',
            'document' => 'required',
            'birthDate' => 'required'
        ];

        $v_EditRules = [
            'id' => 'required|exists:user,id',
        ];

        if ($id == null) {
            return $v_CreateRules;
        }

        return array_merge($v_EditRules, $v_CreateRules);
    }

    public static function getAll()
    {
        return self::join('user_type', 'user.user_type_id', '=', 'user_type.id')
            ->select('user_type.name as user_type', 'user.*');
    }

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
}
