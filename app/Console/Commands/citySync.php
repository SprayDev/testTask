<?php

namespace App\Console\Commands;

use App\city;
use Illuminate\Console\Command;

class citySync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dbSyn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $DB = "109.226.251.133:mex";
        $Login = "WEB";
        $Pas = "Web2018Web";
        $dbh = fbird_connect($DB, $Login, $Pas, "WIN1251");
        $ves = 0.5;
        $fbCon=$dbh;

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
    }
}
