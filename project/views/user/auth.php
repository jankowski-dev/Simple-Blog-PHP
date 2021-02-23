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

            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ваш логин</label>
                    <input type="text" class="form-control" name="userEmail" aria-describedby="emailHelp" placeholder="Введите логин">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password" class="form-control" name="userPassword" placeholder="Пароль">
                </div>

                <button type="submit" name="submit" class="btn btn-primary margin-top-20">Войти</button>
            </form>

        </div>
    </div>
</div>