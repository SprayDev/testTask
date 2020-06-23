<template>
    <div class="table-container">
        <table class="table doc-table">
            <thead class="thead-light thead-exdel">
            <tr>
                <th scope="col"><input class="form-control" v-model="searchName"></th>
                <th scope="col">
                    <!--<input class="form-control input-date" v-model="searchDateMin" type="date"><span>-</span><input class="form-control input-date" v-model="searchDateMax" type="date">-->
                    <div style="display: inline-flex">
                        <b-form-input
                            id="searchDateMin"
                            v-model="searchDateMin"
                            type="text"
                            placeholder="YYYY-MM-DD"
                            autocomplete="off"
                            class="form-control input-date"
                        ></b-form-input>
                        <b-form-datepicker button-only v-model="searchDateMin"></b-form-datepicker>
                    </div>
                    <div>-</div>
                    <div style="display: inline-flex">
                        <b-form-input
                            id="searchDateMax"
                            v-model="searchDateMax"
                            type="text"
                            placeholder="YYYY-MM-DD"
                            autocomplete="off"
                            class="form-control input-date"
                        ></b-form-input>
                        <b-form-datepicker button-only v-model="searchDateMax"></b-form-datepicker>
                    </div>
                </th>
                <th scope="col"><input class="form-control" v-model="searchOut"></th>
                <th scope="col"><input class="form-control" v-model="searchIn"></th>
                <th scope="col" colspan="2">
                    <b-form-checkbox
                        id="webDpc"
                        v-model="webDoc"
                    >
                        Непринятые документы
                    </b-form-checkbox>
                </th>
                <th scope="col" colspan="4"><button @click="excel" class="btn btn-outline-exdel">Выгрузить в excel</button></th>
            </tr>
            <tr>
                <th scope="col">Номер</th>
                <th scope="col">Дата</th>
                <th scope="col">Откуда</th>
                <th scope="col">Куда</th>
                <th scope="col">Получатель</th>
                <th scope="col">Статус</th>
                <th scope="col">Лично в руки</th>
                <th scope="col">Условие доставки</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Печать</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="doc in filteredDocs" :class="doc.docId == -1 ? 'webDoc':''">
                <td class="docNumber" @dblclick="openDoc(doc)">{{ doc.number }}</td>
                <td>{{ doc.date }}</td>
                <td>{{ doc.outCity }}</td>
                <td>{{ doc.inCity }}</td>
                <td>{{ doc.inPartner }}</td>
                <td>{{ doc.status }}</td>
                <td>{{doc.inHand==1?'Да':'Нет'}}</td>
                <td>{{doc.ifSend}}</td>
                <td>{{ doc.total }}</td>
                <td>
                    <i @click="printDoc(doc)" class="fa fa-print pointer" aria-hidden="true"></i>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { saveAs } from 'file-saver';
    import XLSX from 'xlsx-style';
    //require('xlsx-style');

    import Workbook from 'workbook';

    export default {
        name: "TableDocs",
        props: ['docs'],
        data() {
            return {
                gridData: [
                    { v: "Chuck Norris", power: Infinity },
                    { v: "Chuck Norris", power: Infinity }
                ],
                searchName: "",
                searchPower: "",
                searchDateMin: "",
                searchDateMax: "",
                searchIn: "",
                searchOut: "",
                webDoc: false
            }
        },
        methods: {
            openDoc(doc){
                if (doc.docId != -1)
                    location.href = window.location+"document/get/"+doc.docId;
                else
                    location.href = window.location+"document/get/"+doc.number;
            },
            printDoc(doc){
                if (doc.docId != -1)
                    window.open(window.location+"document/print/"+doc.docId);
                else
                    window.open(window.location+"document/print/"+doc.number);
            },
            excel(){
                var docs = this.filteredDocs;
                var ids = [];
                docs.forEach( (element) => {
                   ids.push({id: element.docId});
                });

                /*var workbook = new Workbook();
                var rows = this.gridData;
                rows.forEach((item) => {
                   workbook.addRowsToSheet('test', [[item]])
                });
                workbook.finalize();
                var sheets = workbook.SheetNames;
                var ws = workbook.Sheets[sheets[0]];
                var wscols = [
                    {wch:12},
                    {wch:15},
                    {wch:7},
                    {wch:7},
                    {wch:26},
                    {wch:26},
                    {wch:35},
                    {wch:26},
                    {wch:26},
                    {wch:26},
                    {wch:26},
                    {wch:20},
                    {wch:20},
                    {wch:35}
                ];

                ws['!cols'] = wscols;
                console.log(ws);

                var OUTFILE = '/tmp/wb.xlsx';
                //XLSX.writeFile(workbook, OUTFILE, {defaultCellStyle: { font: {name: 'Arial', sz: '12'}}});
                var wbout = XLSX.write(workbook, {bookType:'xlsx', type: 'binary'});
                console.log("Results written to " + OUTFILE);
                function s2ab(s) {
                    var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
                    var view = new Uint8Array(buf);  //create uint8array as viewer
                    for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
                    return buf;
                }
                saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Реестр накладных.xlsx');*/
                axios.post('/api/excel/get', {
                    params: {
                        ids: ids
                    }
                }).then( (response) => {
                    /*var wb = XLSX.utils.book_new();
                    wb.props = {
                        Title: 'Documents',
                        Subject: 'documents',
                        Author: 'PostMaster',
                        CreatedDate: new Date()
                    };
                    wb.SheetNames.push('document');
                    var ws_data = response.data;
                    console.log(ws_data);*/
                    var workbook = new Workbook();
                    var ws_data = response.data;
                    /*var ws = XLSX.utils.json_to_sheet(
                        ws_data
                        , {header:["date","number","place","ves","outPartner", "outCity", "outAddress", "outFio", "outPhone",	"inCity",
                                "inPartner", "inPhone", "inFio", "inAddress"], skipHeader:true});*/
                    ws_data.forEach((item) => {
                        workbook.addRowsToSheet('document', [[
                            item.date,
                            item.number,
                            item.place,
                            item.ves,
                            item.outPartner,
                            item.outCity,
                            item.outAddress,
                            item.outFio,
                            item.outPhone,
                            item.inCity,
                            item.inPartner,
                            item.inPhone,
                            item.inFio,
                            item.inAddress
                        ]])
                    });

                    workbook.finalize();
                    var sheets = workbook.SheetNames;
                    var ws = workbook.Sheets[sheets[0]];
                    var wscols = [
                        {wch:12},
                        {wch:15},
                        {wch:7},
                        {wch:7},
                        {wch:26},
                        {wch:26},
                        {wch:35},
                        {wch:26},
                        {wch:26},
                        {wch:26},
                        {wch:26},
                        {wch:20},
                        {wch:20},
                        {wch:35}
                    ];
                    ws['!cols'] = wscols;
                    var wbout = XLSX.write(workbook, {bookType:'xlsx', type: 'binary'});
                    function s2ab(s) {
                        var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
                        var view = new Uint8Array(buf);  //create uint8array as viewer
                        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
                        return buf;
                    }
                    saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Реестр накладных.xlsx');
                });

            }
        },
        computed: {
            filteredDocs: function(){
                var filterName = this.searchName && this.searchName.toLowerCase();
                var filterOut = this.searchOut && this.searchOut.toLowerCase();
                var filterIn = this.searchIn && this.searchIn.toLowerCase();
                var filterDateMin = this.searchDateMin;
                var filterDateMax = this.searchDateMax;
                var filterWeb = this.webDoc;
                var docs = this.docs;
                docs.sort((a, b) =>{
                    var aDate = new Date(a.datePer);
                    var bDate = new Date(b.datePer);

                    return  bDate - aDate;
                    }
                );
                if (filterName)
                {
                    docs = docs.filter(function(row){
                        return Object.keys(row).some(function() {
                            return (
                                String(row['number'])
                                    .toLowerCase()
                                    .indexOf(filterName) > -1
                            );
                        });
                    })
                }
                if (filterWeb)
                {
                    if (filterWeb == true){
                        docs = docs.filter(function(row){
                            return Object.keys(row).some(function() {
                                return (
                                    String(row['docId'])
                                        .toLowerCase()
                                        .indexOf(-1) > -1
                                );
                            });
                        });
                    }
                }
                if (filterIn)
                {
                    docs = docs.filter(function(row){
                        return Object.keys(row).some(function() {
                            return (
                                String(row['inCity'])
                                    .toLowerCase()
                                    .indexOf(filterIn) > -1
                            );
                        });
                    })
                }
                if (filterOut)
                {
                    docs = docs.filter(function(row){
                        return Object.keys(row).some(function() {
                            return (
                                String(row['outCity'])
                                    .toLowerCase()
                                    .indexOf(filterOut) > -1
                            );
                        });
                    })
                }
                if (filterDateMin&&filterDateMax)
                {
                    var fromDate = new Date(filterDateMin);
                    var toDate = new Date(filterDateMax);
                    docs = docs.filter((item) => {
                        var itemDate = new Date(item.datePer);
                        return itemDate.getTime() >= fromDate.getTime() &&
                            itemDate.getTime() <= toDate.getTime();
                    });
                }
                return docs;
            }
        },
        mounted(){
            var fromDate = new Date("2020-03-01");
            var toDate = "2020-03-01";
        }
    }
</script>

<style scoped>

</style>
