<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','admin@gmail.com')->first();
        if($user == null){
          $user = User::Create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make(12345678),
          ]);
        }
       
    }
}
