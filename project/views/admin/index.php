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
    <?php foreach ($posts as $post) : ?>
      <tr>
        <th scope="row"><?php echo $post['id']; ?></th>
        <td><?php echo $post['date']; ?></td>
        <td><a href="/cpanel/edit-post/<?= $post['id']; ?>/"><?php echo $post['title']; ?></a></td>
        <td><?php echo $post['category']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>

</table>