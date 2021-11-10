<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{
    use HasFactory;

    protected $table = "workshop_revenues";

    public $timestamps = false;
    protected $primaryKey = 'magic_no';

    protected $fillable = array(
        "department",
        "wip",
        "hours_sold",
        "sales",
        "analysis_code",
        "operator_code",
        "invoice",
        "magic_no",
        "customer_id",
        "date_edited",
        "registration",
        "company_code"
    );

    public static function isExist($magic_no){
        $workshop = self::find($magic_no);
        if(!$workshop){
            return false;
        }
        return $workshop->count() > 0;
    }

}
