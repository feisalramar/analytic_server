<?php

namespace App\Imports;

use App\Models\ServiceReport;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ServiceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $date = Carbon::today(new DateTimeZone("Africa/Nairobi"));
        $inp =  $row[9];

        if(str_contains ( $inp , "/" ) && (trim(str_replace("/","", $inp )) != "" || trim( $inp  != ""))){
            $date = Carbon::createFromFormat('d/m/Y', $inp );
        }else{
            $date = Carbon::create( $inp );
        }

        $department = $row[0];
        $wip = $row[1];
        $hours = $row[2];
        $sales = $row[3];
        $code = $row[4];
        $operator = $row[5];
        $invoice = $row[6];
        $customer = $row[7];
        $magic_no = $row[8];
        $date_edited = $date->format("Y-m-d");
        $reg = $row[10];
        $company_code = $row[11];

        if(ServiceReport::isExist($magic_no)){
            ServiceReport::find($magic_no)->update([
                "department"  => $department,
                "wip" => $wip,
                "hours_sold" => $hours,
                "sales" => $sales,
                "analysis_code" => $code,
                "operator_code" => $operator,
                "invoice" => $invoice,
                "customer_id" => $customer,
                "date_edited" => $date_edited,
                "registration" => $reg,
                "company_code" => $company_code
            ]);
            return;
        }

        return new ServiceReport([
            "department"  => $department,
            "wip" => $wip,
            "hours_sold" => $hours,
            "sales" => $sales,
            "analysis_code" => $code,
            "operator_code" => $operator,
            "invoice" => $invoice,
            "customer_id" => $customer,
            "magic_no" => $magic_no,
            "date_edited" => $date_edited,
            "registration" => $reg,
            "company_code" => $company_code
        ]);
    }


}
