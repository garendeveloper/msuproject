<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConstructionTypes;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
   
       
        \App\Models\Departments::factory()->create([
            'departmentname' => 'PPU HEAD',
        ]);
        \App\Models\Departments::factory()->create([
          'departmentname' => 'FINANCIAL DIVISION',
        ]);
        \App\Models\Departments::factory()->create([
          'departmentname' => 'JOB REQUESTOR',
        ]);
        \App\Models\Departments::factory()->create([
          'departmentname' => 'FOREMAN',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
            'designation' => 'CSE BUILDING',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
          'designation' => 'CBAA BUILDING',
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '1',
          'designated_id' => '1',
          'name' => 'PPU HEAD',
          'username' => 'ppuhead',
          'email' => 'ppuhead@gmail.com',
          'password' => Hash::make('ppuhead')
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '2',
          'designated_id' => '2',
          'name' => 'FINANCIAL DIVISION',
          'username' => 'financediv',
          'email' => 'financialdivision@gmail.com',
          'password' => Hash::make('financediv')
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '2',
          'name' => 'JOB REQUESTOR',
          'designated_id' => '2',
          'username' => 'jobrequestor',
          'email' => 'jobrequestor@gmail.com',
          'password' => Hash::make('jobrequestor')
        ]);
        \App\Models\User::factory(10)->create();
        
        ConstructionTypes::factory(5)->create();

        \App\Models\Construction::factory(5)->create();
    }
}
