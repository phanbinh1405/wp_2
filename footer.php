<footer class="c-footer">
    <?php wp_footer(); ?>
        <div class="c-footer__logo">
            <div class="l-container">
                <a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri( ); ?>/assets/img/logo.png" alt=""></a>
            </div>
        </div>
        <div class="c-footer__main">
            <div class="l-container">
                <div class="c-footer__link">
                    <h3><a href="news.html">ニュース</a></h3>
                    <ul class="c-boxlink">
                        <li><a href="#">お知らせ</a></li>
                        <li><a href="#">税の最新情報</a></li>
                        <li><a href="#">税制改正</a></li>
                        <li><a href="#">掲載情報</a></li>
                        <li><a href="#">バックナンバー</a></li>
                    </ul>
                </div>

                <div class="c-footer__link">
                    <h3><a href="cases.html">成功事例</a></h3>
                    <ul class="c-boxlink">
                        <li><a href="#">法人のお客様</a></li>
                        <li><a href="#">個人のお客様</a></li>
                    </ul>
                </div>

                <div class="c-footer__link">
                    <ul class="c-boxlink">
                        <li><a href="staff.html">スタッフ</a></li>
                        <li><a href="recruit.html">採用情報</a></li>
                        <li><a href="privacy.html">プライバシーポリシー</a></li>
                        <li><a href="sitemap.html">サイトマップ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="<?php echo get_template_directory_uri( ); ?>/assets/js/themes.js"></script>
</body>

</html>