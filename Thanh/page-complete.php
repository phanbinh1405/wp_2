<?php get_header(); ?>

<main class="p-contact">
    <?php custom_breadcrumbs(); ?>
    <div class="c-headpage">
        <div class="l-container">
            <h1 class="c-title"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="p-contact__content">
        <div class="l-container2 complete">
            <h2>お問い合わせ、ありがとうございました。</h2>
            <p>メール確認後、担当者よりご連絡させていただきます。</p>
            <p>万一、当方からの返信がない場合は、メッセージの送信に失敗している可能性があります。<br>
                その際は大変恐縮ですが、再度お問い合わせいただくか、別の手段にてご連絡お願いいたします。</p>

        </div>
        <div class="c-btn c-btn--small">
            <a href="<?php echo get_home_url();?>">TOPに戻る</a>
        </div>
    </div>
</main>
<?php get_footer(); ?>