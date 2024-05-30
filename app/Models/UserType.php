<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserType extends Model
{
    use HasFactory;

    protected $table = "user_type";

    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->user_type_id == 1;
    }

    public static function getAll()
    {
        return self::all()->pluck('name', 'id');
    }
}
