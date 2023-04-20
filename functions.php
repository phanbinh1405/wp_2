<?php
    add_theme_support( 'post-thumbnails' );

    function get_custom_posts($posts_per_page = -1, $cat_num = '', $term_id = '', $cat = '') {
        $out_put = '';

        $query_args = array(
            'post_type' => 'post' , 
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'cat' => $term_id
        );

        $query = new WP_Query( $query_args ); 
        $total_pages = $query->max_num_pages; 
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post(); 
                $cates = get_the_category();

                $out_put .= '<li class="c-listpost__item"><div class="c-listpost__info">';
                $out_put .= '<span class="datepost">'.get_the_date('Y年m月d日').'</span>';
                $out_put .= '<div class="cats">';

                if($cat) {
                    $out_put .= '<span class="cat">';
                    $cate_link = esc_url(get_term_link($cat->slug, 'category'));
                    $out_put .= '<i class="c-dotcat" style="background-color:'. get_field('color', $cat).'"></i>';
                    $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cat->name . '</a>';
                    $out_put .= '</span>';
                } else {
                    foreach ($cates as $cate) {
                        $out_put .= '<span class="cat">';
                        $cate_link = esc_url(get_term_link($cate->slug, 'category'));
                            
                        $out_put .= '<i class="c-dotcat" style="background-color:'. get_field('color', $cate).'"></i>';
                        $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cate->name . '</a>';
                        $out_put .= '</span>';
                    }
                }

                $out_put .= '</div></div>';
                $out_put .= '<h3 class="titlepost"><a href="'.esc_url(get_the_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
                $out_put .= '</li>';
            }
        } 
        if($cat_num) {
            return '<ul class="c-listpost" id="cat_'.$cat_num.'">'.$out_put.'</ul>';
        }

        return $out_put;
    }

    function get_custom_posts_with_paginate($posts_per_page = -1) {
        $out_put = '';
        $big = 999999999;
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

        $query_args = array(
            'post_type' => 'post' , 
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged' =>  $paged
        );

        $query = new WP_Query( $query_args ); 
        $total_pages = $query->max_num_pages; 

        $pagination_args = array(
            "prev_text" => __(''),
            "base" => str_replace($big, "%#%", esc_url(get_pagenum_link($big))),
            "format" => "?paged=%#%",
            "current" => $paged,
            "total" => $total_pages,
            "next_text" => __(''),
            "mid_size"=> 6
        );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post(); 
                $cates = get_the_category();
                $out_put .= '<li class="c-listpost__item"><div class="c-listpost__info">';
                $out_put .= '<span class="datepost">'.get_the_date('Y年m月d日').'</span>';
                $out_put .= '<div class="cats">';

                foreach ($cates as $cate) {
                    $out_put .= '<span class="cat">';
                    $cate_link = esc_url(get_term_link($cate->slug, 'category'));
                    $out_put .= '<i class="c-dotcat" style="background-color:'. get_field('color', $cate).'"></i>';
                    $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cate->name . '</a>';
                    $out_put .= '</span>';
                }
                $out_put .= '</div></div>';
                $out_put .= '<h3 class="titlepost"><a href="'.esc_url(get_the_permalink()).'">'.esc_html(get_the_title()).'</a></h3>';
                $out_put .= '</li>';
            }
        } 

        if($total_pages > 1) {
            return $out_put.'<div class="c-pagination">'.paginate_links( $pagination_args ).'</div>';
        }

        return $out_put.'<div class="c-pagination">'.paginate_links( $pagination_args ).'</div>';
    }

    function create_post_type($singular, $plural, $description) {
        $label = array(
            'name'=>$plural,
            'singular_name'=>$singular
        );

        $args = array(
            'labels'=>$label,
            'description'=>$description,
            'supports'=> array('title', 'editor', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'comments', 'revisions'),
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
            'rewrite'=> array(
                'slug'  => strtolower($plural),
                'pages' => TRUE,
            )
        );
    
        register_post_type( $singular , $args );
    };
    
    function custom_cpts() {
        create_post_type('Service', 'Services', 'Service page');
    }
    
    add_action( 'init', 'custom_cpts' );

    function create_custom_taxonomy($plural, $singular, $taxonomy) {
        $labels = array(
		'name' => $plural,
		'singular' => $singular,
		'menu_name' => $singular
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
        register_taxonomy( $taxonomy, strtolower($singular) , $args );
    }

    function custom_ccts() {
        create_custom_taxonomy('Services', 'Service', 'service-category');
    }

    add_action( 'init', 'custom_ccts', 0);
?>