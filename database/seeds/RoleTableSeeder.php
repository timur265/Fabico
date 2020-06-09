<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $simple_role = new Role();
        $simple_role->name = 'simple_user';
        $simple_role->description = 'Обычный пользователь';
        $simple_role->save();

        $admin_role = new Role();
        $admin_role->name = 'admin';
        $admin_role->description = 'Администратор';
        $admin_role->save();
    }
}
