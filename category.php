<?php
$cate = get_queried_object();
get_header();
global $wp_query;
$big = 999999999;
$total_pages = $wp_query->max_num_pages;

$pagination_args = array(
    "prev_text" => __(''),
    "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
    "format" => "?paged=%#%",
    'current' => max( 1, get_query_var('paged') ),
    'total' => $total_pages,
    "next_text" => __(''),
    "mid_size" => 6
);
?>

<main class="p-news">

    <?php get_breadcrumb() ?>

    <div class="c-headpage">
        <h2 class="c-title"><?php echo 'ニュース・' . $cate->name ?> </h2>
    </div>
    <div class="p-news__content">
        <div class="l-container">
            <ul class="c-listpost" id="cat_1">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post() ?>
                        <li class="c-listpost__item">
                            <div class="c-listpost__info">
                                <span class="datepost"><?php echo get_the_date('Y年m月d日') ?></span>
                                <span class="cat">
                                    <i class="c-dotcat" style="background-color: <?php echo get_field('color', $cate) ?>"></i>
                                    <a href="news-cat.html"><?php echo $cate->name ?></a>
                                </span>
                            </div>
                            <h3 class="titlepost"><a href="<?php echo the_permalink() ?>"><?php the_title() ?></a></h3>
                        </li>
                <?php endwhile;
                endif; ?>
            </ul>
            <div class="c-pagination">
                <?php
                echo paginate_links($pagination_args)
                ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer() ?>