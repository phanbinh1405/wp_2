<?php get_header(); ?>
<div class="c-mainvisual">
    <?php
    $images = get_field('images'); ?>
    <div class="js-slider">
        <?php if ($images) : ?>
            <?php foreach ($images as $image) : ?>
                <div>
                    <img src="<?php echo esc_url($image['image']['url']); ?>" alt="<?php echo esc_attr($image['image']['alt']); ?>" />
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<main class="<?php if (is_front_page()) {
                    echo "p-home";
                } else {
                    echo 'p-' . $page_slug;
                } ?>">
    <section class="service">
        <div class="l-container">
            <h2 class="c-title"><span>幅広い案件に対応できるひかりのワンストップサービス</span>目的に応じて、最適な方法をご提案できます</h2>
            <div class="service__inner">
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service01.png" alt="Image service 01">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service02.png" alt="Image service 02">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service03.png" alt="Image service 03">
                </div>
                <div class="service__item">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_service04.png" alt="Image service 04">
                </div>
            </div>
            <div class="l-btn l-btn--2btn">
                <div class="c-btn">
                    <a href="<?php echo get_site_url(); ?>/services">ひかり税理士法人のサービス一覧を見る</a>
                </div>
                <div class="c-btn">
                    <a href="<?php echo get_site_url(); ?>/cases">ひかり税理士法人の成功事例を見る</a>
                </div>
            </div>
        </div>
    </section>
    <section class="news">
        <div class="l-container">
            <h2 class="c-title1">
                <span class="ja">ニュース</span>
                <span class="en">News</span>
            </h2>
            <div class="news__inner">
                <ul class="c-tabs">
                    <li data-content="all" data-color="#0078d2" class="active">すべて</li>
                    <?php
                    $cats = get_categories(array(
                        'orderby' => 'ID'
                    ));
                    if ($cats) {
                        foreach ($cats as $cat) {
                            $color = get_field('color', $cat);
                            $extra_class = get_field('extra_class', $cat);
                            echo '<li data-content="' . $extra_class . '" data-color="' . $color . '">' . $cat->cat_name . '</li>';
                        }
                    }
                    ?>
                </ul>
                <div class="c-tabs__content">
                    <!-- All Posts - Display 5 Posts-->
                    <ul class="c-listpost active" id="all">
                        <?php
                        $the_query = new WP_Query(array('order' => 'DESC', 'post_type' => 'post', 'posts_per_page' => 5, 'orderby' => 'date'));
                        if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                $post = get_post();
                                $cat = get_the_category($post); ?>
                                <li class="c-listpost__item">
                                    <div class="c-listpost__info">
                                        <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                                        <div class="c-listpost__cat">
                                            <?php if (count($cat) > 1) {
                                                foreach ($cat as $cd) {
                                                    if ($cd->cat_ID != 1) {
                                            ?>
                                                        <span class="cat">
                                                            <i class="c-dotcat" style="background-color: <?php echo task14_cat($cd->cat_name); ?>"></i>
                                                            <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                                        </span>
                                                    <?php }
                                                }
                                            } else {
                                                foreach ($cat as $cd) { ?>
                                                    <span class="cat">
                                                        <i class="c-dotcat" style="background-color: <?php echo task14_cat($cd->cat_name); ?>"></i>
                                                        <a href="<?php echo get_category_link($cd->term_id); ?>"><?php echo $cd->cat_name; ?></a>
                                                    </span>
                                            <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                    <h3 class="titlepost"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                </li>
                        <?php
                            endwhile;
                        endif; ?>
                    </ul>
                    <?php
                    foreach ($cats as $cat) {
                        $color = get_field('color',$cat);
                        $extra_class = get_field('extra_class',$cat); ?>
                        <ul class="c-listpost" id="<?php echo $extra_class; ?>">
                            <?php
                            $the_query = new WP_Query(array('nopaging' => false, 'order' => 'DESC', 'post_type' => 'post', 'orderby' => 'date', 'category_name' => $cat->cat_name, 'posts_per_page' => 5));
                            if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                                    $post = get_post();?>
                                    <li class="c-listpost__item">
                                        <div class="c-listpost__info">
                                            <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
                                            <div class="c-listpost__cat">
                                                <span class="cat">
                                                    <i class="c-dotcat" style="background-color: <?php echo $color; ?>"></i>
                                                    <a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a>
                                                </span>
                                            </div>
                                        </div>
                                        <h3 class="titlepost"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
                                    </li>
                            <?php
                                endwhile;
                            endif;
                            ?>
                        </ul>
                    <?php }
                    ?>
                </div>
                <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a href="<?php echo get_site_url(); ?>/news">ニュース一覧を見る</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="publish">
        <div class="l-container">
            <h2 class="c-title1">
                <span class="ja">出版物</span>
                <span class="en">Publish</span>
            </h2>
            <div class="publish__inner">
                <ul class="c-gridpost">
                    <?php
                    $the_query = new WP_Query(array('post_type' => 'product', 'posts_per_page' => 4, 'orderby' => 'rand'));
                    if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                            $post = get_post();
                    ?>
                            <li class="c-gridpost__item">
                                <a href="<?php echo get_permalink($post->ID); ?>">
                                    <?php if (have_rows('product')) : ?>
                                        <?php while (have_rows('product')) : the_row();
                                            // Get sub field values.
                                            $public = get_sub_field('publication-date');

                                        ?>
                                            <?php
                                            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
                                            if (!empty($url)) {
                                            ?>
                                                <div class="c-gridpost__thumb">
                                                    <img src="<?php echo $url; ?>" alt="<?php echo get_the_title($post->ID);?>">
                                                </div>
                                            <?php } ?>
                                            <p class="datepost"><?php  ?></p>

                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                </a>
                            </li>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
            <div class="l-btn">
                <div class="c-btn c-btn--small">
                    <a href="<?php echo get_site_url(); ?>/publish">出版物一覧を見る</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>