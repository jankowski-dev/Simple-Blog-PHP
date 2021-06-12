<?php include_once 'project/layouts/user/header.php' ?>


<main class="customContainer">
    <div class="wrapper">
        <div class="shortInfo">
            <div class="categoryBlock p-bot-20">
                <svg id="iconCategory" class="iconLg i-blue">
                    <use xlink:href="/project/webroot/libraries/svg/icon.svg#cpu"></use>
                </svg>
                <h3 class="black"><?= $post['category'] ?></h3>
            </div>
            <h1 class="p-bot-20"> <?= $post['title'] ?> </h1>
            <p class="black p-bot-10"><?= $post['description'] ?></p>
            <div class="paramsPost bg-gray black">
                <div class="paramsPostItem">
                    <svg id="iconStatic" class="iconSm i-black">
                        <use xlink:href="/project/webroot/libraries/svg/icon.svg#glass"></use>
                    </svg>
                    <span class="black">126</span>
                </div>
                <div class="paramsPostItem">
                    <svg id="iconStatic" class="iconSm i-black">
                        <use xlink:href="/project/webroot/libraries/svg/icon.svg#comment"></use>
                    </svg>
                    <span class="black">8</span>
                </div>
                <div class="paramsPostItem">
                    <svg id="iconStatic" class="iconSm i-black">
                        <use xlink:href="/project/webroot/libraries/svg/icon.svg#calendar"></use>
                    </svg>
                    <span class="black"><?= $object->getDate($post['date']) ?></span>
                </div>
            </div>
        </div>
        <div class="fullInfo">
            <img src="/project/webroot/img/post_image/<?= $post['image'] ?>" alt="">
            <?= $post['story'] ?>
        </div>


        <div class="postParams">
            <div class="tagParams">
                <div class="titleParams">Tags</div>
                <div class="tagContent"><a href="">#user</a>, <a href="">#time</a>, <a href="">#similar</a>, <a href="">#runtime</a>, <a href="">#each</a></div>
            </div>
            <div class="relatedParams">
                <div class="titleParams">Recommended</div>
                <div class="relatedContent">
                    <ul>
                        <li><a href="#">Big things I’ve learned by 24. I hope they can save you some time</a></li>
                        <li><a href="#">For example, when you are in your living room, your mind perceives</a></li>
                        <li><a href="#">I’ve always wished I had a life user manual of sorts, ike the one you get</a></li>
                        <li><a href="#">Together the big things I’ve learned by 24. I hope they can save you some</a></li>
                        <li><a href="#">Big things I’ve learned by 24. I hope they can save you some time</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="comment">
            <div class="commenttotal">Комметариев: 78</div><br>
            <div class="addComent">
                <form action="" method="POST">
                    <div class="form-group">
                        <textarea rows="8" name="comment" class="form-control"></textarea>
                        <small id="emailHelp" class="form-text text-muted">Максимальное количество знаков 2000</small>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary margin-top-20">Опубликовать</button>
                </form>
            </div><br><br>


            <div class="commentList">
                <?php foreach ($comments as $comment) : ?>
                    <div class="commentListItem">
                        <div class="commentItem">
                            <div class="commentAuthor">Влад Янковский написал:</div>
                            <div class="commentText"><?= $comment['text']; ?></div>
                        </div>
                    </div><br>
                <?php endforeach; ?>


            </div><br>

        </div>


    </div>
</main>

<?php include_once 'project/layouts/user/footer.php' ?>