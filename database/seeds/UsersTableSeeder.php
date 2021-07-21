<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Card;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->delete();
        // DB::table('role_user')->truncate();

        $adminRole =Role::where('name', 'admin')->first();
        $staffRole =Role::where('name', 'staff')->first();
        $studentRole =Role::where('name', 'student')->first();

        $admin = User:: create([
            'name' =>'Admin User',
            'email'=> 'admin@admin.com',
            'password' =>Hash::make('adminadmin'),
            'code' =>'1'
        ]);

        $staff = User:: create([
            'name' =>'Staff User',
            'email'=> 'staff@staff.com',
            'password' =>Hash::make('staffstaff'),
            'code' =>'2'
        ]);

        $student = User:: create([
            'name' =>'Student User',
            'email'=> 'student@student.com',
            'password' =>Hash::make('studentstudent'),
            'code' =>'3'
        ]);

        $admin->roles()->attach($adminRole);
        $staff->roles()->attach($staffRole);
        $student->roles()->attach($studentRole);
    }
}
