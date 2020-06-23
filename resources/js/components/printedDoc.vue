<template>
    <div ref="pdf" class="container">
        <div>
            <b-row>
                <b-col>
                    <img width="280" class="logo" src="/img/pm_logo.jpg" alt="PostMaster">
                    <br>
                    <a style="font-family: Tahoma">+7 (843) 262-44-99</a>
                    <br>
                    <a style="font-family: Tahoma;">post@post-master.ru</a>
                </b-col>
                <b-col>
                    <VueBarcode  value="17202434" format="CODE128" height="60" width="4"></VueBarcode>
                </b-col>
                <b-col style="font-size: 10px">
                    <p class="mb-0">Казань (843) 262-44-99, 226-95-78</p>
                    <p class="mb-0">Набережные Челны (8552) 39-44-02</p>
                    <p class="mb-0">Бугульма (85594) 6-89-83,</p>
                    <p class="mb-0">+79172558539</p>
                    <p class="mb-0">420108, Татарстан Респ, Казань г,</p>
                    <p class="mb-0">Мазита Гафури ул., д.48, помещение 25</p>
                </b-col>
            </b-row>
            <b-row>
                <table border="1" cellpadding="1" cellspacing="0" height="100" width="100%" style="text-align: left;">
                    <tbody valign="top">
                    <tr height="25">
                        <td width="2" rowspan="5">
                            <div class="st-head vert-text">ОТПРАВИТЕЛЬ</div>
                        </td>
                        <td colspan="3">
                            <font class="st-hint">Фамилия отправителя/Last name of Shipper:</font><br>
                            <font class="st-val">{{doc.outFIO}}</font>
                        </td>
                        <td colspan="2" rowspan="2">
                            <font class="st-hint">Телефон/Phone: </font><br>
                            <font class="st-val">{{doc.outPhone}}</font>
                        </td>
                        <td width="2" rowspan="5">
                            <div style="margin-top: 38px" class="st-head vert-text">доставки</div><div style="margin-top: 7px" class="st-head vert-text">Условия </div>
                        </td>
                        <td><font class="st-hintr"><div class="whitebox"><p class="box-x">x</p></div>  Экспресс/Express<br><div class="whitebox"><p class="box-x"></p></div>  Стандартная/Standart<br><div class="whitebox"><p class="box-x"></p></div>  Эконом/Econom</font></td>
                        <td width="2" rowspan="5">
                            <div style="margin-top: 38px" class="st-head vert-text">оплаты</div><div style="margin-top: 7px" class="st-head vert-text">Условия </div>
                        </td>
                        <td rowspan="2" colspan="2"><div class="whitebox"><p class="box-x">{{doc.payRcv==1 ? 'x':''}}</p></div>  Отправитель<br>
                            <div class="whitebox"><p class="box-x">{{doc.payRcv==2 ? 'x':''}}</p></div>  Получатель<br>
                            <div class="whitebox"><p class="box-x"></p></div>  Другой <div class="whitebox-extralong"><p class="box-x"></p></div>
                            <div class="whitebox"><p class="box-x">{{doc.payRcv==3 ? 'x':''}}</p></div>  Служебное</td>
                    </tr>
                    <tr height="25">
                        <td colspan="3"><font class="st-hint">Компания-отправитель/Shipping company:</font><br>
                            <font class="st-val">{{doc.outPartner}}</font></td>
                        <td rowspan="4"><font class="st-hintr"><div class="whitebox"></div>  По адресу<br>
                            <div class="whitebox"><p class="box-x">x</p></div>  До востребования<br>
                            <div class="whitebox"><p class="box-x"></p></div>  Лично в руки<br>
                            Доставить в дату <div class="whitebox-long"><p class="box-x">12.12.2012</p></div>  <br>
                            Доставить до часу <div class="whitebox-long"><p class="box-x"></p></div></font></td>
                    </tr>
                    <tr height="25">
                        <td colspan="3">
                            <font class="st-hint">Страна </font><font class="st-val">{{doc.outCountry}}</font>
                        </td>
                        <td colspan="2">
                            <font class="st-hint">Регион </font><font class="st-val">{{doc.outReg}}</font>
                        </td>
                        <td rowspan="3" colspan="2"><font class="st-hintr"><div class="whitebox"><p class="box-x">{{doc.payType==0 ? 'x':''}}</p></div>  Наличными<br><div class="whitebox"><p class="box-x">{{doc.payType==1 ? 'x':''}}</p></div>  По счету</font></td>
                    </tr>
                    <tr height="25">
                        <td colspan="3"><font class="st-hint">Город </font><font class="st-val">{{doc.outCity}}</font></td>
                        <td colspan="2"><font class="st-hint">Индекс/Postal code: </font><font class="st-val">{{doc.outZIP}}</font></td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Адрес</font><br><font class="st-val">{{doc.outAddress}}</font></td>
                        <td colspan="2"><font class="st-hint">Примечание отправителя</font><br><font class="st-val">{{doc.note}}</font></td>
                    </tr>


                    <tr height="20">
                        <td width="2" rowspan="5">
                            <div class="st-head vert-text">Получатель</div>
                        </td>
                        <td colspan="3">
                            <font class="st-hint">Фамилия Получателя/Last name of Shipper:</font><br>
                            <font class="st-val">{{doc.inFIO}}</font>
                        </td>
                        <td colspan="2" rowspan="2">
                            <font class="st-hint">Телефон/Phone: </font><br>
                            <font class="st-val">{{doc.inPhone}}</font>
                        </td>
                        <td colspan="3" rowspan="3">
                            <div style="width: 229px">
                                <span style="font-size: 12px">ФИО отправителя/Shippers Signature</span>
                                <p style="font-size: 7px">Своей подписью от имени Отправителя я подтверждаю соглашение о перевозке данного отплавления на условиях, изложенных в Регламенте Постмастер. С действующими тарифами и условиями ограничения ответственности ознакомлен и согласен. Отправление не содержит предметы, запрещенные к перевозке.</p>
                            </div>
                        </td>
                        <td colspan="2">
                            <span style="font-size: 12px">Итого к оплате</span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Компания-получатель/Shipping company:</font><br>
                            <font class="st-val">{{doc.inPartner}}</font></td>
                        <td colspan="2" rowspan="2">
                            <span style="font-size: 12px">Подпись отправителя<br></span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3">
                            <font class="st-hint">Страна </font><font class="st-val">{{doc.inCountry}}</font>
                        </td>
                        <td colspan="2">
                            <font class="st-hint">Регион </font><font class="st-val">{{doc.inReg}}</font>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Город </font><font class="st-val">{{doc.inCity}}</font></td>
                        <td colspan="2"><font class="st-hint">Индекс/Postal code: </font><font class="st-val">{{doc.inZIP}}</font></td>
                        <td colspan="5" rowspan="2">
                            <span>СПЕЦИАЛЬНЫЕ ИНСТРУКЦИИ/SPECIAL INSTRUCTIONS</span>

                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="5"><font class="st-hint">Адрес</font><br><font class="st-val">{{doc.inAddress}}</font></td>
                    </tr>

                    <tr height="25">
                        <td width="2" rowspan="7">
                            <div style="margin-top: 5px" class="st-head vert-text">отправления</div><div style="margin-top: 7px" class="st-head vert-text">Описание </div>
                        </td>
                        <td colspan="2" style="font-size: 12px">
                            <div style="margin-left: 15px">
                                <div class="whitebox"><p class="box-x"></p></div>  <div style="display: inline-block">Документы<div>Documents</div></div>
                                <div style="margin-left: 15px" class="whitebox"><p class="box-x"></p></div>  <div style="display: inline-block">Не документы<div>No documents</div></div>
                            </div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Мест</div>
                            <div>Places</div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Вес</div>
                            <div>Weight</div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Габариты(см х см х см)</div>
                            <div>Dimensions(cm x cm x cm)</div>
                        </td>
                        <td colspan="4" style="font-size: 12px" rowspan="2">
                            <span>Принято курьером</span>
                        </td>
                        <td rowspan="2" colspan="1" style="font-size: 12px">
                            <span>Подпись курьера</span>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td rowspan="3" colspan="4">
                            <span>Должность</span>
                        </td>
                        <td rowspan="3">
                            <span>Фамилия получателя</span>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>

                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td rowspan="2" colspan="4" style="font-size: 12px">
                            <span>Подпись получателя</span>
                        </td>
                        <td rowspan="2" colspan="1" style="font-size: 12px">
                            <span>Дата и время доставки</span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td>
                            <span>Places</span>
                                <p>{{doc.place}}</p>
                        </td>
                        <td>
                            <span>Weight</span>
                                <p>{{doc.ves}}</p>
                        </td>
                        <td>
                            <span>Vol.WT</span>
                                <p>0.00</p>
                        </td>
                        <td>
                            <span>Control.WT</span>

                        </td>
                        <td>
                            <span>Declared value</span>
                        </td>
                    </tr>
                    <!--
                                   <tr height="60">
                                       <td width="5" bgcolor="#800000" rowspan="5"><div style="margin-top: 43px" class="st-head vert-text">ПОЛУЧАТЕЛЬ</div></td>
                                       <td><font class="st-hint">Фамилия получателя/Last name of Consignee: </font><br><font class="st-val">Петров</font></td>
                                       <td><font class="st-hint">Телефон/Phone:</font><br>
                                           <font class="st-val">8812448013</font></td>
                                       <td><font class="st-hintr">Тариф за услугу</font></td>
                                       <td><font class="st-hintr">Страховой тариф</font></td>
                                       <td><font class="st-hintr">Итого к оплате</font></td>
                                   </tr>
                                   <tr height="20">
                                       <td colspan="2"><font class="st-hint">Компания-получатель/Consignee company:</font><br>
                                           <font class="st-val">7595 Сенная SF (СПб) Управляющий магазина</font></td>
                                       <td colspan="3" rowspan="2"><font class="st-hintr">Специальные инструкции/Special instructions: </font></td>
                                   </tr>
                                   <tr>
                                       <td><font class="st-hint">Страна/Country: </font><font class="st-val">Россия</font></td>
                                       <td><font class="st-hint">Регион/State: </font><font class="st-val">2342342</font></td>
                                   </tr>
                                   <tr height="30">
                                       <td><font class="st-hint">Город/City: </font><font class="st-val">Санкт-Петербург</font></td>
                                       <td><font class="st-hint">Индекс/Postal code: </font><font class="st-val">190031</font></td>
                                       <td colspan="3" rowspan="2"><font class="st-hintr">Фамилия и подпись отправителя/Signature of Shipper*: </font></td>
                                   </tr>
                                   <tr height="30">
                                       <td colspan="2"><font class="st-hint">Адрес/Street address: </font><br><font class="st-val">Ефимова ул, дом 3</font></td>
                                   </tr>-->
                    </tbody>
                </table>
            </b-row>
        </div>
        <div>
            <b-row>
                <b-col>
                    <img width="280" class="logo" src="/img/pm_logo.jpg" alt="PostMaster">
                    <br>
                    <a style="font-family: Tahoma">8-800-775-65-08</a>
                    <br>
                    <a style="font-family: Tahoma;">info@exdel.ru</a>
                </b-col>
                <b-col>
                    <VueBarcode  value="17202434" format="CODE128" height="60" width="4"></VueBarcode>
                </b-col>
                <b-col style="font-size: 10px">
                    <p class="mb-0">Казань (843) 262-44-99, 226-95-78</p>
                    <p class="mb-0">Набережные Челны (8552) 39-44-02</p>
                    <p class="mb-0">Бугульма (85594) 6-89-83,</p>
                    <p class="mb-0">+79172558539</p>
                    <p class="mb-0">420108, Татарстан Респ, Казань г,</p>
                    <p class="mb-0">Мазита Гафури ул., д.48, помещение 25</p>
                </b-col>
            </b-row>
            <b-row>
                <table border="1" cellpadding="1" cellspacing="0" height="100" width="100%" style="text-align: left;">
                    <tbody valign="top">
                    <tr height="25">
                        <td width="2" rowspan="5">
                            <div class="st-head vert-text">ОТПРАВИТЕЛЬ</div>
                        </td>
                        <td colspan="3">
                            <font class="st-hint">Фамилия отправителя/Last name of Shipper:</font><br>
                            <font class="st-val">{{doc.outFIO}}</font>
                        </td>
                        <td colspan="2" rowspan="2">
                            <font class="st-hint">Телефон/Phone: </font><br>
                            <font class="st-val">{{doc.outPhone}}</font>
                        </td>
                        <td width="2" rowspan="5">
                            <div style="margin-top: 38px" class="st-head vert-text">доставки</div><div style="margin-top: 7px" class="st-head vert-text">Условия </div>
                        </td>
                        <td><font class="st-hintr"><div class="whitebox"><p class="box-x">x</p></div>  Экспресс/Express<br><div class="whitebox"><p class="box-x"></p></div>  Стандартная/Standart<br><div class="whitebox"><p class="box-x"></p></div>  Эконом/Econom</font></td>
                        <td width="2" rowspan="5">
                            <div style="margin-top: 38px" class="st-head vert-text">оплаты</div><div style="margin-top: 7px" class="st-head vert-text">Условия </div>
                        </td>
                        <td rowspan="2" colspan="2"><div class="whitebox"><p class="box-x">{{doc.payRcv==1 ? 'x':''}}</p></div>  Отправитель<br>
                            <div class="whitebox"><p class="box-x">{{doc.payRcv==2 ? 'x':''}}</p></div>  Получатель<br>
                            <div class="whitebox"><p class="box-x"></p></div>  Другой <div class="whitebox-extralong"><p class="box-x"></p></div>
                            <div class="whitebox"><p class="box-x">{{doc.payRcv==3 ? 'x':''}}</p></div>  Служебное</td>
                    </tr>
                    <tr height="25">
                        <td colspan="3"><font class="st-hint">Компания-отправитель/Shipping company:</font><br>
                            <font class="st-val">{{doc.outPartner}}</font></td>
                        <td rowspan="4"><font class="st-hintr"><div class="whitebox"></div>  По адресу<br>
                            <div class="whitebox"><p class="box-x">x</p></div>  До востребования<br>
                            <div class="whitebox"><p class="box-x"></p></div>  Лично в руки<br>
                            Доставить в дату <div class="whitebox-long"><p class="box-x">12.12.2012</p></div>  <br>
                            Доставить до часу <div class="whitebox-long"><p class="box-x"></p></div></font></td>
                    </tr>
                    <tr height="25">
                        <td colspan="3">
                            <font class="st-hint">Страна </font><font class="st-val">{{doc.outCountry}}</font>
                        </td>
                        <td colspan="2">
                            <font class="st-hint">Регион </font><font class="st-val">{{doc.outReg}}</font>
                        </td>
                        <td rowspan="3" colspan="2"><font class="st-hintr"><div class="whitebox"><p class="box-x">{{doc.payType==0 ? 'x':''}}</p></div>  Наличными<br><div class="whitebox"><p class="box-x">{{doc.payType==1 ? 'x':''}}</p></div>  По счету</font></td>
                    </tr>
                    <tr height="25">
                        <td colspan="3"><font class="st-hint">Город </font><font class="st-val">{{doc.outCity}}</font></td>
                        <td colspan="2"><font class="st-hint">Индекс/Postal code: </font><font class="st-val">{{doc.outZIP}}</font></td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Адрес</font><br><font class="st-val">{{doc.outAddress}}</font></td>
                        <td colspan="2"><font class="st-hint">Примечание отправителя</font><br><font class="st-val">{{doc.note}}</font></td>
                    </tr>


                    <tr height="20">
                        <td width="2" rowspan="5">
                            <div class="st-head vert-text">Получатель</div>
                        </td>
                        <td colspan="3">
                            <font class="st-hint">Фамилия Получателя/Last name of Shipper:</font><br>
                            <font class="st-val">{{doc.inFIO}}</font>
                        </td>
                        <td colspan="2" rowspan="2">
                            <font class="st-hint">Телефон/Phone: </font><br>
                            <font class="st-val">{{doc.inPhone}}</font>
                        </td>
                        <td colspan="3" rowspan="3">
                            <div style="width: 229px">
                                <span style="font-size: 12px">ФИО отправителя/Shippers Signature</span>
                                <p style="font-size: 7px">Своей подписью от имени Отправителя я подтверждаю соглашение о перевозке данного отплавления на условиях, изложенных в Регламенте Постмастер. С действующими тарифами и условиями ограничения ответственности ознакомлен и согласен. Отправление не содержит предметы, запрещенные к перевозке.</p>
                            </div>
                        </td>
                        <td colspan="2">
                            <span style="font-size: 12px">Итого к оплате</span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Компания-получатель/Shipping company:</font><br>
                            <font class="st-val">{{doc.inPartner}}</font></td>
                        <td colspan="2" rowspan="2">
                            <span style="font-size: 12px">Подпись отправителя<br></span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3">
                            <font class="st-hint">Страна </font><font class="st-val">{{doc.inCountry}}</font>
                        </td>
                        <td colspan="2">
                            <font class="st-hint">Регион </font><font class="st-val">{{doc.inReg}}</font>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"><font class="st-hint">Город </font><font class="st-val">{{doc.inCity}}</font></td>
                        <td colspan="2"><font class="st-hint">Индекс/Postal code: </font><font class="st-val">{{doc.inZIP}}</font></td>
                        <td colspan="5" rowspan="2">
                            <span>СПЕЦИАЛЬНЫЕ ИНСТРУКЦИИ/SPECIAL INSTRUCTIONS</span>

                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="5"><font class="st-hint">Адрес</font><br><font class="st-val">{{doc.inAddress}}</font></td>
                    </tr>

                    <tr height="25">
                        <td width="2" rowspan="7">
                            <div style="margin-top: 5px" class="st-head vert-text">отправления</div><div style="margin-top: 7px" class="st-head vert-text">Описание </div>
                        </td>
                        <td colspan="2" style="font-size: 12px">
                            <div style="margin-left: 15px">
                                <div class="whitebox"><p class="box-x"></p></div>  <div style="display: inline-block">Документы<div>Documents</div></div>
                                <div style="margin-left: 15px" class="whitebox"><p class="box-x"></p></div>  <div style="display: inline-block">Не документы<div>No documents</div></div>
                            </div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Мест</div>
                            <div>Places</div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Вес</div>
                            <div>Weight</div>
                        </td>
                        <td style="font-size: 12px">
                            <div>Габариты(см х см х см)</div>
                            <div>Dimensions(cm x cm x cm)</div>
                        </td>
                        <td colspan="4" style="font-size: 12px" rowspan="2">
                            <span>Принято курьером</span>
                        </td>
                        <td rowspan="2" colspan="1" style="font-size: 12px">
                            <span>Подпись курьера</span>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td rowspan="3" colspan="4">
                            <span>Должность</span>
                        </td>
                        <td rowspan="3">
                            <span>Фамилия получателя</span>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>

                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr height="17">
                        <td colspan="2">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td rowspan="2" colspan="4" style="font-size: 12px">
                            <span>Подпись получателя</span>
                        </td>
                        <td rowspan="2" colspan="1" style="font-size: 12px">
                            <span>Дата и время доставки</span>
                        </td>
                    </tr>
                    <tr height="20">
                        <td>
                            <span>Places</span>
                            <p>{{doc.place}}</p>
                        </td>
                        <td>
                            <span>Weight</span>
                            <p>{{doc.ves}}</p>
                        </td>
                        <td>
                            <span>Vol.WT</span>
                            <p>0.00</p>
                        </td>
                        <td>
                            <span>Control.WT</span>

                        </td>
                        <td>
                            <span>Declared value</span>
                        </td>
                    </tr>
                    <!--
                                   <tr height="60">
                                       <td width="5" bgcolor="#800000" rowspan="5"><div style="margin-top: 43px" class="st-head vert-text">ПОЛУЧАТЕЛЬ</div></td>
                                       <td><font class="st-hint">Фамилия получателя/Last name of Consignee: </font><br><font class="st-val">Петров</font></td>
                                       <td><font class="st-hint">Телефон/Phone:</font><br>
                                           <font class="st-val">8812448013</font></td>
                                       <td><font class="st-hintr">Тариф за услугу</font></td>
                                       <td><font class="st-hintr">Страховой тариф</font></td>
                                       <td><font class="st-hintr">Итого к оплате</font></td>
                                   </tr>
                                   <tr height="20">
                                       <td colspan="2"><font class="st-hint">Компания-получатель/Consignee company:</font><br>
                                           <font class="st-val">7595 Сенная SF (СПб) Управляющий магазина</font></td>
                                       <td colspan="3" rowspan="2"><font class="st-hintr">Специальные инструкции/Special instructions: </font></td>
                                   </tr>
                                   <tr>
                                       <td><font class="st-hint">Страна/Country: </font><font class="st-val">Россия</font></td>
                                       <td><font class="st-hint">Регион/State: </font><font class="st-val">2342342</font></td>
                                   </tr>
                                   <tr height="30">
                                       <td><font class="st-hint">Город/City: </font><font class="st-val">Санкт-Петербург</font></td>
                                       <td><font class="st-hint">Индекс/Postal code: </font><font class="st-val">190031</font></td>
                                       <td colspan="3" rowspan="2"><font class="st-hintr">Фамилия и подпись отправителя/Signature of Shipper*: </font></td>
                                   </tr>
                                   <tr height="30">
                                       <td colspan="2"><font class="st-hint">Адрес/Street address: </font><br><font class="st-val">Ефимова ул, дом 3</font></td>
                                   </tr>-->
                    </tbody>
                </table>
            </b-row>
        </div>
    </div>
</template>

<script>
    import VueBarcode from 'vue-barcode';
    import jsPDF from 'jspdf'


    export default {
        components: {VueBarcode},
        name: "printedDoc",
        props: ['doc'],
        methods: {
            test(){
                const doc = new jsPDF();
                /** WITH CSS */
                var canvasElement = document.createElement('canvas');
                this.$html2canvas(this.$refs.pdf, { canvas: canvasElement
                }).then(function (canvas) {
                    const img = canvas.toDataURL("image/jpeg", 0.8);
                    doc.addImage(img,'JPEG',20,20);
                    doc.save("sample.pdf");
                });
            },

            downloadWithCSS() {
                const doc = new jsPDF();
                /** WITH CSS */
                var canvasElement = document.createElement('canvas');
                this.$html2canvas(this.$refs.pdf, { canvas: canvasElement
                }).then(function (canvas) {
                    const img = canvas.toDataURL("image/jpeg", 1);
                    doc.addImage(img,'JPEG',20,1);
                    doc.save("sample.pdf");
                });

            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
