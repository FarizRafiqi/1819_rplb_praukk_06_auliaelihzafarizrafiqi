<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
/**
 * Seeder ini digunakan untuk membuat macam-macam hak akses 
 * yang dibutuhkan oleh users
 */
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['title' => 'user_management_access'],
            ['title' => 'user_access'],
            ['title' => 'user_create'],
            ['title' => 'user_update'],
            ['title' => 'user_delete'],
            ['title' => 'user_edit'],
            ['title' => 'user_show'],
            ['title' => 'usage_access'],
            ['title' => 'usage_create'],
            ['title' => 'usage_update'],
            ['title' => 'usage_delete'],
            ['title' => 'usage_edit'],
            ['title' => 'usage_show'],
            ['title' => 'payment_access'],
            ['title' => 'payment_update'],
            ['title' => 'payment_edit'],
            ['title' => 'payment_show'],
            ['title' => 'bill_access'],
            ['title' => 'pln_customer_access'],
            ['title' => 'pln_customer_create'],
            ['title' => 'pln_customer_update'],
            ['title' => 'pln_customer_delete'],
            ['title' => 'pln_customer_edit'],
            ['title' => 'pln_customer_show'],
            ['title' => 'level_access'],
            ['title' => 'level_create'],
            ['title' => 'level_update'],
            ['title' => 'level_delete'],
            ['title' => 'level_edit'],
            ['title' => 'tariff_access'],
            ['title' => 'tariff_create'],
            ['title' => 'tariff_update'],
            ['title' => 'tariff_delete'],
            ['title' => 'tariff_edit'],
            ['title' => 'permission_access'],
            ['title' => 'permission_create'],
            ['title' => 'permission_update'],
            ['title' => 'permission_delete'],
            ['title' => 'permission_edit'],
            ['title' => 'activity_log_access'],
            ['title' => 'report_create'],
        ];

        Permission::insert($permissions);
    }
}
