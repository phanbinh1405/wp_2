<?php get_header() ?>
    <div class="c-mainvisual">
        <div class="js-slider">
            <?php if( have_rows('mainvisual','option') ):
					while( have_rows('mainvisual','option') ) : the_row(); 
					?>
						<div><img src="<?php echo get_sub_field('image')['url']?>" alt="<?php echo get_sub_field('image')['alt']?>"></div>
					<?php endwhile; ?> 
			<?php endif; ?>
        </div>
    </div>
    <main class="p-home">
        <section class="service">
            <div class="l-container">
                            <h2 class="c-title"><span><?php echo get_field('smalltitle','option')?></span><?php echo get_field('title','option')?></h2>
                            <div class="service__inner">
                                <?php if( have_rows('images','option') ):
                                    while( have_rows('images','option') ) : the_row(); 
                                    ?>
                                        <div class="service__item">
                                            <img src="<?php echo get_sub_field('image')?>" alt="<?php echo get_field('smalltitle','option').get_field('title','option')?>">
                                        </div>
                                    <?php endwhile; ?> 
                                <?php endif; ?>
                            </div>
                <div class="l-btn l-btn--2btn">
                    <div class="c-btn">
                        <a href="<?php echo esc_url( home_url('/services') ); ?>">ひかり税理士法人のサービス一覧を見る</a>
                    </div>
                    <div class="c-btn">
                        <a href="<?php echo esc_url( home_url('/cases') ); ?>">ひかり税理士法人の成功事例を見る</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="news">
            <div class="l-container">
                <h2 class="c-title1">
                    <span class="ja">ニュース</span>
                    <span class="en">News</span>
                </h2>
                <div class="news__inner">
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
                                    echo '<li data-content="cat_'.$cat->term_id.'" data-color="'.$cate_color.'">'.$cat->name.'</li>';
                                }
                        ?>    
                    </ul>
                    <div class="c-tabs__content">
                    <?php
                        // all;
                        $args = [
                            'post_type' => 'post' , 
                            'paged' => 1,
                            'post_status' => 'publish',
                            'posts_per_page' => 5,
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
                        //each category
                        $cats = get_categories($args);
                        foreach($cats as $cat){
                            $args['cat'] = $cat->term_id;
                            $custom_query = new WP_Query( $args  ); 
                            $total_pages = $custom_query->max_num_pages; 
                            if ( $custom_query->have_posts() ) {
                                echo '<ul class="c-listpost"  id="cat_'.$cat->term_id.'">';
                                while ( $custom_query->have_posts() ) {
                                    $custom_query->the_post(); 
                                    list_post($cat->term_id);
                                }
    
                                echo '</ul>';
                            } 
                            wp_reset_postdata();
                        }
                        
                        ?>
                    </div>
                    <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a href="<?php echo esc_url(home_url( '/news' )) ?>">ニュース一覧を見る</a>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="publish">
            <div class="l-container">
                <h2 class="c-title1">
                    <span class="ja">出版物</span>
                    <span class="en">Publish</span>
                </h2>
                <div class="publish__inner">
                    <ul class="c-gridpost"> 
                    <?php 
                        $args = [
                            'post_type' => 'publish' , 
                            'post_status' => 'publish',
                            'posts_per_page' => 4,
                            'paged' => 1 , 
                        ];

                        $publish_query = new WP_Query( $args );
                        if ( $publish_query->have_posts() ) {
                            while ( $publish_query->have_posts() ) {
                                $publish_query->the_post();
                                    list_publish();
                            }

                        } 
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div>
                <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a href="<?php echo esc_url(home_url( '/publish' )) ?>">出版物一覧を見る</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer() ?>