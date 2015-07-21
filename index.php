<? include 'config.php'; ?>
<? include 'datedialog.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title><? echo SITE_NAME ?></title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="application/javascript" src="js/core.js"></script>
</head>
	<body>
    <h2 class="block"><? echo SITE_NAME ?></h2>
		<div class="block">
            <h3 class="nomargintop">Парсинг</h3>
            Прайс-лист: <i>"<? echo PRICE_URL ?>"</i>
            <br>
            <p id="msgParse"></p>
            <button id="parse">Распарсить</button>
            <br>
            <h3>Отправить отчет</h3>
            <form id="form">
            <select id="type"  name="type" >
                <option value="1">Записи за 3 часа</option>
                <option value="2">Средняя цена за 24 часа</option>
                <option value="3">3 записи с минимальной ценой, за промежуток времени</option>
            </select>
            <br>
            <input name="mail" type="text" value="" placeholder="Ваш Email">
            <div id="date">
                Диапозон с :
                <? createDateDialog('from'); ?>
                <br>По:
                <? createDateDialog('do'); ?>
            </div>
            </form>
            <p id="msgSend"></p>
			<button  id="send"  >Получить отчет на почту</button>
		</div>
	</body>
</html>
