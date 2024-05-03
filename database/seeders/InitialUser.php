<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'user_type_id' => 1,
            'name' => "Admin Geral",
            'email' => 'contato@gafit.com.br',
            'document' => '123',
            'birthDate' => '1997-05-05',
            'password' => Hash::make('testing'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
