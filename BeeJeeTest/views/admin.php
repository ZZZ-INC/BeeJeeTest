 <?php if ($isLogged): ?>
    <div class="container">Вы вошли в систему</div>
<?php else: ?>
    <div class="container text-center mt-5">
        <h1>Панель администратора</h1>
        <div class="login-form__info bg-success text-light"></div>
        <div class="login-form__error bg-danger text-light"></div>
        <form class="login-form" method="post">
            <div class="form-row text-left">
                <div class="form-group col-12">
                    <label>Логин</label><input class="form-control" name="name">
                </div>
                <div class="form-group col-12">
                    <label>Пароль</label><input class="form-control" name="password" type="password">
                </div>
                <div class="form-group col-12">
                    <button class="btn btn-primary" onclick="doLogin()">Войти</button>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>