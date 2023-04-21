<?php     get_header();?>
    <main class="p-publish">
        <div class="c-breadcrumb">
            <div class="l-container">
                <a href="<?php echo esc_url(home_url()) ?>">Home</a>
                <span>出版物一覧</span>
            </div>
        </div>
        <div class="c-headpage">
            <h2 class="c-title"><?php 
                        $titlepage = get_post_type_object( 'publish' );
						echo $titlepage->labels->name;
                        ?>            
            </h2>
            <p>ひかり税理士法人では、税務・会計・経営・相続などに関する書籍の執筆を行っています。</p>
        </div>
        <div class="l-container">
            <div class="p-publish__content">
                <ul class="c-gridpost">
                    <?php
                        global  $wp_query;
                        $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;	
                        $args = [
                            'post_type' => 'publish' , 
                            'post_status' => 'publish',
                            'posts_per_page' => 12,
                            'paged'=> $paged
                        ];
                        $wp_query = new WP_Query( $args  ); 
                        $total_pages = $wp_query->max_num_pages; 
                        if ( $wp_query->have_posts() ) {
                            while ( $wp_query->have_posts() ) {
                                $wp_query->the_post(); 
                                $title = get_the_title();
                                $img = get_field('image')['url'];
                                $price = get_field('price');
                                $publish_time =get_field('publishdate');
                                $link = get_post_permalink();
                                echo '<li class="c-gridpost__item">';
                                    if ($img){
                                        echo '<div class="c-gridpost__thumb">
                                                <img src="'.$img.'" alt="'.$title.'">
                                              </div>';
                                    };
                                    if($post_time || $title || $price || $link){
                                        echo '<div class="c-gridpost__info">';
                                        if($publish_time){
                                           echo '<p class="datepost">'.$publish_time.'</p>';
                                        };
                                        if($title){
                                            echo '<h3>'.$title.'</h3>';
                                        };
                                        if($price){
                                            echo '<p class="price">¥'.$price.'(税別)'.'</p>';
                                        }
                                        if($link){
                                            echo '<a href="'.$link.'" class="c-btnview">詳しく見る</a>';
                                        }
                                        echo '</div>';
                                    }
                                echo '</li>'; 
                            }
                        }
                        wp_reset_postdata();
                    ?>
                </ul>        
            </div>
            <?php post_pagination($total_pages,$paged)?>
        </div>
    </main>
<?php get_footer();?>