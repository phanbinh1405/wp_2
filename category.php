<?php
$cate = get_queried_object();
get_header();

$big = 999999999;
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$query_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'cat' => $cate->term_id,
    'paged' =>  $paged
);

$query = new WP_Query($query_args);
$total_pages = $query->max_num_pages;

$pagination_args = array(
    "prev_text" => __(''),
    "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
    "format" => "?paged=%#%",
    "current" => $paged,
    "total" => $total_pages,
    "next_text" => __(''),
    "mid_size" => 6
);
?>

<main class="p-news">
    <!-- <div class="c-breadcrumb">
        <div class="l-container">
            <a href="index.html">Home</a>
            <a href="news.html">ニュース・お知らせ</a>
            <span>お知らせ</span>
        </div>
    </div> -->
    <?php get_breadcrumb() ?>

    <div class="c-headpage">
        <h2 class="c-title"><?php echo 'ニュース・' . $cate->name ?> </h2>
    </div>
    <div class="p-news__content">
        <div class="l-container">
            <ul class="c-listpost" id="cat_1">
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post() ?>
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