<?php

namespace App\Http\Controllers;

use App\Mail\userMail;
use App\User;
use App\city;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\messages;
use Illuminate\Http\Request;
use App\library\firebirdDB;
use App\library\numstr;
use Illuminate\Support\Facades\Auth;
use App\coordinate;

class profile extends Controller
{
    public function profile(){

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

        return view('profile.profile')->withUser($user)->withPerson($person)->withCities($cities)->withCoordinates(json_encode($coordinates, JSON_UNESCAPED_SLASHES ));
    }

    public function message(){
        return view('profile.message');
    }

    public function messageSend(Request $request){
        /*Mail::raw("Создана накладная", function ($message){
            $message->to('danil-kravtsiv@mail.ru')->subject('Новая накладная');
            $message->from('ko@post-master.ru');
        });
        return 1;*/
        $user = Auth::user();
        $userName = $user->name;
        $subject = $request->params['form']['subject'];
        $userMail = $request->params['form']['email'];
        $managerMail = $user->managerMail;
        Mail::to("$userMail")->send(new userMail());
        return Mail::to("$managerMail")->send(new messages($request->params['form'], $userName));
    }

    public function export_pdf(Request $request)
    {

        //return view('Reports.balance');
        $user = Auth::user();
        $firebird = new firebirdDB();
        $exdelDB = $firebird->exdel();
        $maxDate = $request->MaxDate;
        $minDate = $request->MinDate;
        if ($user->gb_id == 20232)
            $userId = 20244;
        else $userId = $user->gb_id;

        $fbsql = "select * from BALANCE_BROWSE_CMD('$userId', '$minDate', '$maxDate')";

        $requestFB = ibase_query($fbsql);
        $docs = [];
        $sumCredit = 0;
        $numstr = new numstr();

        $sumDebet = 0;
        $i = 0;
        while ($rc = ibase_fetch_object($requestFB)){
            array_push($docs, [
                'number' => iconv('windows-1251', 'UTF-8', $rc->VDOCNUMBER),
                'docDate' => $rc->VDOCDATE,
                'credit' => $rc->VCREDIT,
                'debet' => $rc->VDEBET
            ]);
            if ($i != 0 ){
                $sumCredit += $rc->VCREDIT;
                $sumDebet += $rc->VDEBET;
            }
            $i++;

        }

        $sumCredit = $sumCredit - $docs[array_key_last($docs)]['credit'];
        $sumDebet = $sumDebet - $docs[array_key_last($docs)]['debet'];


        $fbsql = "select * from WEBLK_GETPARTNER_REQUISITES($userId)";
        $requestFB = ibase_query($fbsql);
        $rc = ibase_fetch_object($requestFB);
        $boss = '';
        $buh = '';
        if ($rc->DVBOSS != ''){
            $boss = iconv('windows-1251', 'UTF-8', $rc->DVBOSS);
        }
        else $boss = '__________________';

        if ($rc->DVBUH != ''){
            $buh = iconv('windows-1251', 'UTF-8', $rc->DVBUH);
        }
        else $buh = '__________________';
        $partnerReq = [
            'address' => iconv('windows-1251', 'UTF-8',$rc->DVADDRESS),
            'phone' => $rc->DVPHONE,
            'inn' => $rc->DVINN,
            'buh' => $buh,
            'boss' => $boss,
            'name' => iconv('windows-1251', 'UTF-8', $rc->DVNAME)
        ];

        $fbsql = "select * from WEBLK_GETPARTNER_REQUISITES(12703)";
        $requestFB = ibase_query($fbsql);
        $rc = ibase_fetch_object($requestFB);
        $boss = '';
        if ($rc->DVBOSS != ''){
            $boss = iconv('windows-1251', 'UTF-8', $rc->DVBOSS);
        }
        else $boss = '__________________';

        if ($rc->DVBUH != ''){
            $buh = iconv('windows-1251', 'UTF-8', $rc->DVBUH);
        }
        else $buh = '__________________';

        $firmReq = [
            'address' => iconv('windows-1251', 'UTF-8',$rc->DVADDRESS),
            'phone' => $rc->DVPHONE,
            'inn' => $rc->DVINN,
            'buh' => $buh,
            'boss' => $boss,
            'name' => iconv('windows-1251', 'UTF-8', $rc->DVNAME)
        ];

        if ($sumCredit - $sumDebet > 0)
            $litPartner = $firmReq['name'];
        else
            $litPartner = $partnerReq['name'];

        $SumLit = $numstr->num2str($sumCredit-$sumDebet);

        $pdf =\PDF::setOptions(['dpi' => 125]);
        $pdf->loadView('Reports.balance', compact('docs', 'sumCredit', 'sumDebet', 'firmReq', 'partnerReq', 'SumLit', 'litPartner'));
        // If you want to store the generated pdf to the server then you can use the store function
        //$pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        //return $pdf->download('customers.pdf');
        ibase_close();
        return $pdf->stream();

    }
}
