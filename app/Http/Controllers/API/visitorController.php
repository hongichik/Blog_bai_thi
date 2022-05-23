<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class visitorController extends Controller
{
    public function visitor()
    {
        $date = getdate();
        // return $date['mon'];
        $array;
        for($i = 3;$i>=0;$i--)
        {
            $mon;
            if($date['mon']-$i < 1)
            {
                $mon = 12 + ($date['mon']-$i);
            }
            else
            {
                $mon = $date['mon']-$i;
            }
            $sum =  DB::select('SELECT SUM(count) as `tong` FROM `visitor_webs` WHERE month(visitor_webs.created_at) = ?',[$mon]);
            if($sum[0]->tong == null)
            {
                $array[] = array(
                    'mon' => 'tháng '.$mon,
                    'sum' =>'0',
                );
            }
            else
            {
                $array[] = array(
                    'mon' => 'tháng '.$mon,
                    'sum' =>$sum[0]->tong,
                );
            }

        }
        return response()->json($array);
         
    }
}
