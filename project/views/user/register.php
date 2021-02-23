<div class="container-fluide">
    <div class="form-containers">
        <div class="form-style">

            <?php if ($errors != false) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!isset($_SESSION['id'])) : ?>

            <?php if (!isset($userName)) : ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label>Представьтесь</label>
                        <input type="text" class="form-control" name="userName" placeholder="Введите ваше имя">
                        <small id="emailHelp" class="form-text text-muted">Полное имя и фамилию пожалуйста</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Укажите вашу почту</label>
                        <input type="text" class="form-control" name="userEmail" aria-describedby="emailHelp" placeholder="Введите email">
                        <small id="emailHelp" class="form-text text-muted">Введите ваш почтовый адрес,он будет вашим логином</small>
                    </div>
                    <div class="form-group">
                        <label>Из какой вы страны?</label>
                        <input type="text" class="form-control" name="userCountry" placeholder="Страна">
                        <small id="emailHelp" class="form-text text-muted">Укажите место вашего фактического проживания</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" class="form-control" name="userPassword" placeholder="Пароль">
                        <small id="emailHelp" class="form-text text-muted">Не менее 6 символов</small>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="exampleCheck1">Принимаю соглашение</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary margin-top-20">Зарегистрироваться</button>
                </form>

            <?php else : ?>
                Добро пожаловать, <b><?= $userName ?>!</b>
                Вы успешно зарегистрированы!
            <?php endif; ?>

            <?php else : ?>
                Вы уже зарегистрированы, <b><?= $_SESSION['name'] ?>!</b>
            <?php endif; ?>

        </div>
    </div>
</div>