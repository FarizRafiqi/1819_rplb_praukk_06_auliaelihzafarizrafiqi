<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Level;
use Illuminate\Database\Seeder;

/**
 * Seeder ini digunakan untuk mendefinisikan hak akses/permissions 
 * apa saja yang dimiliki oleh users
 */
class PermissionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();
        Level::findOrFail(1)->permissions()->sync($adminPermissions->pluck('id'));
        $bankPermissions = $adminPermissions->filter(function($permission){
            return substr($permission->title, 0, 5) != 'user_'              && 
                   substr($permission->title, 0, 6) != 'usage_'             &&
                   substr($permission->title, 0, 5) != 'bill_'              && 
                   substr($permission->title, 0, 13) != 'pln_customer_'     && 
                   substr($permission->title, 0, 6) != 'level_'             && 
                   substr($permission->title, 0, 11) != 'permission_'       && 
                   substr($permission->title, 0, 7) != 'tariff_'            &&        
                   substr($permission->title, 0, 15) != 'payment_method_'   &&      
                   substr($permission->title, 0, 4) != 'tax_'               &&      
                   substr($permission->title, 0, 13) != 'activity_log_';          
        });
        Level::findOrFail(3)->permissions()->sync($bankPermissions);
    }
}
