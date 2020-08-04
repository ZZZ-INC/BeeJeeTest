 <!DOCTYPE html>
<html >
    <head >
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity = "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin = "anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col"><h3>Задание <span class='text-warning'>Bee</span>Jee.</h3></div>
                <div class="col">
                    <?php
                    if (\app\system\App::isAdminLogin()) {
                        echo '<a class="btn btn-default" href="/admin/logout">Выйти</a>';
                    } else {
                        echo '<a class="btn btn-default" href="/admin/index">Войти</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?= $content; ?>
        <script src="/js/system.js"></script>
    </body>
	<footer>
	<div class="col"><h5> Выполнил: <span class="text-success">Закиров Ранис</span></h5></div>
	</footer>
</html>
