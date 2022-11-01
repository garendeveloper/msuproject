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
          'designation' => 'Constructions Department',
         ]);


        \App\Models\DesignatedOffice::factory()->create([
            'designation' => 'Department of Information Technology',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
          'designation' => 'Department of Business Administration',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
          'designation' => 'Department of Agroforestry',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
          'designation' => 'Department of Accountancy',
        ]);

        \App\Models\DesignatedOffice::factory()->create([
          'designation' => 'Department of Fisheries',
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '1',
          'designated_id' => '1',
          'name' => 'ENGR. WENNIE P. ASEQUIA',
          'username' => 'ppuhead',
          'email' => 'ppuhead@gmail.com',
          'password' => Hash::make('ppuhead')
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '2',
          'designated_id' => '1',
          'name' => 'RHODA P. ABARY, CPA',
          'username' => 'financialdivision',
          'email' => 'financialdivision@gmail.com',
          'password' => Hash::make('financialdivision')
        ]);

        \App\Models\User::factory()->create([
          'department_id' => '4',
          'name' => 'MC KENNETH P. TANECA',
          'designated_id' => '1',
          'username' => 'foreman',
          'email' => 'foreman@gmail.com',
          'password' => Hash::make('jobrequestor')
        ]);
        \App\Models\User::factory(10)->create();
        
        ConstructionTypes::factory(10)->create();

        \App\Models\Construction::factory()->create([
          'construction_name' => 'Demolition/Removal of Selected Structure',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Reinforced Concrete',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Reinforcing Steel',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Masonry Works with Reinforcement',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Cement Plaster Finish (Smooth Finish)',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'DryWall Partition (2 face)',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Door and Windows',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Ceiling Works',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Painting Works (2 coats)',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Metal Structures (Roof Framing)',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Pre-Painted Metal Sheets & Accessories',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Tiling Works',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Plumbing & Plumbing Fixture',
          'constructiontype_id' => 1,
        ]);
        \App\Models\Construction::factory()->create([
          'construction_name' => 'Electrical Works',
          'constructiontype_id' => 1,
        ]);


        \App\Models\Personnel::factory()->create([
          'adminofficer' => 'ENGR. NORMAN C. EBALLE',
          'engineer' => 'ENGR. JOSE VINCENT T. PADIN',
          'vicechancellor' => 'RHODA P. ABARY, CPA',
          'chancellor' => 'ELNOR C. ROA, PH.D',
        ]);
    }
}
