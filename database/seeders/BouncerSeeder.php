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
        // $admin = Bouncer::role()->firstOrCreate([
        //     'name' => 'test',
        //     'title' => 'Test',
        // ]);

        // Bouncer::allow('admin')->everything();

        // // $manager = Bouncer::role()->firstOrCreate([
        // //     'name' => 'manager',
        // //     'title' => 'Manager',
        // // ]);

        // $distributor = Bouncer::role()->firstOrCreate([
        //     'name' => 'distributor',
        //     'title' => 'Distributor',
        // ]);

        // $admin_user = User::updateOrCreate([
        //     'name' => 'Admin',
        //     'email' => 'test@test.com',
        // ], [
        //     'password' => 'password',
        // ]);

        // $admin_user->assign('admin');

        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'manage-distributor',
            'title' => 'Manage Distributor',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'view-distributor',
            'title' => 'View Distributor',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'create-distributor',
            'title' => 'Create Distributor',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-distributor',
            'title' => 'Edit Distributor',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-distributor',
            'title' => 'Delete Distributor',
        ]);


        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'view-request',
            'title' => 'View Request',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'manage-request',
            'title' => 'Manage Request',
        ]);

        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'manage-roles',
            'title' => 'Manage Roles',
        ]);

        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'manage-users',
            'title' => 'Manage Users',
        ]);


        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'view-products',
            'title' => 'View Products',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'create-products',
            'title' => 'Create Products',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-products',
            'title' => 'Edit Products',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-products',
            'title' => 'Delete Products',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'upload-products',
            'title' => 'Upload Products',
        ]);
        $ban = Bouncer::ability()->firstOrCreate([
            'name' => 'view-upload-history',
            'title' => 'View Upload History',
        ]);

    }
}
