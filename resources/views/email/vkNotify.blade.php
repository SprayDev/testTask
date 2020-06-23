<div class="container">
    <p>От {{$userName}} поступил заказ на вызов курьера. </p>
    <ul>
        <li>Желаемая дата приезда курьера: {{$form['date']}}</li>
        <li>Город: {{$form['city']}}</li>
        <li>Адрес: {{$form['address']}}</li>
        <li>Наименование партнера: {{$form['partner']}}</li>
        <li>ФИО отправителя: {{$form['fio']}}</li>
        <li>Телефон Отправителя: {{$form['phone']}}</li>
    </ul>
    <b>Данные заказчика: </b>
    <ul>
        <li>ФИО заказчика: {{$form['fioP']}}</li>
        <li>Телефон клиента: {{$form['phoneP']}}</li>
    </ul>
</div>
