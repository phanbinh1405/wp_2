<?php
    add_theme_support( 'post-thumbnails' );

    function get_custom_posts($posts_per_page = -1, $term_id = '') {
        $out_put = '';
        $query_args = array(
            'post_type' => 'post' , 
            'paged' => 1,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'cat' => $term_id
        );

        $query = new WP_Query( $query_args  ); 
        $total_pages = $query->max_num_pages; 
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post(); 
                $cates = get_the_category();
                $out_put .= '<li class="c-listpost__item"><div class="c-listpost__info">';
                $out_put .= '<span class="datepost">'.get_the_date('Y年m月d日').'</span>';
                $out_put .= '<span class="cat">';
                foreach ($cates as $cate) {
                    $cate_link = esc_url(get_term_link($cate->slug, 'category'));
                    $out_put .= '<i class="c-dotcat" style="background-color:'. get_field('color', $cate).'"></i>';
                    $out_put .= '<a href="' . $cate_link . '" class="c-label">' . $cate->name . '</a>';
                }
                $out_put .= '</span>';
                $out_put .= '</div>';
                $out_put .= '<h3 class="titlepost"><a href="news-post.html">'.esc_html(get_the_title()).'</a></h3>';
                $out_put .= '</li>';
            }
        } 

        echo $out_put;
    }
?>