<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisCode extends Model
{
    use HasFactory;

    protected $table = 'analysis_codes';
    protected $primaryKey = 'analysis_code';
    protected $keyType = 'string';
    public $timestamps = false;
}
