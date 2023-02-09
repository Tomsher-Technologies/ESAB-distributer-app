<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Bouncer;

class BouncerSeeder extends Seeder
{
    /**
     * 
     *  php artisan db:seed --class=BouncerSeeder
     * 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);

        Bouncer::allow('admin')->everything();

        $manager = Bouncer::role()->firstOrCreate([
            'name' => 'manager',
            'title' => 'Manager',
        ]);

        $distributor = Bouncer::role()->firstOrCreate([
            'name' => 'distributor',
            'title' => 'Distributor',
        ]);

        $admin_user = User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'test@test.com',
        ], [
            'password' => 'password',
        ]);
        $admin_user->assign('admin');
    }
}
