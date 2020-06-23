<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\coordinate;

class coordinateController extends Controller
{
    public function putXY(Request $request){
        $array = $request->params['array'];
        $timeStamp = date('d.m.y H:i:s');
        foreach ($array as $item){
            $xyz = new coordinate();

            $xyz->clickX = $item['clickX'];
            $xyz->clickY = $item['clickY'];
            $xyz->dateTime = $timeStamp;
            $xyz->save();
        }
        return true;
    }

    public function putXYZ(Request $request){
        $timeStamp = date('d.m.y H:i:s');
        coordinate::create([
            'clickX' => 1,
            'clickY' => 1,
            'dateTime' => $timeStamp
        ]);
        /*$xyz = new coordinate();
        $timeStamp = date('d.m.y H:i:s');
        $xyz->clickX = '123';
        $xyz->clickY = '12313';
        $xyz->dateTime = $timeStamp;
        $xyz->save();
        return $xyz;*/
    }

    public function getData(Request $request){
        $coordinates = coordinate::all();
        
        $rc = [];
        foreach ($coordinates as $k=>$item){
            $coordinates[$k]->dateTime = date('H',strtotime($item->dateTime));
        }

        foreach ($coordinates as $item){
            $rc[$item->dateTime][] = $item;
        }
        $labels = [];
        $datasets = [];
        $data = [];
        foreach ($rc as $k=>$item){
            array_push($labels, "$k:00");
            array_push($data, count($item));
        }
        $datasets = [
            'label' => 'Клики',
            'backgroundColor' => '#F26202',
            'data' => $data
        ];
        /*return [
            'labels' => [1, 2, 3, 4],
            'datasets' => array([
                'label' => 'test',
                'backgroundColor' => '#F26202',
                'data' => [100, 200, 300, 400]
            ])
        ];*/
        return [
            'labels' => $labels,
            'datasets' => array([
                'label' => 'Количество кликов',
                'backgroundColor' => '#F26202',
                'data' => $data
            ])
        ];
    }
}
