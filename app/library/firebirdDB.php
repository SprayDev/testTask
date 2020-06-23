<?php


namespace App\library;


class firebirdDB
{
    public function exdel(){
        /*$pmDB = "109.226.251.133:mex";
        $pmLogin = "WEB";
        $pmPas = "Web2018Web";
        $pmdbc = ibase_connect($pmDB, $pmLogin, $pmPas, "WIN1251");

        return $pmdbc;*/

        $pmDB = "95.161.193.10/50305:pm";
        $pmLogin = "WEB";
        $pmPas = "gJCn1219tH";
        $pmdbc = ibase_connect($pmDB, $pmLogin, $pmPas, "WIN1251");

        return $pmdbc;
    }
}
