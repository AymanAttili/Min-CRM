<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             "email" => "admin@brocali.com",
             "password" => "password",
             "role" => "admin"
         ]);
        User::factory()->create(["email" => "ayman@ayman.com", "password" => "password"]);                                                             ;

        Employee::factory()->create([
            "user_id" => 2,
            "company_id" => 1
        ]);

         $users = User::factory(40)->create();


        $companies = Company::factory(40)->create();
        $i=1;
        foreach ($users as $user){
            Employee::factory()->create([
                "user_id" => $user['id'],
                "company_id" => $i
            ]);
            $i++;
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
