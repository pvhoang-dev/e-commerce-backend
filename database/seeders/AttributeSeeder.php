<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Color',
                'code' => 'color'
            ],
            [
                'name' => 'Storage',
                'code' => 'storage'
            ],
            [
                'name' => 'Size',
                'code' => 'size'
            ],
            [
                'name' => 'Type',
                'code' => 'type'
            ],
        ];

        Attribute::insert($attributes);
    }
}
