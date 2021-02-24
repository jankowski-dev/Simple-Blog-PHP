<b>Это админпанель</b><br>
Привет, <?php echo $_SESSION['name'];  ?><br>
Ваша почта: <?php echo $_SESSION['email']; ?><br>
Ваша страна: <?php echo $_SESSION['country']; ?><br>
 <a href="/logout/">Выйти</a>



<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Дата</th>
      <th scope="col">Заголовок</th>
      <th scope="col">Категория</th>
    </tr>
  </thead>
  <tbody>

<?php foreach($posts as $post) : ?>
    <tr>
      <th scope="row"><?php echo $post['id']; ?></th>
      <td><?php echo $post['date']; ?></td>
      <td><?php echo $post['title']; ?></td>
      <td><?php echo $post['category']; ?></td>
    </tr>

    <?php endforeach; ?>

    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>