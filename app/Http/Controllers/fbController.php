<?php

namespace App\Http\Controllers;

use App\Mail\messages;
use App\Mail\vkNotify;
use App\User;
use App\city;
use Illuminate\Http\Request;
use App\library\firebirdDB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class fbController extends Controller
{
    public function calculate(Request $request){

        $ves = $request->ves;
        $fromCity = $request->outCity;
        $inCity = $request->inCity;
        $user = User::find($request->user);
        $partner = $user->gb_id;
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();
        $heap = "ox=$request->ox".PHP_EOL."oy=$request->oy".PHP_EOL."oz=$request->oz".PHP_EOL;
        //$fbsql = "select * from krsweb_get_tariff(".$ves.",0,3088,".$partner.",".$fromCity.",".$inCity.",'$heap')";
        $fbsql = "Select * from krs_get_arttariff_cmd3 ($ves, 0, 10529, $partner, $fromCity, $inCity, 'TaxPartner=-1')";
        $request = ibase_query($fbsql);
        $rc = ibase_fetch_object($request);
        $totalsum = (double)($rc->TOTALSUM);
        /*$Strings = explode('|',$rc->TARIFS);
        $j = count($Strings);
        $array = [];
        $k = 0;
        $notFound = (integer)($rc->NOTFOUND);
        //$notFound = 1;
        if ($notFound != 1)
            for ($i = 0; $i < $j-1; $i++)
            {
                $elements = explode(';',$Strings[$i]);
                $array[$i] = [
                    'Name' => iconv("windows-1251","UTF-8",$elements[0]),
                    'Price' => (double)($elements[1]),
                    'Srok' => $elements[2]
                ];
            }
        else
            $array[1] = [
                'Name' => 'Тарифы и сроки доставки уточняйте у оператора',
                'Price' => -1,
                'Srok' => -1
            ];*/

        ibase_close($exdelDB);
        return $totalsum;
        //return json_encode($array);
    }

    public function getExcel(Request $request){
        $ids = $request->params['ids'];
        $sqlParams = "";
        foreach ($ids as $id){
            $sqlParams .= $id['id'].';';
        }
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();
        $fbsql = "select * from WEBLK_GET_EXCEL('$sqlParams')";
        $requestFB = ibase_query($fbsql);

        $excelDocs = [];
        array_push($excelDocs, [
            "date" => ['v' => "Дата" ,'s' => ['numFmt' => "m/dd/yy", "font" => ['bold' => true]]],
            "number" => ['v' => "Номер накладной",'s' => ["font" => ['bold' => true]]],
            "place" => ['v' => "Мест",'s' => ["font" => ['bold' => true]]],
            "ves" => ['v' => "Вес",'s' => ["font" => ['bold' => true]]],
            "outPartner" => ['v' => "Наименование отправителя",'s' => ["font" => ['bold' => true]]],
            "outCity" => ['v' => "Город Отправителя",'s' => ["font" => ['bold' => true]]],
            "outAddress" => ['v' => "Адрес отправителя",'s' => ["font" => ['bold' => true]]],
            "outFio" => ['v' => "ФИО отправителя",'s' => ["font" => ['bold' => true]]],
            "outPhone" => ['v' => "Телефон отправителя",'s' => ["font" => ['bold' => true]]],
            "inCity" => ['v' => "Город получателя",'s' => ["font" => ['bold' => true]]],
            "inPartner" => ['v' => "Наименование получателя",'s' => ["font" => ['bold' => true]]],
            "inPhone" => ['v' => "Телефон получателя",'s' => ["font" => ['bold' => true]]],
            "inFio" => ['v' => "ФИО получателя",'s' => ["font" => ['bold' => true]]],
            "inAddress" => ['v' => "Адрес получателя",'s' => ["font" => ['bold' => true]]]
        ]);
        while ($rc = ibase_fetch_object($requestFB)){

            array_push($excelDocs, [
                "date" => ['v' => date( 'd.m.Y',strtotime($rc->DVDOCDATE)), 't' => 's', 'z' => 'dd/mm/yyyy'],
                "number" => ['v' => $rc->DVNUMBER, 't' => 's'],
                "place" => ['v' => $rc->DVPLACE],
                "ves" => ['v' => $rc->DVVES],
                "outPartner" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVOUTPARTNER)],
                "outCity" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVOUTCITYNAME)],
                "outAddress" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVOUTADDRESS)],
                "outFio" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVOUTFIO)],
                "outPhone" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVOUTPHONE)],
                "inCity" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVINCITYNAME)],
                "inPartner" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVINPARTNER)],
                "inPhone" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVINPHONE)],
                "inFio" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVINFIO)],
                "inAddress" => ['v' => iconv('windows-1251', 'UTF-8', $rc->DVINADDRESS)]
            ]);
        }

        return $excelDocs;
    }

    public function vkCreate(Request $request){
        /*$array = [
            'mPartner' => 1,
            'test'=>'test'
        ];
        $heap = implode(PHP_EOL, $array);*/

        $form = [];
        $user = User::find($request->params['form']['userId']);
        $item = $request->params['form'];
        $inPartner = $item['partner'];
        $inPhone = $item['phone'];
        $inAddress = $item['address'];
        $inCity = $item['city'];
        $fio = $item['fio'];
        $date = $item['date'];
        $phoneP = $item['phoneP'];
        $city = city::find($inCity);
        $item['city'] = $city->name;
        $userName = $user->name;
        $managerMail = $user->managerMail;

        array_push($form, [
            'mPartner'=>"mPartner=$user->gb_id",
            'Ord'=>"Ord=$user->gb_id",
            'inPartner'=>"inPartner=$inPartner",
            'inPhone'=>"inPhone=$inPhone",
            'inAddress'=>"inAddress=$inAddress",
            'inCity'=>"inCity=$inCity",
            'inFIO'=>"inFIO=$fio"
        ]);
        $heap = implode(PHP_EOL,$form[0]);
        return Mail::to("$managerMail")->send(new vkNotify($item, $userName));
    }

    public function excelPut(Request $request){
        $outFio = iconv("UTF-8", "windows-1251", $request->params['doc'][3]);
        $outPartner = iconv("UTF-8", "windows-1251",$request->params['doc'][0]);
        $outPhone = iconv("UTF-8", "windows-1251",$request->params['doc'][4]);
        $outAddress = iconv("UTF-8", "windows-1251",$request->params['doc'][2]);
        $inFio = iconv("UTF-8", "windows-1251",$request->params['doc'][10]);
        $inPartner = iconv("UTF-8", "windows-1251",$request->params['doc'][8]);
        $inPhone = iconv("UTF-8", "windows-1251",$request->params['doc'][9]);
        $inAddress = iconv("UTF-8", "windows-1251",$request->params['doc'][11]);
        $note = iconv("UTF-8", "windows-1251",$request->params['doc'][12]);
        $typePack = '';
        $payType = '';
        $payer = '';
        $condition = '';
        $outCity = iconv("UTF-8", "windows-1251", $request->params['doc'][1]);
        $inCity = iconv("UTF-8", "windows-1251", $request->params['doc'][7]);
        $outZIP = '';
        $inZIP = '';
        $ves = $request->params['doc'][6];
        $place = $request->params['doc'][5];
        $gabarits = '';

        $user = User::find($request->params['user']);

        $mPartner = $user->gb_id;

        $mDate = date("d.m.Y",time());


        $heap = "mPartner=".$mPartner.PHP_EOL."mDate=".$mDate.PHP_EOL."Ord=".$mPartner.PHP_EOL."outPartner=".$outPartner.PHP_EOL;
        $heap = $heap."outPhone=".$outPhone.PHP_EOL."outZip=".$outZIP.PHP_EOL."outAddress=".$outAddress.PHP_EOL."outFIO=".$outFio.PHP_EOL;
        $heap = $heap."outCity=".$outCity.PHP_EOL."inFIO=".$inFio.PHP_EOL."inPhone=".$inPhone.PHP_EOL."inPartner=".$inPartner.PHP_EOL;
        $heap = $heap."inCity=".$inCity.PHP_EOL."inZIP=".$inZIP.PHP_EOL."inAddress=".$inAddress.PHP_EOL."PayType=".$payType.PHP_EOL;
        $heap = $heap."Place=".$place.PHP_EOL."mNote=".$note.PHP_EOL."rType=".$typePack.PHP_EOL."PayAgent=".$payer.PHP_EOL."Ves=".$ves.PHP_EOL;

        /*$firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();

        $sql = "select * from KRS_WEBDOCUMENT_PUT('$heap')";
        $Request = ibase_query($sql);
        $rc = ibase_fetch_object($Request);
        //$docId = $rc->DVNEWIDWEB;
        $docId = 1;
        ibase_close($exdelDB);*/
        return $heap;
    }
}
