<?php
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([ 
            'identificacion'  => '123456',
            'nombres'  => 'Administrador',
            'apellidos'  => 'General',
            'fecha_nacimiento' => '1989-01-02',
            'email'  => 'aplicativomovilglobal@gmail.com.co',
            'telefono'  => '5134365',
            'celular'  => '3155909080',
            'rol'  => 'SuperAdmin',
            'username'  => 'AdminMSGlobal',
            'password'  => '123456',
        ]);
    }
}
