<?php

/**
 * Functions and definitions
 *
 * @link None
 *
 * @package WordPress
 * @subpackage Task14
 * @since Tran Diep Thanh Thanh
 */
/*
  @ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
  */
if (!isset($content_width)) {
    $content_width = 1000;
}
/*
  @ Thiết lập các chức năng sẽ được theme hỗ trợ
  */
if (!function_exists('task14_theme_setup')) :
    function task14_theme_setup()
    {
        /*
        * Thiết lập textdomain
        */
        load_theme_textdomain('task14', get_template_directory() . '/languages');
        /*
        * Tự chèn RSS Feed links trong <head>
        */
        add_theme_support('automatic-feed-links');
        /*
        * Thêm chức năng post thumbnail
        */
        add_theme_support('post-thumbnails');
        /*
        * Thêm chức năng post format
        */
        add_theme_support('post-formats',  array('aside', 'gallery', 'quote', 'image', 'video'));
        /*
        * Thêm chức năng title-tag để tự thêm <title>
        */
        add_theme_support('title - tag');
        /*
        * Thêm chức năng custom background
        */
        $default_background = array(
            'default - color' => '',
        );
        add_theme_support('custom - background', $default_background);
        /*
        * Tạo menu cho theme
        */
        register_nav_menus(array(
            'primary'   => __('Primary Menu', 'task14'),
            'secondary' => __('Secondary Menu', 'task14'),
            'footer' => __('Footer Menu', 'task14')
        ));
        /*
        * Tạo sidebar cho theme
        */
        $sidebar = array(
            'name' => __('Main Sidebar', 'task14'),
            'id' => 'main-sidebar',
            'description' => 'Main sidebar for task14 theme',
            'class' => 'main-sidebar'
        );
        register_sidebar($sidebar);
        register_sidebar(array(
            'name' => 'Footer Main',
            'id' => 'footer-main',
            'description' => 'Appears in the footer area',
            'before_widget' => '<div class="c-footer__link">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
            'class' => 'c-footer__link'
        ));
        /*
        * Theme suppport block theme
        */
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
        add_theme_support('editor-styles');
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
                'search-form',
            )
        );
        add_theme_support('custom-header');
        // Add support for Block Styles.
        add_theme_support('widgets');
        add_theme_support('widgets-block-editor');

        // Add support for full and wide align images.
        add_theme_support('align-wide');
        // Add support for experimental cover block spacing.
        add_theme_support('custom-spacing');

        // Add support for custom units.
        // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
        add_theme_support('custom-units');

        // Remove feed icon link from legacy RSS widget.
        add_filter('rss_widget_feed_link', '__return_false');

        $editor_stylesheet_path = './style.css';

        // Enqueue editor styles.
        add_editor_style($editor_stylesheet_path);
    }

endif;

add_action('after_setup_theme', 'task14_theme_setup');
/*
@ Thiết lập hàm hiển thị logo
@ task_logo()
*/
if (!function_exists('header_image')) :
    function header_image()
    {
        $image = get_header_image();

        if ($image) {
            echo esc_url($image);
        }
    }
endif;
if (!function_exists('task14_top')) {
    function task14_top()
    { ?>
        <?php if (is_front_page()) { ?>
            <h1 class="c-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php header_image(); ?>" alt="ひかり税理士法人" /></a>
            </h1>
        <?php } else { ?>
            <div class="c-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php header_image(); ?>" alt="ひかり税理士法人" /></a>
            </div><?php } ?>
    <?php }
}

/*
  @ Thiết lập hàm hiển thị menu
  */
if (!function_exists('task14_menu')) {
    function task14_menu($slug)
    {
        $menu = array(
            'theme_location' => $slug,
            'menu_class' => $slug,
            'container' => 'nav',
            'container_class' => 'c-gnav',
        );
        wp_nav_menu($menu);
    }
}
//Active menu item
function additional_active_item_classes($classes = array(), $menu_item){
    global $wp;
    global $wp_query;

    if ( home_url( $wp->request ) == rtrim($menu_item->url,"/") ) {
        $classes[] = 'active';
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );
/* pagination - load page*/
function pagination($custom_query = null, $paged = 1)
{
    global $wp_query, $wp_rewrite;
    if ($custom_query) $main_query = $custom_query;
    else $main_query = $wp_query;
    $big = 999999999;
    $total = isset($main_query->max_num_pages) ? $main_query->max_num_pages : '';
    if ($total > 1) echo '<div class="c-pagination">';
    echo paginate_links(array(
        'base' => trailingslashit(esc_url(get_pagenum_link())) . "{$wp_rewrite->pagination_base}/%#%/",
        'format'   => '?paged=%#%',
        'current'  => max(1, get_query_var('paged')),
        'total'    => $total,
        'mid_size' => '5',
        'prev_text'    => __('', 'task14'),
        'next_text'    => __('', 'task14'),
    ));
    if ($total > 1) echo '</div>';
}
/* pagination ajax */
function pagination_tdc($wp_query, $paged, $type)
{
    if ($wp_query->max_num_pages <= 1)
        return;
    $paged = $paged;
    $max = intval($wp_query->max_num_pages);

    if ($paged >= 1) {
        $links[] = $paged;
    }
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    $html = '';
    if ($paged - 1 > 0) {
        $prev = $paged - 1;
        $html .= '<a rel="nofollow" class="prev page-numbers" href="' . build_url($prev, $type) . '" ></a>';
    }

    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="current"' : '';
        if (!$class) {
            $html .= '<a rel="nofollow" class="page-numbers" href="' . build_url(1, $type) . '" >1</a>';
        } else {
            $html .= '<span ' . $class . '>1</span>';
        }
        if (!in_array(2, $links))
            $html .= '<span>…</span>';
    }

    sort($links);
    foreach ((array) $links as $link) {
        $class = $paged == $link ? ' class="current"' : '';
        if (!$class) {
            $html .= '<a rel="nofollow" class="page-numbers" href="' . build_url($link, $type) . '">' . $link . '</a>' . "\n";
        } else {
            $html .= '<span ' . $class . '>' . $link . '</span>';
        }
    }

    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links)) $html .= '<li>…</li>' . "\n";
        $class = $paged == $max ? 'current ' : '';
        $html .= '<a rel="nofollow" class="' . $class . 'page-numbers" href="' . build_url($max, $type) . '">' . $max . '</a>';
    }

    if ($paged + 1 <= $max) {
        $next = $paged + 1;
        $html .= '<a rel="nofollow" class="next page-numbers" href="' . build_url($next, $type) . '" ></a>';
    }
    return $html;
}

function build_url($paged, $type)
{
    $url = home_url("/$type/page/" . $paged);
    return $url;
}
//ajax page news
function ajax_load_page()
{
    $result['type'] = 'error';
    $result['message'] = "Error";

    $paged = $_POST['paged'];
    $cat = $_POST['cat'];
    $id = $_POST['id'];
    $type = $_POST['slug'];
    if ($cat == "すべて") {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged,
            'order' => 'DESC'
        );
    } else {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'category_name' => $cat,
            'paged' => $paged,
            'order' => 'DESC'
        );
    }
    $the_query = new WP_Query($args);
    ob_start();
    if (is_wp_error($the_query)) {
        $result = json_encode($result);
    } else { ?>
        <ul>
            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
                    $post = get_post();
                    $cat = get_the_category(); ?>
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
            endif;
            ?>
            </ul>
            <div class="c-pagination c-ajax">
                <?php
                echo pagination_tdc($the_query, $paged, $type);
                wp_reset_postdata(); ?>
            </div>
            <?php
        }
        $content = ob_get_contents();
        ob_end_clean();
        $result['type'] = "success";
        $result['message'] = "Success!";
        $result['content'] = $content;
        $result = json_encode($result);
        echo $result;
        die();
    }
    add_action('wp_ajax_nopriv_ajax_load_page', 'ajax_load_page');
    add_action('wp_ajax_ajax_load_page', 'ajax_load_page');
// ajax load publish
function ajax_load_pagepublish()
{
    $result['type'] = 'error';
    $result['message'] = "Error";

    $paged = $_POST['paged'];
    $type = $_POST['slug'];

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 12,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $the_query = new WP_Query($args);
    ob_start();
    if (is_wp_error($the_query)) {
        $result = json_encode($result);
    } else { ?>
        <ul class="c-gridpost">
            <?php
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
            echo pagination_tdc($the_query, $paged, $type);
            wp_reset_postdata();  ?>
        </div>
        <?php
    }
    $content = ob_get_contents();
    ob_end_clean();
    $result['type'] = "success";
    $result['message'] = "Success!";
    $result['content'] = $content;
    $result = json_encode($result);
    echo $result;
    die();
}
add_action('wp_ajax_nopriv_ajax_load_pagepublish', 'ajax_load_pagepublish');
add_action('wp_ajax_ajax_load_pagepublish', 'ajax_load_pagepublish');
    /*
  @ Hàm hiển thị tiêu đề của post trong .entry-header
  **/
    if (!function_exists('task14_entry_header')) {
        function task14_entry_header()
        {
            if (is_single()) { ?>
                <div class="c-title c-title--page">
                    <h1>TOPICS</h1>
                </div>
                <?php } else { ?>?>
                <div class="c-title c-title--page">
                    <h1><?php the_title_attribute(); ?></h1>
                </div>
            <?php } ?>
        <?php
        }
    }
    /*
  @ Hàm hiển thị thông tin của post (Post Meta)
  @ thachpham_entry_meta()
  **/
    if (!function_exists('task14_entry_meta')) {
        function task14_entry_meta()
        {
            if (!is_page()) :
                echo '<div class="entry-meta">';
                // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
                printf(
                    __('<span class="author">Posted by %1$s</span>', 'task14'),
                    get_the_author()
                );


                printf(
                    __('<span class="date-published"> at %1$s</span>', 'task14'),
                    get_the_date()
                );


                printf(
                    __('<span class="category"> in %1$s</span>', 'task14'),
                    get_the_category_list(', ')
                );


                // Hiển thị số đếm lượt bình luận
                if (comments_open()) :
                    echo ' <span class="meta-reply">';
                    comments_popup_link(
                        __('Leave a comment', 'task14'),
                        __('One comment', 'task14'),
                        __('% comments', 'task14'),
                        __('Read all comments', 'task14')
                    );
                    echo '</span>';
                endif;
                echo '</div>';
            endif;
        }
    }
    /*
  @ Hàm hiển thị nội dung của post type
  @ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
  @ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
  **/
    if (!function_exists('task14_entry_content')) {
        function task14_entry_content()
        {
            if (!is_single()) :
                the_excerpt();
            elseif (is_single()) :
                the_content();
                /*
* Code hiển thị phân trang trong post type
*/
                $link_pages = array(
                    'before' => __('<p>Page:', 'task14'),
                    'after' => '</p>',
                    'nextpagelink' => __('Next page', 'task14'),
                    'previouspagelink' => __('Previous page', 'task14')
                );
                wp_link_pages($link_pages);
            endif;
        }
    }
    //Classic Editor
    add_filter('use_block_editor_for_post', '__return_false');
    //Edit search form
    function custom_search_form($form)
    {
        $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url() . '" >
    <div class="custom-form"><label class="screen-reader-text" for="s">' . __('Search:') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input class="c-search__submit" type="submit" id="searchsubmit" value="' . esc_attr__('近日公開') . '" />
    </div>
    </form>';

        return $form;
    }
    add_filter('get_search_form', 'custom_search_form', 40);
    /* Filter and add color for category */
    if (!function_exists('task14_cat')) {
        function task14_cat($cat)
        {
            if ($cat == 'お知らせ') {
                return '#1bb7c5';
            } elseif ($cat == '税の最新情報') {
                return '#d6772a';
            } elseif ($cat == '税制改正') {
                return '#c4a021';
            } elseif ($cat == '掲載情報') {
                return '#416ad3';
            } elseif ($cat == 'バックナンバー') {
                return '#cccccc';
            }
        }
    }
    function custom_post_type()
    {
        register_post_type(
            'product',
            array(
                'labels'      => array(
                    'name'          => __('Publish', 'task14'),
                    'singular_name' => __('Publish', 'task14'),
					'taxonomies'    => __('Publish Categories','task14')
                ),
                'public'      => true,
                'has_archive' => true,
				'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
                'rewrite'     => array(
                    'slug' => 'publish',
                    'with_front' => false
                ), // my custom slug
            )
        );
    }
    add_action('init', 'custom_post_type');
    function add_service()
    {
        register_post_type(
            'service',
            array(
                'labels'      => array(
                    'name'          => __('Services', 'task14'),
                    'singular_name' => __('Service', 'task14')
                ),
                'public'      => true,
                'has_archive' => true,
				'supports' => array( 'title', 'editor', 'custom-fields','thumbnail' ),
                'rewrite'     => array(
                    'slug' => 'services',
                    'with_front' => false
                ), // my custom slug
            )
        );
    }
    add_action('init', 'add_service');

    /**
     * Add custom taxonomies
     */
    function add_custom_taxonomies()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('product-category', 'product', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Publish Categories', 'task14'),
                'singular_name' => __('Publish Category', 'task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_taxonomies', 0);
    function add_custom_service()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('service-category', 'service', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Type of Service','task14'),
                'singular_name' => __('Type of Service','task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_service', 0);
    function add_custom_service2()
    {
        // Add new "Locations" taxonomy to Posts
        register_taxonomy('service-category2', 'service', array(
            // Hierarchical taxonomy (like categories)
            'hierarchical' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => __('Content of Service','task14'),
                'singular_name' => __('Content of Service', 'task14')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => '', // This controls the base slug that will display before each term
                'with_front' => false, // Don't display the category base before "/locations/"
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
            ),
        ));
    }
    add_action('init', 'add_custom_service2', 2);
    // Breadcrumbs
    function custom_breadcrumbs()
    {

        // Settings
        $breadcrums_class   = 'c-breadcrumb';
        $home_title         = 'Home';

        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        $custom_taxonomy    = 'product_cat';

        // Get the query & post information
        global $post, $wp_query;

        // Do not display on the homepage
        if (!is_front_page()) {
            // Build the breadcrums
            echo '<div class="' . $breadcrums_class . '">
        <div class="l-container">';

            // Home page
            echo '<a href="' . get_home_url() . '">' . $home_title . '</a>';

            if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            $post_type = get_post_type();
            if ($post_type == 'post') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>' . $post_type_object->labels->name . '</span>';
            }
            if ($post_type == 'product') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>出版物</span>';
            }
            if ($post_type == 'service') {
                $post_type_object = get_post_type_object($post_type);
                echo '<span>ご提供サービス</span>';
            }
        } else if (is_single()) {

            // If post is a custom post type
            $post_type = get_post_type();
            // If it is a custom post type display name and link
            if ($post_type == 'product') {
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                echo '<a href="' . $post_type_archive . '">出版物</a>';
            }
            if ($post_type == 'post') {
                echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
            }
            if ($post_type == 'service') {
                echo '<a href="' . get_site_url() . '/services">ご提供サービス</a>';
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
            }
                // If it's a custom post type within a custom taxonomy
                $taxonomy_exists = taxonomy_exists($custom_taxonomy);
                if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {

                    $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                    $cat_id         = $taxonomy_terms[0]->term_id;
                    $cat_nicename   = $taxonomy_terms[0]->slug;
                    $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                    $cat_name       = $taxonomy_terms[0]->name;
                }

                // Check if the post is in a category
                if (!empty($last_category)) {
                    // echo $cat_display;
                    echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                    echo '<span>' . get_the_title() . '</span>';

                    // Else if post is in a custom taxonomy
                } else if (!empty($cat_id)) {

                    echo '<a href="' . $cat_link . '">' . $cat_name . '</a>';
                    echo '<span>' . get_the_title() . '</span>';
                } else {
                    echo '<span>' . get_the_title() . '</span>';
                }
            } else if (is_category()) {
                echo '<a href="' . get_site_url() . '/news">ニュース・お知らせ</a>';
                // Category page
                echo '<span>ニュース' . single_cat_title('', false) . '</span>';
            } else if (is_page()) {
				// If child page, get parents 
            $anc = get_post_ancestors( $post->ID );
                   
            // Get parents in the right order
            $anc = array_reverse($anc);
               
            // Parent page loop
            if ( !isset( $parents ) ) $parents = null;
            foreach ( $anc as $ancestor ) {
                $parents .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
            }               
            // Display parent pages
            echo $parents;
               
            // Current pageF
                echo '<span>' . get_the_title() . '</span>';
            } else if (get_query_var('paged')) {

                // Paginated archives
                echo '<span>' . __('Page') . ' ' . get_query_var('paged') . '</span>';
            } else if (is_search()) {

                // Search results page
                echo '<span>Search results for: ' . get_search_query() . '</span>';
            }
            echo '</div></div>';
        }
    }
    function filter_service_category()
    {
        $result['type'] = 'error';
        $result['message'] = "Error";

        $b = $_POST['checked'];
        $b2 = $_POST['checked2'];
        $args = array(
            'post_type' => 'service', 'posts_per_page' => -1
        );

        if (!empty($b) || !empty($b2)) {
            $args['tax_query'] = [
                'relation' => 'OR',
                array(
                    'taxonomy' => 'service-category',
                    'field' => 'term_id',
                    'terms' => $b,
                ),
                array(
                    'taxonomy' => 'service-category2',
                    'field' => 'term_id',
                    'terms' => $b2,
                )
            ];
        }

        $the_query = new WP_Query($args);

        if (is_wp_error($the_query)) {
            $result = json_encode($result);
        } elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
            $result['type'] = 'empty';
            $result['message'] = "Null";
            $result = json_encode($result);
        } else {

            $posts = $the_query->posts;
            ob_start(); ?>
            <?php foreach ($the_query->posts as $post) {
                $rows = get_field('service', $post->ID);
                if ($rows) : ?>
                    <li class="c-column__item"><a href="<?php echo get_permalink($post->ID); ?>">
                            <?php if ($rows['icon']) { ?>
                            	<img src="<?php echo esc_url($rows['icon']['url']); ?>" alt="<?php echo get_the_title($post->ID); ?>">
                        	<?php } ?>
                            <p><?php echo get_the_title($post->ID); ?></p>
                        </a>
                    </li>
    <?php endif;
            }
            wp_reset_postdata();
            $content = ob_get_contents();
            ob_end_clean();
            $result['type'] = "success";
            $result['message'] = "Success!";
            $result['content'] = $content;
            $result['count'] = $the_query->post_count;
            $result = json_encode($result);
        }

        echo $result;
        die();
    }
    add_action('wp_ajax_nopriv_filter_service_category', 'filter_service_category');
    add_action('wp_ajax_filter_service_category', 'filter_service_category');

    function showr($post)
    {
        print("<pre>" . print_r($post, true) . "</pre>");
    }
// Active post type when it's in single page
    function custom_active_item_classes($classes = array(), $menu_item) {
        global $post;
    
        // Get post ID, if nothing found set to NULL
        $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
    
        // Checking if post ID exist...
        if (isset( $id )){
            if(($menu_item->url == get_post_type_archive_link($post->post_type))){
                $classes[] =  'current-menu-item active';
            }
            else{
                $classes[]='';
            }
        }
    
        return $classes;
    }
    add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );
// RENAME field label ACF (for dev)
function renameFieldNameAcf($fields){
    if (is_array($fields) && !empty($fields)){
        foreach ($fields as $key => $field) {
            $fields[$key]['label'] = __($field['label']);
            if (isset($field['sub_fields'])){
                $fields[$key]['sub_fields'] = renameFieldNameAcf($field['sub_fields']);
            }
        }
    }
    return $fields;
}
function renameFieldNameAcf__callback($fields){
    $fields = renameFieldNameAcf($fields);
    return $fields;
}
if (class_exists('ACF')){
    add_filter( 'acf/pre_render_fields', 'renameFieldNameAcf__callback' , 100, 1 );
}
function translate_acf_field_label($field) {
    $field['label'] = __($field['label'], 'task14');
    return $field;
  }
  
  add_filter('acf/register_field_group', 'translate_acf_field_label');
add_filter('acf/load_field_groups', 'translate_acf_fields', 145, 2);
function translate_acf_fields($fields)
{
    // Translate backend labels/titles/instuctions
    if (is_array($fields) && !empty($fields)) {
        foreach ($fields as $key => $field) {
            $fields[$key]['title'] = __($field['title']);
            if (isset($field['sub_fields'])) {
                $fields[$key]['sub_fields'] = renameFieldNameAcf($field['sub_fields']);
            }
        }
    }
    return $fields;
}
