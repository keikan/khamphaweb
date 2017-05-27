
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="http://khamphaweb.com"><img src="img/logo.svg" alt="Khamphaweb.com"></a>
        </div>
        <div class="links">
            <a href="http://blog.khamphaweb.com" class="url active">Blog</a>
            <a href="http://khamphaweb.com/about.html" class="url">Về chúng tôi</a>
            <a href="http://khamphaweb.com/privacy.html" class="url">Điều khoản</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="main-container">
    <div class="hero-bg">
    </div>
    <div class="hero-cover">
        <div id="particles-js"></div>
    </div>
    <div class="hero-content">
        <div class="container">
            <h2 class="title">Đưa bạn tới <b>Website</b> bất kỳ trên <b>Internet</b> </h2>
            <div class="actions">
                <a class="btn -submit" href="<?= $this->Html->url(array('action' => 'requestLink')) ?>" target="_blank">
                        <span class="arrow">
                            <img src="img/arrow.svg" alt="">
                        </span>
                    <span class="icon"><i class="fa fa-mouse-pointer"></i></span>
                    <span class="txt">Click Now!</span>

                </a>
            </div>
            <div class="share">
                <div class="name">Chia sẻ:</div>
                <a href="#" class="btn -fb"><span class="-ap icon-facebook icon"></span> Facebook</a>
                <a href="#" class="btn -gg"><span class="-ap icon-google icon"></span> Google</a>
                <a href="#" class="btn -tt"><span class="-ap icon-twitter icon"></span> Twitter</a>
            </div>

        </div>
        <div class="list-links">
            <div class="li -head">
                <div class="name">Links</div>
<!--                <div class="cat">Categories</div>-->
                <div class="clearfix"></div>
            </div>

            <?php
                for($i = 0; $i< count($listLink); $i = $i + 1){
                    ?>
                    <div class="li">
                        <div class="name"><a href="<?php echo $listLink[$i]["Link"]["link"] ?>" class="url"><?php echo $listLink[$i]["Link"]["link"]; $i = $i + 1; ?></a></div>
                        <div class="cat"><a href="<?php echo $listLink[$i]["Link"]["link"] ?>" class="url"><?php echo $listLink[$i]["Link"]["link"] ?></a></div>
                        <div class="clearfix"></div>
                    </div>
                <?php
                }
            ?>

<!--            <div class="li">-->
<!--                <div class="name"><a href="#" class="url">Dantri.com</a></div>-->
<!--                <div class="cat"><a href="#" class="url">Tin Tức</a></div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
<!--            <div class="li">-->
<!--                <div class="name"><a href="#" class="url">vnepxess.com</a></div>-->
<!--                <div class="cat"><a href="#" class="url">Kinh Tế - Xã hội</a></div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
<!--            <div class="li">-->
<!--                <div class="name"><a href="#" class="url">phapluat.com</a></div>-->
<!--                <div class="cat"><a href="#" class="url">Pháp Luật</a></div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
<!--            <div class="li">-->
<!--                <div class="name"><a href="#" class="url">spa.com</a></div>-->
<!--                <div class="cat"><a href="#" class="url">Làm đẹp</a></div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
        </div>
    </div>
    <div class="footer">
        <div class="copyright">Made By <span class="icon fa fa-heart"></span> DES</div>
    </div>
</div>