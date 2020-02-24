<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Dilan',
                'email' => 'kadm0128@gmail.com',
                'password' => Hash::make('123456789'),
                'status' => 'active',
                'created_by' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id' => 2,
                'name' => 'Nimesh',
                'email' => 'nimesh@gmail.com',
                'password' => Hash::make('123456789'),
                'status' => 'active',
                'created_by' => 1,
                'email_verified_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        foreach($users as $user) {
            $success = DB::table('users')->insert($user);
            if ($success) {
                DB::table('model_has_roles')->insert([
                    'role_id' => 1,
                    'model_type' => 'App\Models\User',
                    'model_id' => $user['id']
                ]);
            }
        }
    }
}
