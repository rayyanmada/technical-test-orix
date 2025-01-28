<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'inventory-list',
            'inventory-create',
            'inventory-edit',
            'inventory-delete',
            'menu-list',
            'menu-create',
            'menu-edit',
            'menu-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'invoice-list',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
            'peminjaman-list',
            'peminjaman-create',
            'peminjaman-edit',
            'peminjaman-delete',
            'pengembalian-list',
            'pengembalian-create',
            'pengembalian-edit',
            'pengembalian-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
