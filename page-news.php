<?php get_header('', array('title'=>'ニュース・お知らせ')) ?>
<?php 
    $all_cats = get_categories(array(
            "hide_empty"=>false,  
            'orderby' => 'term_id',
            'order'   => 'ASC'
        )
    );
?>
    <main class="p-news">
        <div class="c-breadcrumb">
            <div class="l-container">
                <a href="index.html">Home</a>
                <span>ニュース・お知らせ</span>
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
                            $all_cats = get_categories(array("hide_empty"=>false,  'orderby' => 'term_id',
                            'order'   => 'ASC',));
                        ?>
                        <?php if(count($all_cats) > 0): ?>
                            <?php foreach($all_cats as $index=>$cat): $cat_num = $index + 1;?>
                                <li class='catlink'>
                                    <a href="<?php echo get_category_link($cat) ?>"><?php echo $cat->name ?> </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                </ul>
                <div class="c-tabs__content">
                    <ul class="c-listpost active" id="all">
                        <?php echo get_custom_posts_with_paginate(10);?>
                    </ul>
                </div>
            </div>
        </div>
    </main>

<?php get_footer()?>