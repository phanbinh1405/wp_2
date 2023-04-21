<?php get_header()?>
    <main class="p-news">
        <div class="c-breadcrumb">
            <div class="l-container">
                <a href="<?php echo esc_url(home_url()) ?>">Home</a>
                <a href="<?php echo esc_url(home_url( '/news' )) ?>">ニュース一覧</a>
                <span>ニュース(<?php single_cat_title()?>)</span>
            </div>
        </div>
        <div class="c-headpage">
            <h2 class="c-title">ニュース・<?php single_cat_title()?></h2>
        </div>
        <div class="p-news__content">
            <div class="l-container">
                <?php 
                    global $wp_query;
                    $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
                    echo '<ul class="c-listpost" id="cat_'.get_queried_object()->term_id.'">';
                    while (have_posts()) : the_post();
                    ?>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost"><?php echo get_the_date('Y年m月d日'); ?></span>
					                <div class="c-cats">
                                    <?php $postcats = wp_get_post_categories($post->ID);
                                    if ($postcats) {
                                        foreach($postcats as $cat) {
                                            if(get_cat_name($cat) === get_queried_object()->name){
                                                $cate_color = get_field('catcolor', 'category_'.$cat);
                                                    echo '<span class="cat"><i class="c-dotcat" style="background-color:'.$cate_color.'"></i><a href="'.get_category_link($cat).'">'.get_cat_name($cat).'</a></span>';
                                                }
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                                <h3 class="titlepost"><a href="<?php  the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </li>
                            <?php endwhile; ?> 	
                        </ul>
                <div class="c-pagination">
                <?php 
                    post_pagination($wp_query->max_num_pages,$paged);
                ?>  
                </div>
            </div>
        </div>
    </main>
<?php get_footer()?>
