<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temper;
use DateTime;

class TemperController extends Controller
{


		public function index()
{


}
    
/**
* @dev: Ruvin Roshan
* Building the Onboarding information of Temper users
* @return: JSON array 
*/
public function get_Temper_onboarding_info(){

$Temper_weekly_retention =
    Temper::select([
        \DB::raw('DATE_ADD(created_at, INTERVAL(2-DAYOFWEEK(created_at)) DAY) AS week_start'),
        \DB::raw('CONCAT(YEAR(created_at), "/", WEEK(created_at)) AS week_name'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage <= 100 THEN 1 ELSE 0 END) AS Value1'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 0 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value2'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 20 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value3'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 40 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value4'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 50 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value5'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 70 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value6'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage > 90 AND onboarding_perentage <= 100 THEN 1 ELSE 0 END) Value7'),
        \DB::raw('SUM(CASE WHEN onboarding_perentage = 100 THEN 1 ELSE 0 END) Step8')
    ])
    ->groupBy('week_name')
    ->orderBy(\DB::raw('YEAR(created_at)'),'ASC')
    ->orderBy(\DB::raw('WEEK(created_at)'),'ASC')
    ->get();
    //dd($Temper_weekly_retention);

# selected as spline chart
    $chartArray ["chart"] = array (
        "type" => "spline"
    );
    $chartArray ["title"] = array (
        "text" => "Weekly Retention Curve of Temper Onboarding Flow"
    );


  $chartArray ["subtitle"] = array (
        "text" => "Develop by Ruvin Roshan using Highcharts and Vuejs"
    );

# SET heightcharts Legend
 $chartArray ["legend"] = array (
        "layout" => "vertical",
         "align" => "right",
          "verticalAlign" => "middle"
    );

     $chartArray ["credits"] = array (
        "enabled" => false
    );
    $chartArray ["xAxis"] = array (
        "categories" => array ()
    );
    $chartArray ["tooltip"] = array (
        "valueSuffix" => "%"
    );

# SET heightcharts xAxis categories
    $categoryArray = array (
        '0',
        '20',
        '40',
        '50',
        '70',
        '90',
        '99',
        '100'
    );

    $chartArray ["xAxis"] = array (
        "categories" => $categoryArray,
         "title" => array (
            "text" => "Step in the Onboarding"
        )
    );


# SET heightcharts yAxis info
    $chartArray ["yAxis"] = array (
        "title" => array (
            "text" => "Percentage of Users (Entire Onboarded)"
        ),
        'labels' => array(
            'format' => '{value}%'
        ),
        'min' => '0',
        'max' => '100'
    );


# Disable heightcharts marker
  $chartArray ["plotOptions"] = array (
        "series" => array (
            "marker" => array (
            "enabled" => false
        ),
        )
    );


    foreach ($Temper_weekly_retention as $key1 => $week){
        $dataArray = array();

        for($i = 1; $i <= 8; $i++){

            if($i == 1){
                $dataArray[] = 100;
            }else{
                $dataArray[] = round(($week->{"Value".$i}/$week->Value1) * 100);
            }

        }

        # Building Array
        $chartArray ["series"] [] = array (
            "name" => $week->week_start,
            "data" => $dataArray
        );
    }

    return response()->json($chartArray)->setEncodingOptions(JSON_NUMERIC_CHECK);
}



}
