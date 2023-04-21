<?php get_header()?>
    <main class="p-news">
        <div class="c-breadcrumb">
            <div class="l-container">
                <a href="<?php echo esc_url(home_url()) ?>">Home</a>
                <span>ニュース一覧</span>
            </div>
        </div>
        <div class="c-headpage">
            <h2 class="c-title">ニュース・お知らせ</h2>
        </div>
        <div class="p-news__content">
            <div class="l-container">
            <ul class="c-tabs">
                        <li data-content="all" data-color="#0078d2" class="active">すべて</li>
                        <?php
                            $categories = get_categories( array(
                                'orderby' => 'term_id',
                                'order'   => 'ASC',
                                'hide_empty' => false
                            ) );
                                foreach ($categories as $cat){
                                    $cate_color = get_field('catcolor', $cat->taxonomy.'_'.$cat->term_id);
                                    echo '<li data-content="cat_'.$cat->term_id.'" data-color="'.$cate_color.'"> <a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a></li>';
                                }
                        ?>    
                    </ul>
                    <div class="c-tabs__content">
                    <?php
                        // all;
                        $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;	
                        $args = [
                            'post_type' => 'post' , 
                            'post_status' => 'publish',
                            'posts_per_page' => 10,
                            'paged'=> $paged
                        ];
                        $custom_query = new WP_Query( $args  ); 
                        $total_pages = $custom_query->max_num_pages; 
                        if ( $custom_query->have_posts() ) {
                            echo '<ul class="c-listpost active"  id="all">';
                            while ( $custom_query->have_posts() ) {
                                $custom_query->the_post(); 
                                list_post();
                            }
                            
                            echo '</ul>';
                            }
                            wp_reset_postdata();                        

                            post_pagination($total_pages,$paged);  
                        ?>
                    </div>
            </div>
        </div>
    </main>
    <?php get_footer()?>
