<?php include_once 'project\layouts\admin\header.php' ?>

<form method="POST" action="">
  <table class="table">

    <thead class="thead-light">
      <tr>
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">id</th>
        <th scope="col">Дата</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Операции</th>
        <th scope="col">Категория</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($posts as $post) : ?>
        <tr>
          <th scope="col"><input type="checkbox" name="checkbox[]" value="<?= $post['id']; ?>"></th>
          <th><?= $post['id']; ?></th>
          <td><?= $post['date']; ?></td>
          <td><a href="/cpanel/edit-post/<?= $post['id']; ?>/"><?= $post['title']; ?></a></td>
          <td><a href="/cpanel/delete-post/<?= $post['id']; ?>/" class="btn btn-light">Удалить</a></td>
          <td><?= $post['category']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

  <div class="button-bottom">
    <a class="btn btn-primary" href="/cpanel/create-post/">Создать пост</a>
    <button type="submit" name="submit" class="btn btn-primary">Удалить посты</button>
    <a class="btn btn-primary" href="/cpanel/create-post-test/">Создать тестовый пост</a>
  </div>

</form>