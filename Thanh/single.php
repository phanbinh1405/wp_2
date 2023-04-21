<?php get_header();?>
<main class="p-news">
    <?php custom_breadcrumbs(); ?>
    <div class="p-news__content">
        <div class="l-container">
            <?php
            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
            if(!empty($url)){
            ?>
            <div class="feature_img">
                <img src="<?php echo $url; ?>" alt="<?php single_post_title(); ?>">
            </div>
            <?php }?>
            <div class="c-ttlpostpage">
                <h2><?php the_title(); ?></h2>
                <span><?php echo get_the_date('Y年m月d日'); ?></span>
                <?php
                $cat = get_the_category(); ?>
                <div class="c-listpost__catlist">
                    <?php
                    if ($cat) {
                        foreach ($cat as $cd) {
                    ?>
                            <span class="c-listpost__cat">
                                <i class="c-dotcat" style="background-color: <?php echo task14_cat($cd->cat_name); ?>"></i>
                                <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                            </span>
                    <?php }
                    } ?>
                </div>
            </div>

            <div class="single__content">
                <p>実務経営研究会が発行する「月刊実務経営ニュース」2018年2月号に弊所中小企業診断士 西村の記事が掲載されました。</p>

                <p class="u-center">▽▽詳細はこちら▽▽</p>

                <p class="u-center u-bborder">さあ、顧問先育成型会計事務所へ！~業務改善をもたらすMAS指導の実際~</p>
            </div>

            <div class="l-btn">
                <div class="c-btn c-btn--small2">
                    <a href="<?php echo get_site_url(); ?>/news">ニュース一覧を見る</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>