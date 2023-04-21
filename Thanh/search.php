<?php get_header();
$s = get_search_query();
$args = array(
    's' => $s
);
// The Query
$the_query = new WP_Query($args); ?>
<main class="p-search">
    <div class="c-headpage">
        <h1 class="c-title"><?php echo __('SEARCH RESULT', 'task14'); ?></h1>
    </div>
    <div class="l-container">
        <div class="c-listpost" id="cat_all" data-content="すべて">
            <ul>
                <?php
                // Start the Loop.
                if (have_posts()) : while (have_posts()) : the_post();
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
            <?php echo pagination_tdc($the_query, 1, '?s=');
            wp_reset_postdata(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>