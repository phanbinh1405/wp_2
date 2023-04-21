<?php get_header()?>
	<main class="p-contact">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<span><?php the_title()?></span>
			</div>
		</div>
		<div class="c-headpage">
			<div class="l-container2">
				<h2 class="c-title"><?php the_title()?></h2>
			</div>
		</div>

		<div class="p-contact__content">
			<div class="l-container">
				<h3>メールでのお問い合わせ</h3>
				<p class="notice">下記に必要事項をご記入の上送信下さい。弊所のコンサルタントからご連絡をさせて頂きます。</p>
				<?php remove_filter('the_content', 'wpautop');?>
				<?php echo do_shortcode('[mwform_formkey key="214"]'); ?>
			</div>
		</div>
	</main>
	<?php get_footer()?>