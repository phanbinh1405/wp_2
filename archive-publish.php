<?php get_header('', array('title'=>'出版物')); ?>

    <main class="p-publish">
        <div class="c-breadcrumb">
            <div class="l-container">
                <a href="index.html">Home</a>
                <span>出版物</span>
            </div>
        </div>
        <div class="c-headpage">
            <h2 class="c-title">出版物</h2>
            <p>ひかり税理士法人では、税務・会計・経営・相続などに関する書籍の執筆を行っています。</p>
        </div>
        <div class="l-container">
            <div class="p-publish__content">
                <ul class="c-gridpost">
                    <?php 
                        global $wp_query;
                        $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;	
                        $args = [
                            'post_type' => 'publish' , 
                            'post_status' => 'publish',
                            'posts_per_page' => 12,
                            'paged'=> $paged
                        ];
                        $wp_query = new WP_Query( $args  ); 
                        $total_pages = $wp_query->max_num_pages; 
                    ?>
                    <?php if($wp_query->have_posts()): ?>
                        <?php while($wp_query->have_posts()): $wp_query->the_post() ?>
                            <li class="c-gridpost__item">
                                <div class="c-gridpost__thumb">
                                    <img src="<?php echo get_field('image')['url'] ?>" alt="">
                                </div>
                                <div class="c-gridpost__info">
                                    <p class="datepost"><?php echo get_field('publication_date') ?></p>
                                    <h3><?php the_title() ?></h3>
                                    <p class="price">¥<?php echo get_field('price') ?> (税別)</p>
                                    <a href="<?php echo get_post_permalink() ?>" class="c-btnview">詳しく見る</a>
                                </div>
                            </li>
                    <?php endwhile; endif;?>
                </ul>
            </div>
            <div class="c-pagination">
                <?php 
                    $big = 9999999999999;
                    $pagination = array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'mid-size' => 3,
                        'current' => $paged,
                        'total' => $total_pages,
                        'prev_next' => True,
                        'prev_text' => ( '' ),
                        'next_text' => ( '' ),
                    );

                    echo paginate_links( $pagination );
                ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>