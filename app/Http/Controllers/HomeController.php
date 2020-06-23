<?php

namespace App\Http\Controllers;

use App\coordinate;
use App\User;
use App\city;
use Illuminate\Http\Request;
use App\library\firebirdDB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function admin(){
        $user = Auth::user();

        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();
        $userId = $user->gb_id;

        $sql = "select * from WEBLK_GETPROFILE($userId)";
        $Request = ibase_query($sql);
        $rc = ibase_fetch_object($Request);

        $person = ['manager' => iconv('windows-1251', 'UTF-8', $rc->MANAGER), 'balance' => $rc->BALANCE, 'phone' => $rc->PHONE];

        $cities = city::all();
        $coordinates = coordinate::all();

        //return view('profile.profile')
        $coordinates = coordinate::all();
        return view('admin.map')->withUser($user)->withPerson($person)->withCities($cities)->withCoordinates(json_encode($coordinates, JSON_UNESCAPED_SLASHES ));
    }

    public function graph(){

        $coordinates = coordinate::all();
        return view('admin.graph')->withCoordinates(json_encode($coordinates, JSON_UNESCAPED_SLASHES ));
    }

    public function index()
    {
        $user = User::find(Auth::id());
        $firebird = new firebirdDB();
        $postDB = $firebird->exdel();
        $sql = "select * from krsweb_getdocs($user->gb_id)";
        $requestFB = ibase_query($sql);
        $docs = [];
        while ($rc = ibase_fetch_object($requestFB))
        {
            $date = strtotime($rc->DVDATE);
            $datePer = date('Y-m-d', $date);
            $date = date('d.m.Y', $date);

            $docs[] = [
                'docId' => $rc->DVIDDOC,
                'number' => $rc->DVNUMDOC,
                'date' => $date,
                'datePer' => $datePer,
                'outCity' => iconv('windows-1251', 'UTF-8', $rc->DVCITYS),
                'inCity' => iconv('windows-1251', 'UTF-8', $rc->DVCITYR),
                'status' => iconv('windows-1251', 'UTF-8', $rc->DVCHECK),
                'inHand' => $rc->DVINHAND,
                'inPartner' => iconv('windows-1251', 'UTF-8', $rc->DVINPARTNER),
                'total' => $rc->DVTOTAL,
                'tariff' => iconv('windows-1251', 'UTF-8', $rc->DVTARIFF),
                'ifSend' => iconv('windows-1251', 'UTF-8', $rc->DVIFSENDSTR)
            ];
        }

        ibase_close($postDB);
        return view('document.listDocs')->withDocs($docs);
    }

    public function calc()
    {
        $cities = city::all();
        return view('functions.calc')->withCities($cities);
    }

    public function addDocView()
    {
        $user = User::find(Auth::id());
        $firebird = new firebirdDB();
        $postDB = $firebird->exdel();
        $sql = "select * from KRSWEB_GET_ADDRESSES($user->gb_id)";
        $requestFB = ibase_query($sql);
        $temps = [];
        while ($rc = ibase_fetch_object($requestFB))
        {
            array_push($temps, [
                'id' => $rc->DVID,
                'template' => iconv('windows-1251', 'UTF-8', $rc->DVADDRNAME),
                'partner' => iconv('windows-1251', 'UTF-8', $rc->DVCANTORA),
                'city' => $rc->DVCITY,
                'zip' => iconv('windows-1251', 'UTF-8', $rc->DVZIP),
                'address' => iconv('windows-1251', 'UTF-8', $rc->DVADDRESS),
                'phone' => iconv('windows-1251', 'UTF-8', $rc->DVPHONE)
            ]);
        }
        ibase_close($postDB);
        $cities = city::all();
        return view('document.addDoc')->withCities($cities)->withTemps($temps);
    }

    public function track(Request $request)
    {
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();

        $number = $request->number;//2401453
        $sql = "select * from KRSWEB_GETPOINTS('".$number."')";
        $Request = ibase_query($sql);

        $i = 0;
        $status = [];

        while ($rc = ibase_fetch_object($Request)){
            $i++;
            $date = $rc->VDATE;
            $status[$i]=[
                'date' => $date,
                'point' => iconv("windows-1251","UTF-8",$rc->VPOINT),
                'senderCity' => iconv("windows-1251","UTF-8",$rc->VSENDERCITY),
                'deliveryCity' => iconv("windows-1251","UTF-8",$rc->VDELIVERYCITY),
                'docnumber' => $rc->VDOCNUMBER,
                'partner' => iconv("windows-1251","UTF-8",$rc->VPARTNER),
                'sender' => iconv("windows-1251","UTF-8",$rc->VSENDER),
                'recipient' => iconv("windows-1251","UTF-8",$rc->VRECIPIENT)
            ];
        }

        ibase_close($exdelDB);

        return view('functions.tracking')->withStatus($status);
    }

    public function docView($id){
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();
        $sql = "select * from KRSWEB_GETDOC_BYID('$id')";
        $Request = ibase_query($sql);
        $rc = ibase_fetch_object($Request);
        $doc = [
            'number' => $rc->DVDOCNUMBER,
            'outFIO' => iconv("windows-1251","UTF-8",$rc->DVOUTFIO),
            'outPartner' => iconv("windows-1251","UTF-8",$rc->DVOUTPARTNER),
            'outCity' => $rc->DVOUTCITY,
            'outPhone' => iconv("windows-1251","UTF-8",$rc->DVOUTPHONE),
            'outZIP' => iconv("windows-1251","UTF-8",$rc->DVOUTZIP),
            'outAddress' => iconv("windows-1251","UTF-8",$rc->DVOUTADDRESS),
            'inFIO' => iconv("windows-1251","UTF-8",$rc->DVINFIO),
            'inPartner' => iconv("windows-1251","UTF-8",$rc->DVINPARTNER),
            'inCity' => $rc->DVINCITY,
            'inPhone' => iconv("windows-1251","UTF-8",$rc->DVINPHONE),
            'inZIP' => iconv("windows-1251","UTF-8",$rc->DVINZIP),
            'inAddress' => iconv("windows-1251","UTF-8",$rc->DVINADDRESS),
            'payType' => $rc->DVPAYTYPE,
            'condition' => $rc->DVCONDITION,
            'ves' => $rc->DVVES,
            'place' => $rc->DVPLACE,
            'payRcv' => $rc->DVPAYRCV,
            'note' => iconv("windows-1251","UTF-8",$rc->DVNOTE),
        ];

        ibase_close($exdelDB);
        $cities = city::all();
        return view('document.doc')->withDoc($doc)->withCities($cities);
    }

    public function addDoc(Request $request){
        $outFio = iconv("UTF-8", "windows-1251", $request->outFIO);
        $outPartner = iconv("UTF-8", "windows-1251",$request->outPartner);
        $outPhone = iconv("UTF-8", "windows-1251",$request->outPhone);
        $outCity = $request->outCity;
        $outAddress = iconv("UTF-8", "windows-1251",$request->outAddress);
        $outZIP = iconv("UTF-8", "windows-1251",$request->outZIP);
        $inFio = iconv("UTF-8", "windows-1251",$request->inFIO);
        $inPartner = iconv("UTF-8", "windows-1251",$request->inPartner);
        $inPhone = iconv("UTF-8", "windows-1251",$request->inPhone);
        $inCity = $request->inCity;
        $inAddress = iconv("UTF-8", "windows-1251",$request->inAddress);
        $inZIP = iconv("UTF-8", "windows-1251",$request->inZIP);
        $note = iconv("UTF-8", "windows-1251",$request->note);
        $typePack = $request->typePack;
        $payType = $request->payType;
        $payer = $request->payer;
        $condition = $request->condition;
        $ves = $request->ves;
        $place = $request->place;
        $gabarits = $request->gabarits;
        $user = Auth::user();
        $mPartner = $user->gb_id;
        $mDate = date("d.m.Y",time());


        $heap = "mPartner=".$mPartner.PHP_EOL."mDate=".$mDate.PHP_EOL."Ord=".$mPartner.PHP_EOL."outPartner=".$outPartner.PHP_EOL;
        $heap = $heap."outPhone=".$outPhone.PHP_EOL."outZip=".$outZIP.PHP_EOL."outAddress=".$outAddress.PHP_EOL."outFIO=".$outFio.PHP_EOL;
        $heap = $heap."outCity=".$outCity.PHP_EOL."inFIO=".$inFio.PHP_EOL."inPhone=".$inPhone.PHP_EOL."inPartner=".$inPartner.PHP_EOL;
        $heap = $heap."inCity=".$inCity.PHP_EOL."inZIP=".$inZIP.PHP_EOL."inAddress=".$inAddress.PHP_EOL."PayType=".$payType.PHP_EOL;
        $heap = $heap."Place=".$place.PHP_EOL."mNote=".$note.PHP_EOL."rType=".$typePack.PHP_EOL."PayAgent=".$payer.PHP_EOL."Ves=".$ves.PHP_EOL;
        $i = 0;
        foreach ($gabarits as $gab){
            $i++;
            $heap = $heap."ox$i=".$gab['length'].PHP_EOL."oy$i=".$gab['width'].PHP_EOL."oz$i=".$gab['height'].PHP_EOL;
        }

        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();

       return 1;
    }

    public function printDoc($id){
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();

        $sql = "select * from KRSWEB_GETDOC_BYID('$id')";
        $Request = ibase_query($sql);
        $rc = ibase_fetch_object($Request);
        if ($rc->DVINCITY != 0)
        {
            $inCity = city::find($rc->DVINCITY);
            $inCityName = $inCity->name;
            $inCityReg = $inCity->region;
            $inCityCountry = $inCity->country;
        }
        else
        {
            $inCityName = '---';
            $inCityReg = '---';
            $inCityCountry = '---';
        }
        if ($rc->DVOUTCITY != 0)
        {
            $outCity = city::find($rc->DVOUTCITY);
            $outCityName = $outCity->name;
            $outCityReg = $outCity->region;
            $outCityCountry = $outCity->country;
        }
        else{
            $outCityName = '---';
            $outCityReg = '---';
            $outCityCountry = '---';
        }
        $doc = [
            'number' => $rc->DVDOCNUMBER,
            'outFIO' => iconv("windows-1251","UTF-8",$rc->DVOUTFIO),
            'outPartner' => iconv("windows-1251","UTF-8",$rc->DVOUTPARTNER),
            'outCity' => $outCityName,
            'outReg' => $outCityReg,
            'outCountry' => $outCityCountry,
            'outPhone' => iconv("windows-1251","UTF-8",$rc->DVOUTPHONE),
            'outZIP' => iconv("windows-1251","UTF-8",$rc->DVOUTZIP),
            'outAddress' => iconv("windows-1251","UTF-8",$rc->DVOUTADDRESS),
            'inFIO' => iconv("windows-1251","UTF-8",$rc->DVINFIO),
            'inPartner' => iconv("windows-1251","UTF-8",$rc->DVINPARTNER),
            'inCity' => $inCityName,
            'inReg' => $inCityReg,
            'inCountry' => $inCityCountry,
            'inPhone' => iconv("windows-1251","UTF-8",$rc->DVINPHONE),
            'inZIP' => iconv("windows-1251","UTF-8",$rc->DVINZIP),
            'inAddress' => iconv("windows-1251","UTF-8",$rc->DVINADDRESS),
            'payType' => $rc->DVPAYTYPE,
            'condition' => $rc->DVCONDITION,
            'ves' => $rc->DVVES,
            'place' => $rc->DVPLACE,
            'payRcv' => $rc->DVPAYRCV,
            'note' => iconv("windows-1251","UTF-8",$rc->DVNOTE),
        ];

        ibase_close($exdelDB);
        return view('document.printedDoc')->withDoc($doc);

    }

    public function printTest(){

    }
}
