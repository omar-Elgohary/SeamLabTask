<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function countAllNumbersBetween($sn , $en)
    {
        $o = 1;
        $count = 0;
        for ($i = $sn ; $i <= $en ; $i++) {
            if($i / 5 == $o){
                $o = $o +2;
                continue;
            }
            $count++;
        }
        echo $count;
    }








    function returnIndexString($letters){
        $alphabet = range('A', 'Z');
        $number = 0;
        foreach(str_split(strrev($letters)) as $key => $char){
            $number = $number + (array_search($char, $alphabet)+1)*pow(count($alphabet), $key);
        }
        return $number;
    }




    
    // function returnIndexString($data)
    // {
    //     $alphabet = range("A" , "Z");

    //     $alpha_flip = array_flip($alphabet);

    //     $number = 0;
    //     $length = strlen($data);
    //     for ($i = 0; $i < $length; $i++) {
    //     $number += ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
    //     }
    //     return $number;
    // }


}
