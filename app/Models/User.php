<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Models implements Authenticatable
{
    use HasApiTokens, Notifiable;
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

    public static function getAll(): Builder
    {
        return self::join('user_type', 'user.user_type_id', '=', 'user_type.id')
            ->leftJoin('phone', function ($join) {
                $join->on('user.id', '=', 'phone.user_id')
                    ->where('phone.main', '=', true);
            })
            ->select('user_type.name as userType', 'user.*', 'phone.number as phoneNumber');
    }

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the unique broadcast identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifierForBroadcasting()
    {
        return $this->getAuthIdentifier();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        if (! empty($this->getRememberTokenName())) {
            return (string) $this->{$this->getRememberTokenName()};
        }
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        if (! empty($this->getRememberTokenName())) {
            $this->{$this->getRememberTokenName()} = $value;
        }
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }
}
