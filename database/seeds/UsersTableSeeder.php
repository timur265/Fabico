<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'admin')->first();
        $simple_role = Role::where('name', 'simple_user')->first();

        $admin = User::create([
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret')
        ]);
        $admin->roles()->attach($admin_role);
        $simple = User::create([
            'name' => 'Иван Иванов',
            'email' => 'vanya@example.com',
            'password' => bcrypt('12345')
        ]);
        $simple->roles()->attach($simple_role);
    }
}
