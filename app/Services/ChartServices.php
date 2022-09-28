<?php
namespace App\Services;

class ChartServices{
    public function orderServices($data){
        $colorList = ["red", "blue", "green", "white"];

        for ($m=1; $m<=12; $m++) {
            $months[date('F', mktime(0,0,0,$m, 1, date('Y')))] = 0;
        }

        foreach($data as $d){
            $result[$d->years]['months'] = $months;
            $result[$d['years']]['colors'] = $colorList[array_rand($colorList)];
        }

        foreach($data as $d){
            $result[$d->years]['months'][$d->months] += $d->total;
        }

        return ['result' => $result, 'monthList' => $months];
    }
}