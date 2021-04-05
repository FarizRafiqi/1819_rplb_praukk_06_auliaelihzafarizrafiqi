<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

/**
 * Seeder ini digunakan untuk menginisialisasi 
 * hak akses tiap level user
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
            // User Management
            ['title' => 'user_management_access'],
            ['title' => 'user_access'],
            ['title' => 'user_create'],
            ['title' => 'user_update'],
            ['title' => 'user_delete'],
            ['title' => 'user_edit'],
            ['title' => 'user_show'],

            //Usage Management
            ['title' => 'usage_access'],
            ['title' => 'usage_create'],
            ['title' => 'usage_update'],
            ['title' => 'usage_delete'],
            ['title' => 'usage_edit'],
            ['title' => 'usage_show'],

            //Payment Management
            ['title' => 'payment_access'],
            ['title' => 'payment_update'],
            ['title' => 'payment_edit'],
            ['title' => 'payment_show'],

            //Bill Management
            ['title' => 'bill_access'],

            //PLN Customer Management
            ['title' => 'pln_customer_access'],
            ['title' => 'pln_customer_create'],
            ['title' => 'pln_customer_update'],
            ['title' => 'pln_customer_delete'],
            ['title' => 'pln_customer_edit'],
            ['title' => 'pln_customer_show'],

            // Level Management
            ['title' => 'level_access'],
            ['title' => 'level_create'],
            ['title' => 'level_update'],
            ['title' => 'level_delete'],
            ['title' => 'level_edit'],

            // Tariff Management
            ['title' => 'tariff_access'],
            ['title' => 'tariff_create'],
            ['title' => 'tariff_update'],
            ['title' => 'tariff_delete'],
            ['title' => 'tariff_edit'],

            // Permission Management
            ['title' => 'permission_access'],
            ['title' => 'permission_create'],
            ['title' => 'permission_update'],
            ['title' => 'permission_delete'],
            ['title' => 'permission_edit'],

            // Level Permission Management
            ['title' => 'level_permission_access'],
            ['title' => 'level_permission_create'],
            ['title' => 'level_permission_update'],
            ['title' => 'level_permission_delete'],
            ['title' => 'level_permission_edit'],

            // Activity Log Management
            ['title' => 'activity_log_access'],

            // Report Management
            ['title' => 'report_create'],

            // Transaction Management
            ['title' => 'transaction_access'],
            ['title' => 'payment_method_access'],
            ['title' => 'payment_method_create'],
            ['title' => 'payment_method_update'],
            ['title' => 'payment_method_delete'],
            ['title' => 'payment_method_edit'],
            ['title' => 'payment_method_show'],

            // Tax Management
            ['title' => 'tax_access'],
            ['title' => 'tax_type_access'],
            ['title' => 'tax_type_create'],
            ['title' => 'tax_type_update'],
            ['title' => 'tax_type_delete'],
            ['title' => 'tax_type_edit'],
            ['title' => 'tax_rate_access'],
            ['title' => 'tax_rate_create'],
            ['title' => 'tax_rate_update'],
            ['title' => 'tax_rate_delete'],
            ['title' => 'tax_rate_edit'],
        ];

        Permission::insert($permissions);
    }
}
