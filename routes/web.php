<?php

use App\city;
use App\library\firebirdDB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'nonAuth'], function () {

    Route::get('signIn', function (){
        return view('auth.signIn');
    })->name('signIn');

    Route::get('testR', function (){
        return view('testTab');
    });

    Route::get('/sync', function (){
        $pmDB = "95.161.193.10/50305:pm";
        $pmLogin = "WEB";
        $pmPas = "gJCn1219tH";
        $pmdbc = ibase_connect($pmDB, $pmLogin, $pmPas, "WIN1251");
        $ves = 0.5;
        $fbCon=$pmdbc;

        /*$fbsql = "select * from KRS_GET_ARTTARIFF_CMD(".$ves.",0,0,11170,1911,832,'')";
        $request = ibase_query($fbsql);
        $rc = ibase_fetch_object($request);
        $totalsum = (double)($rc->TOTALSUM);

        $this->info($totalsum);*/

        $fbSql = "select c1.ID, c1.NAME, c2.name as REG, c3.name as COUNTRY from cities c1, cities c2, cities c3 where c1.itemtype = 1 and c1.node = c2.id and c2.node = c3.id and c2.id <> -2";
        $Request = ibase_query($fbSql);

        $cities = [];
        $k = 0;
        while($rc = ibase_fetch_object($Request))
        {
            $name = iconv("windows-1251","UTF-8",$rc->NAME);
            $region = iconv("windows-1251","UTF-8",$rc->REG);
            $country = iconv("windows-1251","UTF-8",$rc->COUNTRY);

            $cities[$k]=[
                'id' => $rc->ID,
                'name' => $name,
                'region' => $region,
                'country' => $country
            ];
            $k++;
        }
        fbird_close($fbCon);
        city::query()->delete();
        city::insert($cities);
    });

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/test/task/map', 'HomeController@admin')->name('testTask');
    Route::get('/test/task/graph', 'HomeController@graph')->name('taskGraph');
    Route::get('/printTest', 'HomeController@printTest')->name('printTest');
    Route::get('/testB', function (){
        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
        echo "<br>";
        echo DNS1D::getBarcodePNGPath('4445645656', 'PHARMA2T',3,33,array(255,255,0), true);
        echo DNS1D::getBarcodeHTML('4445645656', 'C128A',2,53,'black', true);
    });
    Route::get('/logout', 'authController@logout')->name('auth.logout');
    Route::get('/calculator', 'HomeController@calc')->name('calc');
    Route::get('/profile', 'profile@profile')->name('profile');
    Route::get('/profile/balance/pdf', 'profile@export_pdf')->name('profile.balance.pdf');
    Route::put('/tracking', 'HomeController@track')->name('track');
    Route::get('/document/get/{id}', 'HomeController@docView')->name('docView');
    Route::get('/document/add', 'HomeController@addDocView')->name('addDocView');
    Route::put('/document/add', 'HomeController@addDoc')->name('addDoc');
    Route::get('/document/print/{id}', 'HomeController@printDoc')->name('document.print');
    Route::get('/message', "profile@message")->name('profile.message');
    Route::post('/message/send', "profile@messageSend")->name('profile.messageSend');
    Route::get('/printed', function (){

        return view('document.printedDoc');
    });
});

//Auth::routes();
Route::post('main', 'authController@login')->name('auth');
