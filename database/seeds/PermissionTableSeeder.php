<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [];
        foreach (\Route::getRoutes() as $route) {
            $name = $route->getName();
            if (preg_match('/^v1\..+\.(\w+)$/', $name, $match)) {
                $routes[$match[1]][] = $match[0];
            }
        }
        $routes = collect($routes);
        $routes->flatten()
            ->map(function ($permission) {
                $permission = ['name' => $permission];
                Permission::create($permission);
            });

        /**
         * @var Role $guest
         * @var Role $admin
         * @var Role $user
         * @var Role $business
         */
        $guest = Role::create(['name' => 'guest']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $business = Role::create(['name' => 'business']);

        $guest->givePermissionTo(
            $routes->only('index', 'show', 'login')
                ->flatten()
        );
        $admin->givePermissionTo($routes->flatten());

//        $business->givePermissionTo([
//            'admin.home',
//
//            'admin.seller.pricing.index',
//            'admin.seller.pricing.create',
//            'admin.seller.pricing.show',
//            'admin.seller.pricing.edit',
//
//            'admin.cart.order.index',
//            'admin.cart.order.edit',
//        ]);

        $users = User::all();

        $users->find(1)->assignRole('guest');
        $users->find(2)->assignRole('admin');
//        $users->find(2)->assignRole(['seller', 'writer']);
    }
}
