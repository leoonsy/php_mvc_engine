<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?= $title; ?>Frontend test</title>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="/test/dist/scripts/jquery-3.4.1.js"></script>
    <script src="/test/dist/scripts/popper.js"></script>
    <script src="/test/dist/scripts/bootstrap.js"></script>
    <link rel="stylesheet" href="/test/dist/styles/bootstrap.css">
    <link rel="stylesheet" href="/test/dist/styles/main.css">
</head>

<body>
    <!--[if lt IE 8]>
	<p>Вы используете <strong>устаревшую</strong> версию браузера. Пожалуйста <a
			href="http://browsehappy.com/">обновите свой браузер</a>.</p>
	<![endif]-->
    <div class="container-fluid ">
        <div class="row">
            <div class="col-6">Колонка 1</div>
            <div class="col-6">Колонка 2</div>
            <div class="col-12">Колонка 3</div>
        </div>
        <div class="row">
            <div class="col-lg col-sm">Колонка 1</div>
            <div class="col-lg col-sm">Колонка 2</div>
        </div>
        <div class="row ">
            <div class="col-lg">Колонка 1</div>
            <div class="col-lg offset-lg-3">Колонка 2</div>
            <div class="col-lg">Колонка 4</div>
        </div>
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</body>

</html>