<?php get_header()?>
	<main class="p-contact">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<a href="<?php echo esc_url(home_url( '/contact' )) ?>">お問い合わせ</a>
                <span>お問い合わせ完了</span>
			</div>
		</div>
		<div class="c-headpage">
			<div class="l-container">
				<h2 class="c-title">お問い合わせ</h2>
			</div>
		</div>

		<div class="p-contact__content">
			<div class="l-container2 complete">
			<?php echo do_shortcode('[mwform_formkey key="214"]'); ?>

			  
			</div>
			<div class="c-btn c-btn--small">
                <a href="<?php echo esc_url( home_url() ); ?>">TOPに戻る</a>
            </div>
		</div>
	</main>
	<?php get_footer()?>
