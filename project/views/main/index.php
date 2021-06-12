<?php include_once 'project/layouts/user/header.php' ?>

<div class="headerInfo bg-blue">

    <div class="titleBlock">
        <div class="categoryBlock">
            <svg id="iconCategory" class="iconLg i-white">
                <use xlink:href="/project/webroot/libraries/svg/icon.svg#cpu"></use>
            </svg>
            <h3><?= $mainPost['category'] ?></h3>
        </div>
        <h1><?= $mainPost['title'] ?></h1>
        <p class="white"><?= $mainPost['description'] ?></p>
        <a href="/post/<?= $mainPost['id'] ?>/" id="buttonTrans" class="button">Learn more</a>
    </div>

    <div class="imageBlock"></div>

</div>

</header>



<main class="customContainer">
    <div class="wrapper p-top-30">

        <div class="filter p-bot-20">
            <div class="flexContainerRow">
                <svg id="iconStatic" class="iconSm i-black">
                    <use xlink:href="/project/webroot/libraries/svg/icon.svg#star"></use>
                </svg>
                <h3 class="dark-gray p-top-5">Popular posts</h3>
            </div>
            <a href="#" id="buttonGray" class="button"><svg id="iconButton" class="iconXs">
                    <use xlink:href="/project/webroot/libraries/svg/icon.svg#hamburger"></use>
                </svg>Sort by</a>
        </div>


        <?php if ($fixedPosts !== false) : ?>
            <?php foreach ($fixedPosts as $fixedPost) : ?>
                <article class="shortPost red">
                    <div class="categoryBlock p-bot-20">
                        <svg id="iconCategory" class="iconSm i-black">
                            <use xlink:href="/project/webroot/libraries/svg/icon.svg#cpu"></use>
                        </svg>
                        <h4 class="blue"><?= $fixedPost['category'] ?></h3>
                    </div>
                    <a href="/post/<?= $fixedPost['id'] ?>/" class="black">
                        <h2><?= $fixedPost['title'] ?></h2>
                    </a>
                    <p>I’ve always wished I had a life user manual of sorts. Like the one you get when you buy new software; full of tips and tricks on how to use the thing. I believe it would save me from making so many dumb mistakes. So in this letter, I’ve
                        put together the big things I’ve learned by 24.</p>
                    <div class="paramsPost bg-light-blue">
                        <div class="paramsPostItem">
                            <svg id="iconStatic" class="iconSm i-blue">
                                <use xlink:href="/project/webroot/libraries/svg/icon.svg#glass"></use>
                            </svg>
                            <span>126</span>
                        </div>
                        <div class="paramsPostItem">
                            <svg id="iconStatic" class="iconSm i-blue">
                                <use xlink:href="/project/webroot/libraries/svg/icon.svg#comment"></use>
                            </svg>
                            <span>8</span>
                        </div>
                        <div class="paramsPostItem">
                            <svg id="iconStatic" class="iconSm i-blue">
                                <use xlink:href="/project/webroot/libraries/svg/icon.svg#calendar"></use>
                            </svg>
                            <span><?= $date->getDate($fixedPost['date']) ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>


        <?php foreach ($posts as $post) : ?>
            <article class="shortPost">
                <div class="categoryBlock p-bot-20">
                    <svg id="iconCategory" class="iconSm i-black">
                        <use xlink:href="/project/webroot/libraries/svg/icon.svg#cpu"></use>
                    </svg>
                    <h4 class="blue"><?= $post['category'] ?></h3>
                </div>
                <a href="/post/<?= $post['id'] ?>/" class="black">
                    <h2><?= $post['title'] ?></h2>
                </a>
                <p>I’ve always wished I had a life user manual of sorts. Like the one you get when you buy new software; full of tips and tricks on how to use the thing. I believe it would save me from making so many dumb mistakes. So in this letter, I’ve
                    put together the big things I’ve learned by 24.</p>
                <div class="paramsPost bg-light-blue">
                    <div class="paramsPostItem">
                        <svg id="iconStatic" class="iconSm i-blue">
                            <use xlink:href="/project/webroot/libraries/svg/icon.svg#glass"></use>
                        </svg>
                        <span>126</span>
                    </div>
                    <div class="paramsPostItem">
                        <svg id="iconStatic" class="iconSm i-blue">
                            <use xlink:href="/project/webroot/libraries/svg/icon.svg#comment"></use>
                        </svg>
                        <span>8</span>
                    </div>
                    <div class="paramsPostItem">
                        <svg id="iconStatic" class="iconSm i-blue">
                            <use xlink:href="/project/webroot/libraries/svg/icon.svg#calendar"></use>
                        </svg>
                        <span><?= $date->getDate($post['date']) ?></span>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>


        <div id="articleButton" class="p-bot-50">
            <a href="#" id="buttonBlue" class="button">Learn more</a>
        </div>

    </div>
</main>

<?php include_once 'project/layouts/user/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>