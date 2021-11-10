<?php

namespace Database\Seeders;

use App\Models\AnalysisCode;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $comps = [
            ["code" => "01" , "name" =>"Toyota Tanzania LTD" ],
            ["code" => "05" , "name" =>"Toyota Tanzania LTD Automark" ],
            ["code" => "07" , "name" =>"Toyota Kariakoo Branch" ],
            ["code" => "09" , "name" =>"City Motors Sterling" ],
            ["code" => "10" , "name" =>"Toyota Tanzania Paint" ],
            ["code" => "11" , "name" =>"Toyota Tanga Paing" ],
            ["code" => "13" , "name" =>"Toyota Tanzania Limited Mbeya" ],
            ["code" => "14" , "name" =>"Toyota Mbeya Paint" ],
            ["code" => "16" , "name" =>"Toyota Tanzania Rufiji" ],
            ["code" => "17" , "name" =>"Toyota Tanzania Tanga" ],
        ];

        foreach ($comps as $comp) {
            $company = new Company();
            $company->id = $comp['code'];
            $company->company_name = $comp['name'];
            $company->company_code = $comp['code'];
            $company->save();
        }

        $branches = [
            ["code" => "W" , "name" =>"Workshop"],
            ["code" => "F" , "name" =>"Fast Lane 1"],
            ["code" => "G" , "name" =>"Fast Lane 2"],
            ["code" => "H" , "name" =>"Fast Lane 3"],
            ["code" => "I" , "name" =>"Fast Lane 4"],
            ["code" => "P" , "name" =>"Parts"],
            ["code" => "B" , "name" =>"Bodyshop"],
        ];

        foreach ($branches as $bran) {
            $branche = new Department();
            $branche->department_name = $bran['name'];
            $branche->department_code = $bran['code'];
            $branche->save();
        }


        $sales = [
            ["code" => "A" , "name" =>"Parts Stock Adj"],
            ["code" => "B" , "name" =>"Branch"],
            ["code" => "D" , "name" =>"Dealer"],
            ["code" => "F" , "name" =>"Fleet Owner"],
            ["code" => "G" , "name" =>"Government"],
            ["code" => "H" , "name" =>"Insurance"],
            ["code" => "I" , "name" =>"Internal"],
            ["code" => "R" , "name" =>"Retail"],
            ["code" => "S" , "name" =>"Repair Shop"],
            ["code" => "T" , "name" =>"Trade"],
            ["code" => "V" , "name" =>"Value +"],
            ["code" => "W" , "name" =>"Warranty"],
        ];

        foreach ($sales as $sale) {
            $sl = new AnalysisCode();
            $sl->analysis_name = $sale['name'];
            $sl->analysis_code = $sale['code'];
            $sl->save();
        }


    }
}
