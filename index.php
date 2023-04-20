<?php get_header(); ?>

    <div class="c-mainvisual">
        <div class="js-slider">
            <?php if (have_rows("mainvisual")): ?>
                <?php while (have_rows('mainvisual')): the_row();?>
                    <div>
                        <img src="<?php echo get_sub_field('mv_image')['url']; ?>" alt="<?php echo get_sub_field('mv_image')['alt']; ?>">
                    </div>
                <?php endwhile;?>
            <?php endif;?>
        </div>
    </div>
    <main class="p-home">
        <section class="service">
            <div class="l-container">
                <h2 class="c-title"><span>幅広い案件に対応できるひかりのワンストップサービス</span>目的に応じて、最適な方法をご提案できます</h2>
                <div class="service__inner">
                    <div class="service__item">
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/img_service01.png" 
                        alt="幅広い案件に対応できるひかりのワンストップサービス目的に応じて、最適な方法をご提案できます">
                    </div>
                    <div class="service__item">
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/img_service02.png" 
                        alt="幅広い案件に対応できるひかりのワンストップサービス目的に応じて、最適な方法をご提案できます">
                    </div>
                    <div class="service__item">
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/img_service03.png" 
                        alt="幅広い案件に対応できるひかりのワンストップサービス目的に応じて、最適な方法をご提案できます">
                    </div>
                    <div class="service__item">
                        <img src="<?php echo get_template_directory_uri()?>/assets/img/img_service04.png" 
                        alt="幅広い案件に対応できるひかりのワンストップサービス目的に応じて、最適な方法をご提案できます">
                    </div>
                </div>
                <div class="l-btn l-btn--2btn">
                    <div class="c-btn">
                        <a href="service.html">ひかり税理士法人のサービス一覧を見る</a>
                    </div>
                    <div class="c-btn">
                        <a href="cases.html">ひかり税理士法人の成功事例を見る</a>
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
                            $all_cats = get_categories(array("hide_empty"=>false,  'orderby' => 'term_id',
                            'order'   => 'ASC',));
                        ?>
                        <?php if(count($all_cats) > 0): ?>
                            <?php foreach($all_cats as $index=>$cat): $cat_num = $index + 1;?>
                                <li data-content="<?php echo'cat_'.$cat_num ?>" data-color="<?php echo get_field('color', $cat); ?>">
                                    <?php echo $cat->name ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <div class="c-tabs__content">
                        <!-- All Posts - Display 5 Posts-->
                        <ul class="c-listpost active" id="all">
                            <?php echo get_custom_posts(5);?>
                            <?php wp_reset_postdata();?>
                        </ul>
                        <!-- Posts of cat - Display 5 Posts-->
                        <?php if(count($all_cats) > 0): ?>
                            <?php foreach($all_cats as $index=>$cat): $cat_num = $index + 1;?>
                                <?php echo get_custom_posts(5,  $cat_num, $cat->term_id, $cat);?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="l-btn">
                        <div class="c-btn c-btn--small">
                            <a href="<?php echo esc_url( home_url('/news')) ?>">ニュース一覧を見る</a>
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
                        
                        <li class="c-gridpost__item">
                            <a href="">
                                <div class="c-gridpost__thumb">
                                    <img src="assets/img/img1.jpg" alt="">
                                </div>
                                <p class="datepost">2018年07月30日</p>
                                <h3>社長に“もしものこと”があったときの手続きすべて</h3>
                            </a>
                        </li>
                        <li class="c-gridpost__item">
                            <a href="">
                                <div class="c-gridpost__thumb">
                                    <img src="assets/img/img2.jpg" alt="">
                                </div>
                                <p class="datepost">2018年06月26日</p>
                                <h3>マンガと図解 新・くらしの税金百科 2018～2019</h3>
                            </a>
                        </li>
                        <li class="c-gridpost__item">
                            <a href="">
                                <div class="c-gridpost__thumb">
                                    <img src="assets/img/img3.jpg" alt="">
                                </div>
                                <p class="datepost">2018年08月25日</p>
                                <h3>これ1冊で大丈夫!いざという時のための相続対策がすぐわかる本</h3>
                            </a>
                        </li>
                        <li class="c-gridpost__item">
                            <a href="">
                                <div class="c-gridpost__thumb">
                                    <img src="assets/img/img4.jpg" alt="">
                                </div>
                                <p class="datepost">2017年06月27日</p>
                                <h3>マンガと図解 新・くらしの税金百科 2017～2018</h3>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="l-btn">
                    <div class="c-btn c-btn--small">
                        <a href="publish.html">出版物一覧を見る</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>