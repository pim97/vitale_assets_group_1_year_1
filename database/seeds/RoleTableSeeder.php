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

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Een admin gebruikers rol.';
        $role_admin->save();

        $role_employee = new Role();
        $role_employee->name = 'employee';
        $role_employee->description = 'Een gebruikers rol voor de medewerkers.';
        $role_employee->save();

        $role_student = new Role();
        $role_student->name = 'student';
        $role_student->description = 'Een gebruikers rol voor de studenten.';
        $role_student->save();
    }
}
