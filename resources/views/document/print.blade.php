<html>
<head>

    <title>Печатная форма накладной</title>

    <style type="text/css">
        .st-hint {
            color: black;
            font-size: 7px;
            font-family: Tahoma;
        }
        .st-val {
            color: black;
            font-size: 8px;
            font-family: Tahoma;
        }
        .st-hintr {
            color: black;
            font-size: 12px;
            font-family: Tahoma;
        }
        .st-hd {
            color: black;
            font-size: 11px;
            font-family: Tahoma;
        }
        .st-head {
            color: #FFFFFF;
            font-size: 16px;
            font-family: Tahoma;
            font-style: normal;
            font-weight: bold;
        }
        .logo{
            width: 200px;
        }
        .whitebox{
            background-color: whitesmoke;
            width: 15px;
            height: 15px;
            border: #bfc0c1 solid 1px;
            display: inline-block
        }
        .td_head{
            font-size: 12px;
            background-color: #707275
        }

        .container_td{
            margin-left: 7px;
        }
        .container_td1{
            margin-left: 5px;
        }
        .container_td_h{
            margin-left: 15px;
            color: whitesmoke;
        }
        .boxbotder{
            width: 15px;
            height: 15px;
            color: black;
            background-color: white;
            border: solid black 1px;
            text-align: center;
            font-size: 10px;
        }
        .grey_td{
            background-color: #bfc0c1;
        }
        .boxbotder-inline{
            width: 15px;
            height: 15px;
            color: black;
            background-color: white;
            border: solid black 1px;
            text-align: center;
            font-size: 10px;
            display: inline-block;
        }
        .box_text{
            color:whitesmoke;
            white-space: nowrap;
            font-size: 8px;
            font-family: Tahoma;
        }
        .table_div{
            width: 1024px;
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="pdf">
    <div class="table_div">
        <table border="1" cellpadding="1" cellspacing="0" width="100%" style="text-align: left;">
            <tbody valign="top">
            <tr>
                <td rowspan="2" height="40" colspan="2">
                    <div class="container">
                        <img class="logo" src="/img/logo_pf1.png" alt="ExDel">
                        <br>
                        <a style="font-size: 11px;font-family: Tahoma">8-800-775-65-08</a>
                        <a style="font-size: 11px;font-family: Tahoma;margin-left: 10px">info@exdel.ru</a>
                    </div>
                </td>
                <td rowspan="2">
                    <div class="container_td">
                        <h1 style="font-size: 20px">НАКЛАДНАЯ</h1>
                        <a class="st-hint" style="font-size: 8px">Дата/Date __.__.__ время/time __:__</a>
                    </div>
                </td>
                <td rowspan="2" width="25%">
                    <div class="container_td" style="size: 20px" align="center">
                        <svg id="barcode">
                        </svg>
                    </div>
                </td>
                <td style="background-color: #3c3c3c;color: whitesmoke;font-size: 25px;font-family: Tahoma" align="center" colspan="4">www.exdel.ru</td>
            </tr>
            <tr>
                <td style="background-color: #bfc0c1;border-right-style: hidden" width="30%">
                    <div class="container_td">
                        <a style="font-size: 7px;font-family: Tahoma">Номер отслеживания</a>
                        <br>
                        <a style="font-size: 7px;font-family: Tahoma">Tracking number</a>
                    </div>
                </td>
                <td style="border-left-style: hidden;background-color: #bfc0c1" align="left">
                    <div style="background-color: whitesmoke;width: 120px;height: 30px;font-size: 12px">
                        {{$doc['number']}}
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td colspan="3" class="td_head" height="20px" width="50%">
                    <div style="margin-left: 15px;color: whitesmoke">
                        Отправитель / Sender
                    </div>
                </td>
                <td colspan="5" style="background-color: #707275;border-right-style: hidden" height="20px" width="25%">
                    <div style="margin-left: 15px;color: whitesmoke;display: inline-block">
                        <a>Режим доставки / Services</a>
                    </div>
                    <div class="container_td" style="display: inline-block">
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Эконом</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Экспресс</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Сверхсрочно</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">СуперЭкспресс</a>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td width="25%" colspan="2">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Ф.И.О отправителя / Sender's Name<br>{{$doc['outFIO']}}</p>
                    </div>
                </td>
                <td width="25%">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Компания / Company<br>{{$doc['outPartner']}}</p>
                    </div>
                </td>
                <td width="50%" class="td_head" colspan="5" valign="middle">
                    <div class="container_td_h">
                        Информация об оплате / Payment information
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td width="25%" colspan="2">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.5">Телефон / Phone<br>{{$doc['outPhone']}}</p>
                    </div>
                </td>
                <td width="25%">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Город / City<br>{{$doc['outCity']}}</p>
                    </div>
                </td>
                <td width="35%" rowspan="2">
                    <div class="container_td" style="display: inline-block">
                        <a class="st-hint">Оплата / Payment</a><br>
                        <div class="boxbotder">{{$doc['payRcv']==1?'x':''}}</div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">Отправителем<br>Sender</p>
                    </div>
                    <div class="container_td1" style="display: inline-block">
                        <div class="boxbotder">{{$doc['payRcv']==0?'x':''}}</div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">Получателем<br>Receiver</p>
                    </div>
                    <div class="container_td1" style="display: inline-block">
                        <div class="boxbotder"></div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">3-ей стороной<br>3-rd party</p>
                    </div>

                </td>
                <td width="15%" class="grey_td" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Объявленная стоимость (в нац.Валюте) Declared value<br></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Страна / Country<br>{{$doc['outCountry']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Область / State<br>{{$doc['outReg']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <a class="st-hint">Район / Area</a><br>
                        <a class="st-val"></a>
                    </div>
                </td>
                <td class="grey_td" rowspan="2" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Примечания</a><br>
                        <a class="st-val">{{$doc['note']}}</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Адрес / Adress<br>{{$doc['outAddress']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <a class="st-hint">Номер плательщика</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><br><br></td>
                <td valign="middle">
                    <div class="container_td" style="display: inline-block">
                        <div class="boxbotder-inline">{{$doc['payType']==1?'x':''}}&nbsp;</div>
                        <a class="st-hint">По счету / Invoice</a>
                        <div class="boxbotder-inline" style="margin-left: 10px">&nbsp;{{$doc['payType']==0?'x':''}}</div>
                        <a class="st-hint">Наличными / Cash</a>
                    </div>
                </td>
                <td class="grey_td" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Сумма платежа </a>
                        <a class="st-val"></a>
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td class="td_head" colspan="3" height="20">
                    <div class="container_td_h">
                        Получатель / Receiver
                    </div>
                </td>
                <td colspan="5" class="td_head">
                    <div class="container_td_h">
                        Прием отправления / Acceptance
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Ф.И.О. получателя / Receiver's name<br>{{$doc['inFIO']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Компания / Company<br>{{$doc['inPartner']}}</p>
                    </div>
                </td>
                <td colspan="1" style="border-right-style: hidden;border-bottom-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Я подтверждаю, что отправление не содержит предметы,<br>
                            запрещенные к пересылке. Обязуюсь соблюдать все правила<br>
                            и условия, изложенные в Договоре
                        </p>
                    </div>
                </td>
                <td colspan="4" style="border-bottom-style: hidden;border-left-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Подпись отправителя /<br>
                            Sender's signature
                        </p>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2" height="20px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Телефон / Phone<br>{{$doc['inPhone']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Город / City<br>{{$doc['inCity']}}</p>
                    </div>
                </td>
                <td align="right" style="border-right-style: hidden;border-top-style: hidden">
                    <a style="font-size: 20px">/</a>
                </td>
                <td colspan="4" style="border-top-style: hidden;border-left-style: hidden"></td>
            </tr>
            <tr>
                <td height="20px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Страна / Country<br>{{$doc['inCountry']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Область / State<br>{{$doc['inReg']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Район / Area<br></p>
                    </div>
                </td>
                <td colspan="5">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Соглашение между Исполнителем и Заказчиком о приемке Груза на условиях, изложенных в Договоре считается<br>
                            заключенным с момента подписания Отправителем (Заказчиком) бланка накладной
                        </p>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="3" height="30px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Адрес / Address<br>{{$doc['inAddress']}}</p>
                    </div>
                </td>
                <td class="grey_td" rowspan="2">
                    <div class="container_td">
                        <a class="st-hint">Примечания экспедитора</a><br><br><br><br>
                    </div>
                </td>
                <td class="grey_td" valign="middle" colspan="4">
                    <div class="container_td">
                        <div class="whitebox"></div>
                        <a class="st-hint">Переадресация</a>
                        <div class="whitebox"></div>
                        <a class="st-hint">Возврат</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" height="10px">
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Индекс / Postal Code<br>{{$doc['inZIP']}}</p>
                    </div>
                </td>
                <td class="grey_td" width="50%">
                    <div class="container_td">
                        <a class="st-hint">Подпись сотрудника</a>
                    </div>
                </td>
                <td class="grey_td">
                    <div class="container_td">
                        <a class="st-hint">Номер</a>
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td colspan="3" class="td_head" height="20">
                    <div class="container_td_h">
                        Описание отправления / Shipment details
                    </div>
                </td>
                <td colspan="5" class="td_head">
                    <div class="container_td_h">
                        Подтверждение доставки
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td class="grey_td" width="10%">
                    <div class="container_td">
                        <div class="whitebox" style="display: inline-block"></div>
                        <p style="line-height: 1;display: inline" class="st-hint">
                            Только документы <br> documents only
                        </p>
                    </div>
                </td>
                <td colspan="2" style="border-bottom-style: hidden">
                    <div class="container_td">
                        <a class="st-hint">Описание вложения / Description of contents</a>
                    </div>
                </td>
                <td colspan="5" style="border-bottom-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Я подтверждаю, что отправление доставлено и вручено в закрытом виде, без внешних повреждений упаковки и<br>
                            пломб, вес отправления соответствует весу, определенному при его приеме<br>
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border-top-style:hidden"></td>
                <td style="border-top-style: hidden">
                    <div class="container_td">
                        <p style="line-height: 1.2" class="st-hint">Подпись получателя /<br>Receiver's signature</p>
                    </div>
                </td>
                <td colspan="4" valign="middle">
                    <div class="container_td">
                        <a class="st-hint">Должность</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="container_td" style="display:inline-block;">
                        <p class="st-hint" style="line-height: 1.2">Кол. мест/<br>Pieces<br><br>________</p>
                    </div>
                    <div class="container_td" style="display: inline-block">
                        <p style="line-height: 1.2" class="st-hint">Вес (кг)/<br>Weight<br><br>_________</p>
                    </div>
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Габариты</p>
                        <a class="st-hint">___x___x___</a>
                    </div>
                </td>
                <td class="grey_td">
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Контр.Взвеш</p>
                        <a class="st-hint">_______</a>
                    </div>
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Объем.Вес</p>
                        <a class="st-hint">_______</a>
                    </div>
                </td>
                <td style="border-top-style: hidden;border-bottom-style: hidden"></td>
                <td colspan="4">
                    <div class="container_td">
                        <a class="st-hint" style="font-size: 8px">Ф.И.О. получателя / Receiver's Name</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="container_td">
                        <a class="st-hint">Адрес/Address</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">За рубеж / International</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">Вгутри страны / Domastic</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">По городу / intracity</a>
                    </div>
                </td>
                <td style="border-top-style: hidden">
                    <div class="container_td" style="font-size: 20px">
                        &#10004;
                    </div>
                </td>
                <td colspan="4">
                    <div class="container_td">
                        <a class="st-hint" style="font-size: 8px">Дата/Date __.__.__ время/time __:__</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="table_div">
        <table border="1" cellpadding="1" cellspacing="0" width="100%" style="text-align: left;">
            <tbody valign="top">
            <tr>
                <td rowspan="2" height="40" colspan="2">
                    <div class="container">
                        <img class="logo" src="/img/logo_pf1.png" alt="ExDel">
                        <br>
                        <a style="font-size: 11px;font-family: Tahoma">8-800-775-65-08</a>
                        <a style="font-size: 11px;font-family: Tahoma;margin-left: 10px">info@exdel.ru</a>
                    </div>
                </td>
                <td rowspan="2">
                    <div class="container_td">
                        <h1 style="font-size: 20px">НАКЛАДНАЯ</h1>
                        <a class="st-hint" style="font-size: 8px">Дата/Date __.__.__ время/time __:__</a>
                    </div>
                </td>
                <td rowspan="2" width="25%">
                    <div class="container_td" style="size: 20px" align="center">
                        <svg id="barcode">
                        </svg>
                    </div>
                </td>
                <td style="background-color: #3c3c3c;color: whitesmoke;font-size: 25px;font-family: Tahoma" align="center" colspan="4">www.exdel.ru</td>
            </tr>
            <tr>
                <td style="background-color: #bfc0c1;border-right-style: hidden" width="30%">
                    <div class="container_td">
                        <a style="font-size: 7px;font-family: Tahoma">Номер отслеживания</a>
                        <br>
                        <a style="font-size: 7px;font-family: Tahoma">Tracking number</a>
                    </div>
                </td>
                <td style="border-left-style: hidden;background-color: #bfc0c1" align="left">
                    <div style="background-color: whitesmoke;width: 120px;height: 30px;font-size: 12px">
                        {{$doc['number']}}
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td colspan="3" class="td_head" height="20px" width="50%">
                    <div style="margin-left: 15px;color: whitesmoke">
                        Отправитель / Sender
                    </div>
                </td>
                <td colspan="5" style="background-color: #707275;border-right-style: hidden" height="20px" width="25%">
                    <div style="margin-left: 15px;color: whitesmoke;display: inline-block">
                        <a>Режим доставки / Services</a>
                    </div>
                    <div class="container_td" style="display: inline-block">
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Эконом</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Экспресс</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">Сверхсрочно</a>
                        <div class="whitebox">
                        </div>
                        <a class="box_text">СуперЭкспресс</a>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td width="25%" colspan="2">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Ф.И.О отправителя / Sender's Name<br>{{$doc['outFIO']}}</p>
                    </div>
                </td>
                <td width="25%">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Компания / Company<br>{{$doc['outPartner']}}</p>
                    </div>
                </td>
                <td width="50%" class="td_head" colspan="5" valign="middle">
                    <div class="container_td_h">
                        Информация об оплате / Payment information
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td width="25%" colspan="2">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.5">Телефон / Phone<br>{{$doc['outPhone']}}</p>
                    </div>
                </td>
                <td width="25%">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Город / City<br>{{$doc['outCity']}}</p>
                    </div>
                </td>
                <td width="35%" rowspan="2">
                    <div class="container_td" style="display: inline-block">
                        <a class="st-hint">Оплата / Payment</a><br>
                        <div class="boxbotder">{{$doc['payRcv']==1?'x':''}}</div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">Отправителем<br>Sender</p>
                    </div>
                    <div class="container_td1" style="display: inline-block">
                        <div class="boxbotder">{{$doc['payRcv']==0?'x':''}}</div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">Получателем<br>Receiver</p>
                    </div>
                    <div class="container_td1" style="display: inline-block">
                        <div class="boxbotder"></div>
                        <p class="st-hint" style="font-size: 8px;line-height: 1.2">3-ей стороной<br>3-rd party</p>
                    </div>

                </td>
                <td width="15%" class="grey_td" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Объявленная стоимость (в нац.Валюте) Declared value<br></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Страна / Country<br>{{$doc['outCountry']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Область / State<br>{{$doc['outReg']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <a class="st-hint">Район / Area</a><br>
                        <a class="st-val"></a>
                    </div>
                </td>
                <td class="grey_td" rowspan="2" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Примечания</a><br>
                        <a class="st-val">{{$doc['note']}}</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Адрес / Adress<br>{{$doc['outAddress']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <a class="st-hint">Номер плательщика</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><br><br></td>
                <td valign="middle">
                    <div class="container_td" style="display: inline-block">
                        <div class="boxbotder-inline">{{$doc['payType']==1?'x':''}}&nbsp;</div>
                        <a class="st-hint">По счету / Invoice</a>
                        <div class="boxbotder-inline" style="margin-left: 10px">&nbsp;{{$doc['payType']==0?'x':''}}</div>
                        <a class="st-hint">Наличными / Cash</a>
                    </div>
                </td>
                <td class="grey_td" colspan="4">
                    <div class="container_td">
                        <a class="st-hint">Сумма платежа </a>
                        <a class="st-val"></a>
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td class="td_head" colspan="3" height="20">
                    <div class="container_td_h">
                        Получатель / Receiver
                    </div>
                </td>
                <td colspan="5" class="td_head">
                    <div class="container_td_h">
                        Прием отправления / Acceptance
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Ф.И.О. получателя / Receiver's name<br>{{$doc['inFIO']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Компания / Company<br>{{$doc['inPartner']}}</p>
                    </div>
                </td>
                <td colspan="1" style="border-right-style: hidden;border-bottom-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Я подтверждаю, что отправление не содержит предметы,<br>
                            запрещенные к пересылке. Обязуюсь соблюдать все правила<br>
                            и условия, изложенные в Договоре
                        </p>
                    </div>
                </td>
                <td colspan="4" style="border-bottom-style: hidden;border-left-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Подпись отправителя /<br>
                            Sender's signature
                        </p>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="2" height="20px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Телефон / Phone<br>{{$doc['inPhone']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Город / City<br>{{$doc['inCity']}}</p>
                    </div>
                </td>
                <td align="right" style="border-right-style: hidden;border-top-style: hidden">
                    <a style="font-size: 20px">/</a>
                </td>
                <td colspan="4" style="border-top-style: hidden;border-left-style: hidden"></td>
            </tr>
            <tr>
                <td height="20px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Страна / Country<br>{{$doc['inCountry']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Область / State<br>{{$doc['inReg']}}</p>
                    </div>
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Район / Area<br></p>
                    </div>
                </td>
                <td colspan="5">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Соглашение между Исполнителем и Заказчиком о приемке Груза на условиях, изложенных в Договоре считается<br>
                            заключенным с момента подписания Отправителем (Заказчиком) бланка накладной
                        </p>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td colspan="3" height="30px">
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Адрес / Address<br>{{$doc['inAddress']}}</p>
                    </div>
                </td>
                <td class="grey_td" rowspan="2">
                    <div class="container_td">
                        <a class="st-hint">Примечания экспедитора</a><br><br><br><br>
                    </div>
                </td>
                <td class="grey_td" valign="middle" colspan="4">
                    <div class="container_td">
                        <div class="whitebox"></div>
                        <a class="st-hint">Переадресация</a>
                        <div class="whitebox"></div>
                        <a class="st-hint">Возврат</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" height="10px">
                </td>
                <td>
                    <div class="container_td">
                        <p style="line-height: 1.5" class="st-hint">Индекс / Postal Code<br>{{$doc['inZIP']}}</p>
                    </div>
                </td>
                <td class="grey_td" width="50%">
                    <div class="container_td">
                        <a class="st-hint">Подпись сотрудника</a>
                    </div>
                </td>
                <td class="grey_td">
                    <div class="container_td">
                        <a class="st-hint">Номер</a>
                    </div>
                </td>
            </tr>
            <tr valign="middle">
                <td colspan="3" class="td_head" height="20">
                    <div class="container_td_h">
                        Описание отправления / Shipment details
                    </div>
                </td>
                <td colspan="5" class="td_head">
                    <div class="container_td_h">
                        Подтверждение доставки
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <td class="grey_td" width="10%">
                    <div class="container_td">
                        <div class="whitebox" style="display: inline-block"></div>
                        <p style="line-height: 1;display: inline" class="st-hint">
                            Только документы <br> documents only
                        </p>
                    </div>
                </td>
                <td colspan="2" style="border-bottom-style: hidden">
                    <div class="container_td">
                        <a class="st-hint">Описание вложения / Description of contents</a>
                    </div>
                </td>
                <td colspan="5" style="border-bottom-style: hidden">
                    <div class="container_td">
                        <p class="st-hint" style="line-height: 1.2">
                            Я подтверждаю, что отправление доставлено и вручено в закрытом виде, без внешних повреждений упаковки и<br>
                            пломб, вес отправления соответствует весу, определенному при его приеме<br>
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="border-top-style:hidden"></td>
                <td style="border-top-style: hidden">
                    <div class="container_td">
                        <p style="line-height: 1.2" class="st-hint">Подпись получателя /<br>Receiver's signature</p>
                    </div>
                </td>
                <td colspan="4" valign="middle">
                    <div class="container_td">
                        <a class="st-hint">Должность</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="container_td" style="display:inline-block;">
                        <p class="st-hint" style="line-height: 1.2">Кол. мест/<br>Pieces<br><br>________</p>
                    </div>
                    <div class="container_td" style="display: inline-block">
                        <p style="line-height: 1.2" class="st-hint">Вес (кг)/<br>Weight<br><br>_________</p>
                    </div>
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Габариты</p>
                        <a class="st-hint">___x___x___</a>
                    </div>
                </td>
                <td class="grey_td">
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Контр.Взвеш</p>
                        <a class="st-hint">_______</a>
                    </div>
                    <div class="container_td" style="display:inline-block;">
                        <p style="line-height: 1.2" class="st-hint">Объем.Вес</p>
                        <a class="st-hint">_______</a>
                    </div>
                </td>
                <td style="border-top-style: hidden;border-bottom-style: hidden"></td>
                <td colspan="4">
                    <div class="container_td">
                        <a class="st-hint" style="font-size: 8px">Ф.И.О. получателя / Receiver's Name</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="container_td">
                        <a class="st-hint">Адрес/Address</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">За рубеж / International</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">Вгутри страны / Domastic</a>
                        <div class="boxbotder-inline"></div>
                        <a class="st-hint" style="font-size: 8px">По городу / intracity</a>
                    </div>
                </td>
                <td style="border-top-style: hidden">
                    <div class="container_td" style="font-size: 20px">
                        &#10004;
                    </div>
                </td>
                <td colspan="4">
                    <div class="container_td">
                        <a class="st-hint" style="font-size: 8px">Дата/Date __.__.__ время/time __:__</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <p id="docnumber" hidden="hidden">{{$doc['number']}}</p>
</div>
<p>&nbsp;</p>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/barcodes/JsBarcode.code128.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        console.log(123);
        var docnumber = document.getElementById("docnumber").textContent;
        console.log(docnumber);
        JsBarcode("#barcode", docnumber, {height: 40,width: 2});
        /*JsBarcode($("#barcode"),docnumber,{height: 40,width: 2});*/
    });
</script>
</body>
</html>

