<footer class="c-footer">
    <div class="c-footer__logo">
        <div class="l-container">
            <a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt=""></a>
        </div>
    </div>
    <div class="c-footer__main">
        <div class="l-container">
            <div class="c-footer__link">
                <h3><a href="<?php echo esc_url(home_url('/news')) ?>">ニュース</a></h3>
                <ul class="c-boxlink">
                    <?php
                    $all_cats = get_categories(array(
                        "hide_empty" => false,  'orderby' => 'term_id',
                        'order'   => 'ASC',
                    ));
                    ?>
                    <?php if (count($all_cats) > 0) : ?>
                        <?php foreach ($all_cats as $index => $cat) : $cat_num = $index + 1; ?>
                            <li>
                                <a href="<?php echo get_category_link($cat) ?>"><?php echo $cat->name ?> </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="c-footer__link">
                <h3><a href="<?php echo esc_url(home_url('/case')) ?>">成功事例</a></h3>
                <ul class="c-boxlink">
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">法人のお客様</a></li>
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">個人のお客様</a></li>
                </ul>
            </div>

            <div class="c-footer__link">
                <ul class="c-boxlink">
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">スタッフ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">採用情報</a></li>
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">プライバシーポリシー</a></li>
                    <li><a href="<?php echo esc_url(home_url('/404')) ?>">サイトマップ</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/themes.js"></script>
<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
</body>

</html>