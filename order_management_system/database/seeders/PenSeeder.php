<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pens = [
          [ 'name' => '黒ボールペン','price'=>201 ],
          [ 'name' => '赤ボールペン','price'=>202 ],
          [ 'name' => '青ボールペン','price'=>203 ],
          [ 'name' => '緑ボールペン','price'=>204 ],
          [ 'name' => '紫ボールペン','price'=>205 ],
          [ 'name' => '黒シャープペン','price'=>206 ],
          [ 'name' => '赤シャープペン','price'=>207 ],
          [ 'name' => '青シャープペン','price'=>208 ],
          [ 'name' => '緑シャープペン','price'=>209 ],
          [ 'name' => '紫シャープペン','price'=>210 ],
        ];

        foreach ($pens as $pen) {
          DB::table('pens')->insert([
            'name' => $pen['name'],
            'price' => $pen['price'],
            'created_at' => now(),
            'updated_at' => now()
          ]);
        }
    }
}
