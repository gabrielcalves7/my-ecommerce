<?php

namespace Database\Seeders;

use App\Models\Address;

use App\Models\Phone;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Factory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Phone::factory(150)->create();
        Address::factory(10)->create();
        User::factory(10)->create();
        ProductCategory::factory(10)->create();
        Product::factory(150)->create();
    }
}
