<?php get_header();
$post_type = get_post_type();
$post_type_object = get_post_type_object($post_type);?>
<main class="p-product">
	<?php custom_breadcrumbs(); ?>
	<div class="c-headpage">
		<h1 class="c-title"><?php echo get_the_title(21); ?></h1>
        <p>ひかり税理士法人では、税務・会計・経営・相続などに関する書籍の執筆を行っています。</p>
    </div>
    <div class="l-container">
        <div class="p-publish__content">
            <ul class="c-gridpost">
                <?php
                $page = get_query_var('paged', 1);
                $the_query = new WP_Query(array('order' => 'DESC', 'post_type' => 'product', 'posts_per_page' => 12, 'orderby' => 'date', 'paged' => $page));
                if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                        $post = get_post();
                        $rows = get_field('product');
                        if ($rows) : ?>
                            <li class="c-gridpost__item">
                                <?php
                                $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
                                if (!empty($url)) {
                                ?>
                                    <div class="c-gridpost__thumb">
                                        <img src="<?php echo $url; ?>" alt="<?php echo get_the_title($post->ID); ?>">
                                    </div>
                                <?php } ?>
                                <div class="c-gridpost__info">
                                    <p class="datepost"><?php echo esc_html($rows['publication-date']); ?></p>
                                    <h3><?php echo get_the_title($post->ID); ?></h3>
                                    <p class="price"><?php echo esc_html($rows['price']); ?></p>
                                    <a href="<?php echo get_permalink($post->ID); ?>" class="c-btnview">詳しく見る</a>
                                </div>
                            </li>
                <?php
                        endif;
                    endwhile;
                endif; ?>
            </ul>
            <div class="c-pagination c-ajaxpublish">
                <?php
                echo pagination_tdc($the_query, 1, 'publish');
                wp_reset_postdata();  ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>