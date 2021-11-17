<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $noNeedPermission = [
            'welcome',
            'verification.resend',
            'verification.notice',
            'verification.verify',
            'home',
            'login',
            'logout',
            'password.confirm',
            'password.email',
            'password.request',
            'password.update',
            'password.reset',
            'register',
            'profile.show',
            'profile.edit',
            'profile.save',
            'profile.delete',
        ];
        $managerPermission = [
            'users.index'
        ];
        $adminRole = Role::firstOrCreate(['name' => User::ROLE_ADMIN]);        

        $manager = strtolower($this->command->ask('Enter role name for manager?', 'manager'));
        $manager = $manager ? $manager : 'manager';
        $managerRole = Role::firstOrCreate(['name' => $manager]);
        $user = strtolower($this->command->ask('Enter role name for user?', 'user'));
        $user = $user ? $user : 'user';
        $userRole = Role::firstOrCreate(['name' => $user]);        
        
        $routes = Route::getRoutes()->getRoutes();
        foreach ($routes as $route) {
            $newPermission = $route->getName();
            if ( !in_array($newPermission, $noNeedPermission)  &&  $newPermission != '' && $route->getAction()['middleware']['0'] == 'web') {
                $permission = Permission::firstOrCreate(['name' => $newPermission]);
                $adminRole->givePermissionTo($newPermission);
                if(in_array($newPermission, $managerPermission)){
                    $managerRole->givePermissionTo($newPermission);
                }
            }
        }
    }
}