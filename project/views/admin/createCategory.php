<?php include_once 'project\layouts\admin\header.php' ?>

<div class="container">

    <?php if ($errors != false) : ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="margin-top-70"></div>

    <?php if ($create == false) : ?>

        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Заголовок</label>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Описание</label>
                <textarea rows="4" name="description" class="form-control"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
        </form>


    <?php else : ?>
        Категория добавлена </br>
        <a href="/cpanel/categories/">Вернутся назад</a>
    <?php endif; ?>


    <div class="margin-top-70"></div>

</div>