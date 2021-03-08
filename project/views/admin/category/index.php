<?php include_once 'project\layouts\admin\header.php' ?>

<form method="POST" action="">
  <table class="table">

    <thead class="thead-light">
      <tr>
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">id</th>
        <th scope="col">Название</th>
        <th scope="col">Операции</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($categories as $category) : ?>
        <tr>
          <th scope="col"><input type="checkbox" name="subDelete[]" value="<?= $category['id']; ?>"></th>
          <th><?= $category['id']; ?></th>
          <td><a href="/cpanel/edit-category/<?= $category['id']; ?>/"><?= $category['title']; ?></a></td>
          <td><button type="submit" name="subDelete[]" value="<?= $category['id']; ?>" class="btn btn-light">Удалить</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

  <div class="button-bottom">
    <a class="btn btn-primary" href="/cpanel/create-category/">Создать категорию</a>
    <button type="submit" class="btn btn-primary">Удалить категории</button>
    <a class="btn btn-primary" href="/cpanel/create-category-test/">Создать тестовую категорию</a>
  </div>

</form>