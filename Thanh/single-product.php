<?php get_header(); ?>
<main class="p-publish">
    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <h1 class="c-title"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="p-news__content">
        <div class="l-container">
            <div class="p-publish__single">
                <?php $p = get_post();
                $rows = get_field('product');
                if ($rows) : ?>  
                <?php
                    $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
                    if (!empty($url)) {
                    ?>
                        <div class="feature_img">
                            <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
                        </div>
                    <?php } ?>
                <div class="p-publish__info">
                    <h2><?php echo get_the_title(); ?></h2>
                    <p class="datepost"><?php echo esc_html($rows['publication-date']); ?></p>
                    <p class="author">
                        著者  : <?php echo esc_html($rows['author']); ?><br>
                        出版社 : <?php echo esc_html($rows['publisher']); ?>
                    </p>
                    <p class="price"><?php echo esc_html($rows['price']); ?></p>
                    <div class="desc">
                        <p><?php echo esc_html($rows['description']); ?></p>
                        <h4>目次</h4>
                        <p><?php echo $rows['contents']; ?></p>
                    </div>
                </div>                                  
                <?php endif; ?>
            </div>
            <div class="l-btn">
                <div class="c-btn c-btn--small2">
                    <a href="<?php echo get_site_url(); ?>/publish">出版物一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>