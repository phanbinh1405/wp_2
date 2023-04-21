<?php get_header(); ?>
<main class="p-contact">
	<?php custom_breadcrumbs(); ?>
	<div class="c-headpage">
		<div class="l-container2">
			<h1 class="c-title"><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="p-contact__content c-confirm">
		<div class="l-container">
			<p class="notice">以下の内容を送信してもよろしいですか？</p>
			<?php echo do_shortcode('[mwform_formkey key="236"]'); ?>
		</div>		
	</div>
</main>
<?php get_footer(); ?>