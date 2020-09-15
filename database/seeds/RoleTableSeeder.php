<?php

use Illuminate\Database\Seeder;
use App\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::all();
        $slugs ='';
        $all_permission = '{';
        foreach($permission as $per){
            $slugs .= '"'.$per->slug.'":true,';
        }
        $trimval = rtrim($slugs,',');
        $all_permission .= $trimval.'}';
        $roles = [
            [
                'name'          => 'Admin',
                'slug'          => 'admin',
                'permissions'   => $all_permission,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Doctor',
                'slug'          => 'doctor',
                'permissions'   => '{"notifacation":true,"activities":true,"product-management":true,"product-edit":true,"product-show":true,"product-create":true,"product-index":true,"tax-destroy":true,"tax-edit":true,"tax-show":true,"tax-create":true,"tax-index":true,"unit-destroy":true,"unit-edit":true,"unit-show":true,"unit-create":true,"unit-index":true,"type-destroy":true,"type-edit":true,"type-show":true,"type-create":true,"type-index":true,"category-destroy":true,"category-edit":true,"category-show":true,"category-create":true,"category-index":true,"customer-create":true,"sale-management":true,"saleReturn-destroy":true,"saleReturn-show":true,"saleReturn-index":true,"sale-show":true,"sale-create":true,"report-management":true,"report-today":true,"report-sale":true,"stock-management":true,"stock-low":true,"stock-batch":true,"stock-closing":true,"stock-expiry":true}',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];
        DB::table('roles')->insert($roles);
    }
}
