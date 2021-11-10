<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/upload', function(){
    $disk = Storage::disk('public');
    $file = $disk->path('KU1.csv');
    try{
        Excel::import(new \App\Imports\PartsImport, $file);
        return "Uploaded";
    }catch (Exception $e){
        return $e;
    }
});

Route::get('/stats/parts/{id}/department', function($id,Request $request){

    $start = $request->get('start');
    $end = $request->get('start');

    $parts = \App\Models\PartsReport::where('company_code',$id)
        ->groupBy('department')
        ->where('part_number','not like','%MCON%')
        ->select(DB::raw('sum(net_sale) as value'),'department');

    if($start && $end){
        return "start and end";
    }elseif ($start){
        return "only start";
    }elseif ($end){
        return "only end";
    }

    return response()->json([
        "success" => true,
        "payload" => $parts->get()
    ]);
});

// Parts Net Revenue
Route::get('/stats/parts/{id}/type', function($id,Request $request){

    $start = $request->get('start');
    $end = $request->get('start');

    $parts = \App\Models\PartsReport::where('company_code',$id)
        ->Join('analysis_codes', 'parts_revenue.analysis_code','analysis_codes.analysis_code')
        ->groupBy('parts_revenue.analysis_code')
        ->where('part_number','not like','%MCON%')
        ->where('posting_date','>=','2021-09-01')
        ->where('posting_date','<=','2021-09-31')
        ->select(DB::raw('sum(net_sale) as value'),'analysis_name');

//    if($start && $end){
//        return "start and end";
//    }elseif ($start){
//        return "only start";
//    }elseif ($end){
//        return "only end";
//    }

    return response()->json([
        "success" => true,
        "payload" => $parts->get()
    ]);
});


Route::get('/stats/parts/{id}/dealer', function($id,Request $request){

    $start = $request->get('start');
    $end = $request->get('start');

    $parts = \App\Models\PartsReport::where('company_code',$id)
        ->groupBy('customer')
        ->where('analysis_code','D')
        ->where('part_number','not like','%MCON%')
        ->limit(10)
        ->select(DB::raw('sum(net_sale) as value'),'customer');

    if($start && $end){
        return "start and end";
    }elseif ($start){
        return "only start";
    }elseif ($end){
        return "only end";
    }

    return response()->json([
        "success" => true,
        "payload" => $parts->get()
    ]);
});



Route::get('/stats/parts/{id}/consumable', function($id,Request $request){

    $start = $request->get('start');
    $end = $request->get('start');

    $parts = \App\Models\PartsReport::where('company_code',$id)
        ->where('part_number','like','%MCON%')
        ->groupBy('department')
        ->select(DB::raw('sum(net_sale) as value'),'department');

    if($start && $end){
        return "start and end";
    }elseif ($start){
        return "only start";
    }elseif ($end){
        return "only end";
    }

    return response()->json([
        "success" => true,
        "payload" => $parts->get()
    ]);
});


Route::get('/stats/parts/{id}/', function($id,Request $request){

    $start = $request->get('start');
    $end = $request->get('start');

    $gross = \App\Models\PartsReport::where('company_code',$id)
        ->where('part_number','not like','%MCON%')
        ->select(DB::raw('sum(gross_profit) as value'))->first();

    $net = \App\Models\PartsReport::where('company_code',$id)
        ->where('part_number','not like','%MCON%')
        ->select(DB::raw('sum(net_sale) as value'))->first();

    $cost = \App\Models\PartsReport::where('company_code',$id)
        ->where('part_number','not like','%MCON%')
        ->select(DB::raw('sum(sales_cost) as value'))->first();


    if($start && $end){
        return "start and end";
    }elseif ($start){
        return "only start";
    }elseif ($end){
        return "only end";
    }

    return response()->json([
        "success" => true,
        "payload" => [
            "gross" => $gross,
            "net" => $net,
            "cost" => $cost
        ]
    ]);
});




Route::get('/companies', function(Request $request){

    $companies = \App\Models\Company::get();


    return response()->json([
        "success" => true,
        "payload" =>  $companies
    ]);
});
