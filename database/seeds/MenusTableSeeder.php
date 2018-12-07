<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
        	['nama' => 'Pecel Lele', 'jenis' => 'Makanan', 'harga' => '10000', 'stock' => '10'],
        	['nama' => 'Ayam Geprek', 'jenis' => 'Makanan', 'harga' => '10000', 'stock' => '10'],
        	['nama' => 'Tahu Masak', 'jenis' => 'Makanan', 'harga' => '10000', 'stock' => '10'],
        	['nama' => 'Nasi Goreng', 'jenis' => 'Makanan', 'harga' => '10000', 'stock' => '3'],
        	['nama' => 'Nasi Ayam', 'jenis' => 'Makanan', 'harga' => '10000', 'stock' => '0'],
        	['nama' => 'Es Teh', 'jenis' => 'Minuman', 'harga' => '2000', 'stock' => '10'],
        	['nama' => 'Es Jeruk', 'jenis' => 'Minuman', 'harga' => '2500', 'stock' => '10'],
        	['nama' => 'Air Putih', 'jenis' => 'Minuman', 'harga' => '1000', 'stock' => '10']
        ];

        foreach ($menus as $menu) {
        	DB::table('menus')->insert($menu);
        }
    }
}
