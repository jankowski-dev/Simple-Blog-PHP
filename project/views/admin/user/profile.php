<?php include_once 'project\layouts\admin\header.php' ?>

<div class="container">
  <div class="row">
    <div>
    <img scr="#"><br>
    Имя: <?= $user['name']; ?><br>
    Email: <?= $user['email']; ?><br>
    Страна: <?= $user['country']; ?><br>
    Кол-во постов: <?= $post['count'] ?><br>
    Кол-во комментариев: <?= $user['comm_num']; ?><br>
    </div>
  </div>
</div>