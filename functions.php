<?php
add_theme_support('post-thumbnails');
add_filter('use_block_editor_for_post', '__return_false');

function get_custom_posts($posts_per_page = -1, $cat_num = '', $term_id = '', $cat = '')
{
    $out_put = '';

    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'cat' => $term_id
    );

    $query = new WP_Query($query_args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $cates = get_the_category();

            $out_put .= '<li class="c-listpost__item"><div class="c-listpost__info">';
            $out_put .= '<span class="datepost">' . get_the_date('Y年m月d日') . '</span>';
            $out_put .= '<div class="cats">';

            if ($cat) {
                $out_put .= '<span class="cat">';
                $cate_link = esc_url(get_term_link($cat->slug, 'category'));
                $out_put .= '<i class="c-dotcat" style="background-color:' . get_field('color', $cat) . '"></i>';
                $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cat->name . '</a>';
                $out_put .= '</span>';
            } else {
                foreach ($cates as $cate) {
                    $out_put .= '<span class="cat">';
                    $cate_link = esc_url(get_term_link($cate->slug, 'category'));

                    $out_put .= '<i class="c-dotcat" style="background-color:' . get_field('color', $cate) . '"></i>';
                    $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cate->name . '</a>';
                    $out_put .= '</span>';
                }
            }

            $out_put .= '</div></div>';
            $out_put .= '<h3 class="titlepost"><a href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';
            $out_put .= '</li>';
        }
    }
    if ($cat_num) {
        return '<ul class="c-listpost" id="cat_' . $cat_num . '">' . $out_put . '</ul>';
    }

    return $out_put;
}

function get_custom_posts_with_paginate($posts_per_page = -1)
{
    $out_put = '';
    $big = 999999999;
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
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
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $cates = get_the_category();
            $out_put .= '<li class="c-listpost__item"><div class="c-listpost__info">';
            $out_put .= '<span class="datepost">' . get_the_date('Y年m月d日') . '</span>';
            $out_put .= '<div class="cats">';

            foreach ($cates as $cate) {
                $out_put .= '<span class="cat">';
                $cate_link = esc_url(get_term_link($cate->slug, 'category'));
                $out_put .= '<i class="c-dotcat" style="background-color:' . get_field('color', $cate) . '"></i>';
                $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cate->name . '</a>';
                $out_put .= '</span>';
            }
            $out_put .= '</div></div>';
            $out_put .= '<h3 class="titlepost"><a href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';
            $out_put .= '</li>';
        }
    }

    if ($total_pages > 1) {
        return $out_put . '<div class="c-pagination">' . paginate_links($pagination_args) . '</div>';
    }

    return $out_put . '<div class="c-pagination">' . paginate_links($pagination_args) . '</div>';
}

function create_post_type($singular, $plural, $description, $slug, $all_items)
{
    $label = array(
        'name' => $plural,
        'singular_name' => $singular,
        'all_items' => __($all_items)
    );

    $args = array(
        'labels' => $label,
        'description' => $description,
        'supports' => array('title', 'editor', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'comments', 'revisions'),
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'rewrite' => array(
            'slug'  => strtolower($slug),
            'pages' => TRUE,
            'with_front' => false
        )
    );

    register_post_type($singular, $args);
};

function custom_cpts()
{
    create_post_type('Service', 'サービス', 'Service page', 'Services', 'All Services');
    create_post_type('Publish', '出版物', 'Publish page', 'Publish', 'All Publishs');
}

add_action('init', 'custom_cpts');

function create_custom_taxonomy($plural, $singular, $taxonomy, $menu_name)
{
    $labels = array(
        'name' => $plural,
        'singular' => $singular,
        'menu_name' => $menu_name
    );
    $args = array(
        'labels'                    => $labels,
        'hierarchical'              => true,
        'public'                    => true,
        'show_ui'                   => true,
        'show_admin_column'         => true,
        'show_in_nav_menus'         => true,
        'show_tagcloud'             => true,
    );
    register_taxonomy($taxonomy, strtolower($singular), $args);
}

function custom_ccts()
{
    create_custom_taxonomy('Services', 'Service', 'service-category', 'Service Categories');
}

add_action('init', 'custom_ccts', 0);

function c_print_r($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function theme_slug_filter_wp_title($title)
{
    if (is_404()) {
        $title = 'ページが見つかりません';
    }
    return $title;
}

add_filter('wp_title', 'theme_slug_filter_wp_title');

function get_breadcrumb()
{
    global $post;
    echo '<div class="c-breadcrumb"><div class="l-container">';
    echo '<a href="' . home_url() . '" >Home</a>';
    if (is_archive()) {
        $post_type = get_post_type();
        if ($post_type === 'service') {
            echo '<span>サービス一覧</span>';
        }
        if ($post_type === 'publish') {
            echo '<span>出版物一覧</span>';
        }
    }
    if (is_single()) {
        $post_type = get_post_type();
        if ($post_type === 'service') {
            echo '<a href="' . get_post_type_archive_link('service') . '" >サービス一覧</a>';
        }
        if ($post_type === 'publish') {
            echo '<a href="' . get_post_type_archive_link('publish') . '" >出版物一覧</a>';
        }
        if ($post_type === 'post') {
            echo '<a href="' . esc_url(home_url('news')) . '" >ニュース一覧</a>';
        }
        echo '<span>' . get_the_title() . '</span>';
    }
    if (is_page('news')) {
        echo '<span>ニュース一覧</span>';
    } else if (is_page()) {
        $anc = get_post_ancestors( $post->ID );
        $anc = array_reverse($anc);
        if ( !isset( $parents ) ) $parents = null;
        foreach ( $anc as $ancestor ) {
            $parents .= '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>';
        }               
        echo $parents;
        echo '<span>' . get_the_title() . '</span>';
    }

    if (is_category()) {
        echo '<a href="' . esc_url(home_url('news')) . '" >ニュース一覧</a>';
        echo '<span>' . wp_title('', false) . '</span>';
    }

    echo '</div></div>';
}

// Filter Service Category By Ajax

add_action('wp_ajax_filter_service_categories', 'filter_service_categories');
add_action('wp_ajax_nopriv_filter_service_categories', 'filter_service_categories');

function filter_service_categories()
{
    ob_start();
    // logic get post
    $input = $_REQUEST["input"];
    $args = array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    if ($input) {
        $args['tax_query'] = array(
            'relation' => 'or',
            array(
                'taxonomy' => 'service-category',
                'terms' => $input
            )
        );
    }

    $category_query = new WP_Query($args);

    if ($category_query->have_posts()) {
        while ($category_query->have_posts()) {
            $category_query->the_post();
            echo '<li class="c-column__item">';
            echo '<a href="' . get_the_permalink() . '">';
            if (get_the_post_thumbnail_url()) {
                echo    '<img src="' . get_the_post_thumbnail_url() . '" alt="">';
            }
            echo '<p>' . get_the_title() . '</p>';
            echo    '</a></li>';
        }
    }
    wp_reset_query();
    $content = ob_get_contents();
    ob_end_clean();
    $result['type'] = "success";
    $result['message'] = "Thanh cong";
    $result['content'] = $content;
    $result['count'] = $category_query->post_count;
    $result = json_encode($result);
    echo $result;
    die();
}
