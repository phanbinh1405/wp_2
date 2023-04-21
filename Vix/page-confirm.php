<?php get_header()?>
	<main class="p-contact p-contact--confirm">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<a href="<?php echo esc_url(home_url( '/contact' )) ?>">お問い合わせ</a>
                <span>お問い合わせ内容確認</span>
			</div>
		</div>
		<div class="c-headpage">
			<div class="l-container2">
				<h2 class="c-title">お問い合わせ</h2>
			</div>
		</div>

		<div class="p-contact__content">
			<div class="l-container">
				<p class="notice">以下の内容を送信してもよろしいですか？</p>
				<?php echo do_shortcode('[mwform_formkey key="214"]'); ?>
			</div>
		</div>
	</main>
	<?php get_footer()?>
