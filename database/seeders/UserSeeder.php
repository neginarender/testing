<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        do {
            $isDeleteUsers = strtolower($this->command->ask('Delete all users before continue (Yes/No)??', 'No'));
            if($isDeleteUsers=='yes') User::query()->truncate();
        } while ($isDeleteUsers!='yes' && $isDeleteUsers!='no');

        $this->createAdmin();
        $count = (int)$this->command->ask('How many managers do you need ?', 10);
        if($count){
            $this->command->info("Creating managers.");
            $role = Role::where('name','manager')->first();
            $manager =  User::factory()->count($count)->create();
            $manager->each(function($user) use ($role) {
                $user->assignRole($role->id);
            });
            $this->command->info('Manager Created!');
        }

        $count = (int)$this->command->ask('How many users do you need ?', 100);
        if($count){
            $role = Role::where('name','user')->first();
            $this->command->info("Creating users.");
            $users =  User::factory()->count($count)->create();
            $users->each(function($user) use ($role) {
                $user->assignRole($role->id);
            });
            $this->command->info('Users Created!');
        }
        $this->command->info('Finished Admin, Managers and Users creation!');
    }
    public function createAdmin()
    {
        $role = Role::where('name','admin')->first();
        do {
            $total = User::whereHas("roles", function($q) use($role) {
                                    $q->whereIn("id", [$role->id]);
                                })->count();
            $count = (int)$this->command->ask('How many admins do you want to add?', 1);
        } while (!$total && !$count);

        if($count){
            for (; $count > 0 ; $count--) {
                $this->command->info('Enter New Admin Details!');
                $name = $this->command->ask('Enter name for admin ?', 'admin');
                do {
                    $email = $this->command->ask('Enter email for admin ?', 'admin@'. config('app.name') . '.com');
                    $admin = User::where('email',$email)->first();
                    if($admin) $this->command->info("Duplicate email. To update please change from browser");
                } while ($admin);

                $password = $this->command->ask('Enter password for admin ?', 'admin');
                $this->command->info("Creating Admin.");
                $admin =  User::firstOrCreate(['name' => $name, 'email' => $email, 'password' => Hash::make($password),'email_verified_at'=>now()]);
                $admin->assignRole($role->id);
                $this->command->info('Admin Created!');
            }
        }        
    }
}
