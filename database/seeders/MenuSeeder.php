<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama'  => 'Kelola Role',
                'icon'  => 'bi bi-box-fill',
                'url' => '/roles',
                'akses' => 'role-list',
                'submenu' => '',
                'urutan' => 2
            ],
            [
                'nama'  => 'Kelola User',
                'icon'  => 'bi bi-file-person-fill',
                'url' => '/users',
                'akses' => 'user-list',
                'submenu' => '',
                'urutan' => 3
            ],
            [
                'nama'  => 'Kelola Menu',
                'icon'  => 'bi bi-file-earmark-font-fill',
                'url' => '/menu',
                'akses' => 'menu-list',
                'submenu' => '',
                'urutan' => 4
            ],
            [
                'nama'  => 'Kelola Submenu',
                'icon'  => 'bi bi-folder-fill',
                'url' => '/submenu',
                'akses' => 'menu-list',
                'submenu' => '',
                'urutan' => 5
            ],
            [
                'nama'  => 'Kelola Produk',
                'icon'  => 'fas fa-chart-pie',
                'url' => 'product-list',
                'akses' => '/products',
                'submenu' => '',
                'urutan' => 6
            ],
        ];
        foreach ($data as $d) {
            DB::table('menu')->insert($d);
        }
    }
}
