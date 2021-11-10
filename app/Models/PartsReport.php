<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PartsReport extends Model
{
    use HasFactory;
    protected $table = 'parts_revenue';
    public $timestamps = false;
    protected $primaryKey = 'magic';

    protected $fillable = array(
        "retail",
        "net_sale",
        "discount",
        "sales_cost",
        "gross_profit",
        "gross_percentage",
        "posting_date",
        "wip",
        "invoice",
        "department",
        "franchise",
        "account",
        "customer",
        "quantity",
        "part_number",
        "analysis_code",
        "discount1",
        "discount2",
        "magic",
        "company_code"
    );

    public static function isExist($magic_no){
        $parts = self::find($magic_no);
        if(!$parts){
            return false;
        }
        return $parts->count() > 0;
    }


    public static function countWipParts($search=null){
        $date = Carbon::today()->format('Y-m-d');
        if($search){
            $date = $search;
        }
        return DB::table('part_wip')
            ->where('date_created','like','%'.$date.'%')
            ->count();
    }



}
