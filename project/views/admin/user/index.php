<?php include_once 'project\layouts\admin\header.php' ?>

<form method="POST" action="">
  <table class="table">

    <thead class="thead-light">
      <tr>
        <th scope="col"><input type="checkbox"></th>
        <th scope="col">id</th>
        <th scope="col">Дата регистрации</th>
        <th scope="col">Имя</th>
        <th scope="col">Постов</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <th scope="col"><input type="checkbox" name="checkbox[]" value="<?= $user['id']; ?>"></th>
          <th><?= $user['id']; ?></th>
          <td><?= $user['reg_date']; ?></td>
          <td><a href="/cpanel/user/<?= $user['id']; ?>/"><?= $user['name']; ?></a></td>
          <td><?= $user['posts']; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

  <div class="button-bottom">
    <a class="btn btn-primary" href="/cpanel/create-post/">Забанить</a>
    <button type="submit" name="submit" class="btn btn-primary">Перевести в группу</button>
    <a class="btn btn-primary" href="/cpanel/create-post-test/">Создать юзера {тест}</a>
  </div>

</form>