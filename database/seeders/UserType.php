<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userTypes = ["Admin","Cliente","Vendedor"];

        foreach ($userTypes as $value){

            DB::table('user_type')->insert([
                [
                    'name' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ], // 1
            ]);
        }
    }
}
