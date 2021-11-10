<?php

namespace App\Imports;

use App\Models\PartsReport;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class PartsImport implements ToModel
{
    public function model(array $row)
    {
        $date = Carbon::today(new DateTimeZone("Africa/Nairobi"));

        if(trim(str_replace("/","-",$row[6])) != ""){
            $date = Carbon::createFromFormat('d/m/Y',$row[6]);
        }

        $magic_no = $row[18];
//        $date_edited = $date->format("Y-m-d");
//        $account = $row[11];
//        if(str_contains("@TransTo",$account) || str_contains("@TransFr",$account) ){
//            $account = 0;
//        }

        if(PartsReport::isExist($magic_no)){
            PartsReport::find($magic_no)->update([
                "retail" => $row[0],
                "net_sale" => $row[1],
                "discount" => $row[2],
                "sales_cost" => $row[3],
                "gross_profit" => $row[4],
                "gross_percentage" => $row[5],
                "posting_date" => $date->format("Y-m-d"),
                "wip" => $row[7],
                "invoice" => $row[8],
                "department" => $row[9],
                "franchise" => $row[10],
                "account" => $row[11],
                "customer" => $row[12],
                "quantity" => $row[13],
                "part_number" => $row[14],
                "analysis_code" => $row[15],
                "discount1" => $row[16],
                "discount2" => $row[17],
                "magic" => $row[18],
                "company_code" => $row[19]
            ]);
            return;
        }

        return new PartsReport([
            "retail" => $row[0],
            "net_sale" => $row[1],
            "discount" => $row[2],
            "sales_cost" => $row[3],
            "gross_profit" => $row[4],
            "gross_percentage" => $row[5],
            "posting_date" => $date->format("Y-m-d"),
            "wip" => $row[7],
            "invoice" => $row[8],
            "department" => $row[9],
            "franchise" => $row[10],
            "account" => $row[11],
            "customer" => $row[12],
            "quantity" => $row[13],
            "part_number" => $row[14],
            "analysis_code" => $row[15],
            "discount1" => $row[16],
            "discount2" => $row[17],
            "magic" => $row[18],
            "company_code" => $row[19]
        ]);
    }
}
