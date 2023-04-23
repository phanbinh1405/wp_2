<?php get_header('', array('title' => 'お問い合わせ')) ?>

<main class="p-contact">
	<?php get_breadcrumb() ?>
	<div class="c-headpage">
		<div class="l-container2">
			<h2 class="c-title">お問い合わせ</h2>
		</div>
	</div>

	<div class="p-contact__content">
		<div class="l-container">
			<h3>メールでのお問い合わせ</h3>
			<p class="notice">下記に必要事項をご記入の上送信下さい。弊所のコンサルタントからご連絡をさせて頂きます。</p>
			<?php echo do_shortcode('[mwform_formkey key="184"]') ?>
		</div>
	</div>
</main>
<?php get_footer() ?>