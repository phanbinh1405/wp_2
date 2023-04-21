<footer class="c-footer">
	<div class="c-footer__logo">
		<div class="l-container">
			<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png'" alt="Allgrow Labo"></a>
		</div>
	</div>

	<div class="c-footer__main">
		<div class="l-container">
			<div class="c-footer__link">
				<h3><a href="<?php echo home_url('/news')?>">ニュース</a></h3>
				<ul class="c-boxlink">
					<li><a href="<?php echo get_category_link(3); ?>">お知らせ</a></li>
					<li><a href="<?php echo get_category_link(4); ?>">税の最新情報</a></li>
					<li><a href="<?php echo get_category_link(5); ?>">税制改正</a></li>
					<li><a href="<?php echo get_category_link(6); ?>">掲載情報</a></li>
					<li><a href="<?php echo get_category_link(7); ?>">バックナンバー</a></li>
				</ul>
			</div>

			<div class="c-footer__link">
				<h3><a href="<?php echo home_url('/cases')?>">成功事例</a></h3>
				<ul class="c-boxlink">
					<li><a href="<?php echo home_url('/#'); ?>">法人のお客様</a></li>
					<li><a href="<?php echo home_url('/#'); ?>">個人のお客様</a></li>
				</ul>
			</div>

			<div class="c-footer__link">
				<ul class="c-boxlink">
					<li><a href="<?php echo home_url('/staff'); ?>">スタッフ</a></li>
					<li><a href="<?php echo home_url('/recruit'); ?>">採用情報</a></li>
					<li><a href="<?php echo home_url('/privacy'); ?>">プライバシーポリシー</a></li>
					<li><a href="<?php echo home_url('/sitemap'); ?>">サイトマップ</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<script>
	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/themes.js"></script>
</body>

</html>