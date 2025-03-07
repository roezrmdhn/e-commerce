<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = [
            ['name' => 'Warna', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ukuran', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bahan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('variants')->insert($variants);
    }
}
