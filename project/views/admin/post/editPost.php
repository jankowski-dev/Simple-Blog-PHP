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

    <?php if ($update == false) : ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Заголовок</label>
                    <input type="text" name="title" class="form-control" value="<?= $post['title']; ?>">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputPassword4">Категория</label>
                    <select class="custom-select" name="category_id">
                        <?php foreach ($categories as $category) : ?>
                            <option <?php if ($post['category_id'] == $category['id']) echo 'selected'; ?> value="<?= $category['id']; ?>">
                                <?= $category['title']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputAddress">Описание</label>
                <textarea rows="4" name="description" class="form-control"><?= $post['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress">Текст поста</label>
                <textarea rows="18" name="story" class="form-control" id="textarea"><?= $post['story']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress">Ключевые слова</label>
                <input type="text" name="keyword" class="form-control" value="<?= $post['keyword']; ?>">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Закрепить
                    </label>
                </div>
            </div>



            <div class="form-group">
                <label for="input">Изображение</label>
                <input type="file" name="pictures[]"/>
            </div>


            <button type="submit" name="submit" class="btn btn-primary">Сохранить</button>
        </form>


    <?php else : ?>
        Пост успешно изменен! </br>
        <a href="/cpanel/posts/">Вернутся назад</a>
    <?php endif; ?>


    <div class="margin-top-70"></div>

</div>