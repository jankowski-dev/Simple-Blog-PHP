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
                <a class="nav-link" href="/cpanel/create-post/">Создать пост</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout/">Выйти</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">

    <?php if ($errors != false) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="margin-top-70"></div>

    <?php if ($create == false) : ?>

        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Заголовок</label>
                    <input type="text" name="title" class="form-control"">
                </div>
                <div class=" form-group col-md-6">
                    <label for="inputPassword4">Категория</label>
                    <select class="custom-select" name="category_id">
                        <option selected disabled >Выберите пункт</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id']; ?>">
                                <?= $category['title']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Описание</label>
                <textarea rows="4" name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress">Текст поста</label>
                <textarea rows="18" name="story" class="form-control" id="textarea"></textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress">Ключевые слова</label>
                <input type="text" name="keyword" class="form-control">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Закрепить
                    </label>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
        </form>


    <?php else : ?>
        Пост добавлен!
    <?php endif; ?>


    <div class="margin-top-70"></div>

</div>