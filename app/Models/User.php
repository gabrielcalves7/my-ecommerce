<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    private UploadableModelServiceProvider $uploadableModel;

    public function __construct()
    {
        $this->uploadableModel = new UploadableModelServiceProvider();
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

    public function uploadableModel()
    {
        return $this->uploadableModel;
    }

    protected $fillable = [
        'name',
        'email',
        'user_type_id',
        'password',
        'document',
        'birthDate'
    ];

    public function createForm(): array
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
                "selected" => isset($this->user_type_id) ? $this->user_type_id : "",
            ],
            [
                "name" => "mainPhone",
                "type" => "tel",
                "label" => "phoneNumber"
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
            'birthDate' => 'required',
            'image' => 'mimes:jpg,jpeg,png,bmp|max:20000'
        ];

        $v_EditRules = [
            'id' => 'required|exists:user,id',
        ];

        if ($id == null) {
            return $v_CreateRules;
        }

        return array_merge($v_EditRules, $v_CreateRules);
    }

    public static function getAll(): Builder
    {
        return self::join('user_type', 'user.user_type_id', '=', 'user_type.id')
            ->leftJoin('phone', function ($join) {
                $join->on('user.id', '=', 'phone.user_id')
                    ->where('phone.main', '=', true);
            })
            ->select('user_type.name as userType', 'user.*', 'phone.number as phoneNumber');
    }

    public function getFieldsForFormattedList(): array
    {
        return [
            "tables" => [
                'user' => [
                    "name",
                    "email",
                    "userType",
                    "birthDate",
                    "document",
                ],
                'phone' => [
                    "phoneNumber"
                ]
            ],
        ];
    }
}
