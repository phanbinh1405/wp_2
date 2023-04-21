<?php get_header(); ?>
<main class="p-contact">
    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <div class="l-container2">
            <h1 class="c-title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="p-contact__content c-contact">
        <div class="l-container">
            <h3>メールでのお問い合わせ</h3>
            <p class="notice">下記に必要事項をご記入の上送信下さい。弊所のコンサルタントからご連絡をさせて頂きます。</p>
            <?php the_content(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>