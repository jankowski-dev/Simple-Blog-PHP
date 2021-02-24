<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/cpanel/">cPanel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Привет, <?php echo $_SESSION['name'];  ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Ваша почта: <?php echo $_SESSION['email']; ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Ваша страна: <?php echo $_SESSION['country']; ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout/">Выйти</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <!-- <div class="form-containers-edit"> -->
    <!-- <div class="form-style"> -->

    <?php if ($errors != false) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="margin-top-70"></div>

    <form action="" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Заголовок</label>
                <input type="text" class="form-control" value="<?= $post['title']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Категория</label>
                <input type="text" class="form-control" value="<?= $post['category']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Описание</label>
            <input type="text" class="form-control" value="<?= $post['description']; ?>">
        </div>
        <div class="form-group">
            <label for="inputAddress">Текст поста</label>
            <textarea rows="18" class="form-control" id="tinyEditor"><?= $post['story']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress">Ключевые слова</label>
            <input type="text" class="form-control" value="<?= $post['keyword']; ?>">
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Закрепить
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <div class="margin-top-70"></div>

    <!-- </div> -->
    <!-- </div> -->
</div>