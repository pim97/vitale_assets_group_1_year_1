<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Avatar;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_employee = Role::where('name', 'employee')->first();
        $role_student = Role::where('name', 'student')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@hz.nl';
        $admin->password = bcrypt('123');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $avatar = new Avatar;
        $avatar->image_url = "default.png";
        $avatar->active = true;
        $avatar->user_id = $admin->id;
        $avatar->save();

        $employee = new User();
        $employee->name = 'Teun';
        $employee->email = 'teun@hz.nl';
        $employee->password = bcrypt('s3cr3t');
        $employee->save();
        $employee->roles()->attach($role_employee);

        $avatar = new Avatar;
        $avatar->image_url = "default.png";
        $avatar->active = true;
        $avatar->user_id = $employee->id;
        $avatar->save();

        $employee = new User();
        $employee->name = 'Andreas';
        $employee->email = 'andreas.burzel@deltares.nl';
        $employee->password = bcrypt('andreas123!');
        $employee->save();
        $employee->roles()->attach($role_employee);

        $student = new User();
        $student->name = 'Rachelle';
        $student->email = 'zwar0021@hz.nl';
        $student->password = bcrypt('s3cr3t');
        $student->save();
        $student->roles()->attach($role_student);

        $avatar = new Avatar;
        $avatar->image_url = "default.png";
        $avatar->active = true;
        $avatar->user_id = $student->id;
        $avatar->save();
    }
}
