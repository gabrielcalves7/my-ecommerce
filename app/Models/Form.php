<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Form {

    private array $fields;

    public function __construct($fields) {
        $this->fields = $fields;
    }


    public function getForm() {
        $fields = $this->fields;

    }

    public function createField($data)
    {
    }
    public function returnada(int $int): int
    {
        return $int;
    }

}
