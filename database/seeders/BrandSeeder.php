<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Apple', 'slug' => 'apple', 'file_id' => null]);
        Brand::create(['name' => 'Samsung', 'slug' => 'samsung', 'file_id' => null]);
        Brand::create(['name' => 'Xiaomi', 'slug' => 'xiaomi', 'file_id' => null]);
        Brand::create(['name' => 'OPPO', 'slug' => 'oppo', 'file_id' => null]);
        Brand::create(['name' => 'realme', 'slug' => 'realme', 'file_id' => null]);
        Brand::create(['name' => 'vivo', 'slug' => 'vivo', 'file_id' => null]);
        Brand::create(['name' => 'ASUS', 'slug' => 'asus', 'file_id' => null]);
        Brand::create(['name' => 'Nokia', 'slug' => 'nokia', 'file_id' => null]);
        Brand::create(['name' => 'Lenovo', 'slug' => 'lenovo', 'file_id' => null]);
        Brand::create(['name' => 'Dell', 'slug' => 'dell', 'file_id' => null]);
        Brand::create(['name' => 'Acer', 'slug' => 'acer', 'file_id' => null]);
        Brand::create(['name' => 'LG', 'slug' => 'lg', 'file_id' => null]);
        Brand::create(['name' => 'Huawei', 'slug' => 'huawei', 'file_id' => null]);
        Brand::create(['name' => 'MSI', 'slug' => 'msi', 'file_id' => null]);
        Brand::create(['name' => 'HP', 'slug' => 'hp', 'file_id' => null]);
        Brand::create(['name' => 'JBL', 'slug' => 'jbl', 'file_id' => null]);
        Brand::create(['name' => 'Sony', 'slug' => 'SONY', 'file_id' => null]);
        Brand::create(['name' => 'Marshall', 'slug' => 'marshall', 'file_id' => null]);
        Brand::create(['name' => 'Garmin', 'slug' => 'garmin', 'file_id' => null]);
        Brand::create(['name' => 'Amafit', 'slug' => 'amafit', 'file_id' => null]);
    }
}
