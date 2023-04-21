<?php get_header(); ?>
<main class="p-service">
    <?php custom_breadcrumbs();
    $p = get_post(); ?>
    <?php $rows = get_field('service');
    if ($rows) : ?>
        <div class="c-headpage">
            <div class="l-container2">
                <h1 class="c-title"><?php the_title(); ?></h1>
            </div>
            <p><?php echo $rows['description']; ?></p>
        </div>
        <?php
        $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
        if (!empty($url)) {
        ?>
            <div class="feature_img">
                <img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
            </div>
        <?php } ?>
        <div class="p-service__consultation">
            <dl class="l-container2">
                <dt>このような方はご相談ください</dt>
                <?php foreach ($rows['target'] as $item) { ?>
                    <dd class="c-checkMark"><?php echo $item['target']; ?></dd>
                <?php } ?>
            </dl>
        </div>
        <div class="p-service__merit">
            <div class="l-container2">
                <h3 class="p-service__title">ひかり税理士法人を選ぶメリット</h3>
                <dl>
                    <?php foreach ($rows['advantage'] as $item) { ?>
                        <dt class="c-checkMark"><?php echo $item['advantage-title']; ?></dt>
                        <dd><?php echo $item['advantage-description']; ?></dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
        <div class="p-service__flow">
            <div class="l-container2">
                <h3 class="p-service__title">サービスの流れ</h3>
                <?php for($i=0;$i< count($rows['steps']);$i++){
                    $step=$rows['steps'][$i];?>
                    <table>
                        <tbody>
                            <tr>
                                <th>STEP<?php echo $i + 1; ?></th>
                                <td>
                                    <h4 class="flow-title"><?php echo $step['step-tite']; ?></h4>
                                    <?php foreach ($step['step-subtitle'] as $sub) { ?>
                                        <h5 class="flow-subtitle"><?php echo $sub['step-subtitle']; ?></h5>
                                        <?php foreach ($sub['step-description'] as $desc) { ?>
                                            <p class="c-checkMark"><?php echo $desc['step-description']; ?></p>
                                    <?php }
                                    } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } ?>
            </div>
        </div>
        <div class="p-service__division">
            <div class="l-container">
                <h3 class="p-service__subtitle">関連サービス</h3>
                <ul class="division-list c-flex">
                    <?php foreach ($rows['related service'] as $featured_post) :?>
                        <li class="small-12 medium-4">
                            <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
                                <?php if ($rows['icon'] == true) { ?>
                                <p class="img"><img src="<?php echo $rows['icon']['url']; ?>" alt="<?php echo esc_html(get_the_title($featured_post->ID)); ?>"></p>
                                <?php } ?>
                                <p class="text"><span class="arrow"><?php echo esc_html(get_the_title($featured_post->ID)); ?></span></p>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="l-btn">
                <div class="c-btn c-btn--small">
                    <a href="<?php echo get_site_url();?>/services">ご提供サービス一覧へ</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>