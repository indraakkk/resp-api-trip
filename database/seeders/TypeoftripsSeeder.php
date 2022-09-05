<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Typeoftrip;
use File;

class TypeoftripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typeoftrip::truncate();

        $json = File::get('database/typeoftrip.json');
        $types = json_decode($json, true);

        $data = [];
        foreach ($types as $key => $value) {
            $value['type'] = strtolower($value['type']);
            $value['slug'] = str_slug($value['type'], '-');
            $value['category'] = strtolower($value['category']);
            $value['created_at'] = now();
            $value['updated_at'] = now();
            $data[$key] = $value;
        }
        Typeoftrip::insert($data);
    }
}
