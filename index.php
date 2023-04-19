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
                            <?php get_custom_posts(5);?>
                            <!-- <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="news-cat.html">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日
                                        <span class="cat">
                                            <i class="c-dotcat" style="background-color: #416ad3"></i>
                                            <a href="news-cat.html">掲載情報</a>
                                        </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月05日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ひかり税理士法人創立15周年記念講演と感謝の夕べを開催しました。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月04日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">【コラム：決算月で税負担が変わる！？資金繰りにも影響！？】をアップしました</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月02日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年9月台風21号及び台風24号により被害を受けられた皆様方へ</a></h3>
                            </li> -->
                        </ul>
                        <!-- Posts of cat1 item - Display 5 Posts-->
                        <ul class="c-listpost" id="cat_1">
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月05日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ひかり税理士法人創立15周年記念講演と感謝の夕べを開催しました。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月04日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">【コラム：決算月で税負担が変わる！？資金繰りにも影響！？】をアップしました</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月02日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #1bb7c5"></i>
                                        <a href="">お知らせ</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年9月台風21号及び台風24号により被害を受けられた皆様方へ</a></h3>
                            </li>
                        </ul>
                        <!-- Posts of cat2 item - Display 5 Posts-->
                        <ul class="c-listpost" id="cat_2">
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #d6772a"></i>
                                        <a href="">税の最新情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #d6772a"></i>
                                        <a href="">税の最新情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月05日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #d6772a"></i>
                                        <a href="">税の最新情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ひかり税理士法人創立15周年記念講演と感謝の夕べを開催しました。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月04日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #d6772a"></i>
                                        <a href="">税の最新情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">【コラム：決算月で税負担が変わる！？資金繰りにも影響！？】をアップしました</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月02日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #d6772a"></i>
                                        <a href="">税の最新情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年9月台風21号及び台風24号により被害を受けられた皆様方へ</a></h3>
                            </li>
                        </ul>
                        <!-- Posts of cat3 item - Display 5 Posts-->
                        <ul class="c-listpost" id="cat_3">
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #c4a021"></i>
                                        <a href="">税制改正</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #c4a021"></i>
                                        <a href="">税制改正</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月05日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #c4a021"></i>
                                        <a href="">税制改正</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ひかり税理士法人創立15周年記念講演と感謝の夕べを開催しました。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月04日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #c4a021"></i>
                                        <a href="">税制改正</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">【コラム：決算月で税負担が変わる！？資金繰りにも影響！？】をアップしました</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月02日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #c4a021"></i>
                                        <a href="">税制改正</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年9月台風21号及び台風24号により被害を受けられた皆様方へ</a></h3>
                            </li>
                        </ul>
                        <!-- Posts of cat4 item - Display 5 Posts-->
                        <ul class="c-listpost" id="cat_4">
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #416ad3"></i>
                                        <a href="">掲載情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #416ad3"></i>
                                        <a href="">掲載情報</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                        </ul>
                        <!-- Posts of cat5 item - Display 5 Posts-->
                        <ul class="c-listpost" id="cat_5">
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月23日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #ccc"></i>
                                        <a href="">バックナンバー</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</a></h3>
                            </li>
                            <li class="c-listpost__item">
                                <div class="c-listpost__info">
                                    <span class="datepost">2018年10月10日</span>
                                    <span class="cat">
                                        <i class="c-dotcat" style="background-color: #ccc"></i>
                                        <a href="">バックナンバー</a>
                                    </span>
                                </div>
                                <h3 class="titlepost"><a href="news-post.html">ライフプラン情報誌「ＡＬＰＳ」10月号に光田CEOの執筆記事が掲載されました！</a></h3>
                            </li>
                        </ul>
                    </div>
                    <div class="l-btn">
                        <div class="c-btn c-btn--small">
                            <a href="news.html">ニュース一覧を見る</a>
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