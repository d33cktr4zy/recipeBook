<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new recipeBook\User;
        $user->name     =   'siganteng';
        $user->email    =   'siganteng@tlab.test';
        $user->password =   Hash::make('hanyakitayangtahu');
        $user->api_token=   Str::random(80);

        $user->save();
    }
}
