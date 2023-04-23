<?php get_header() ?>

	<main class="p-news">
		<!-- <div class="c-breadcrumb">
			<div class="l-container">
				<a href="index.html">Home</a>
				<a href="news.html">ニュース・お知らせ</a>
				<span>2018年12月12日 就職活動中の方向けに京都事務所で事務所見学会を開催します。</span>
			</div>
		</div> -->
		<?php get_breadcrumb() ?>

		<div class="p-news__content">
			<div class="l-container">
				<?php if (have_posts()): ?>
					<?php while (have_posts()): 
					the_post(); 
					$cates = get_the_category();
					?>
						<div class="feature_img">
							<?php if(get_the_post_thumbnail_url()) : ?>
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo esc_html(get_the_title()); ?>">
							<?php endif; ?>
						</div>
						<div class="c-ttlpostpage">
							<h2><?php the_title() ?></h2>
							<span><?php echo get_the_date('Y年m月d日');?></span>
							<span class="c-listpost__cat">
							<?php foreach ($cates as $cate): ?>
								<i class="c-dotcat" style="background-color: <?php echo get_field('color', $cate)?>"></i>
								<a href="<?php echo esc_url(get_term_link($cate->slug, 'category')); ?>" class="c-label"><?php echo $cate->name ?></a>
							<?php endforeach;?>
							</span>
						</div>
					<?php endwhile;?>
				<?php endif;?>
				
				<div class="single__content">
					<?php the_content() ?>
				</div>
				<?php wp_reset_postdata()?>
				
				<div class="l-btn">
					<div class="c-btn c-btn--small2">
						<a href="<?php echo esc_url(home_url( '/news' )); ?>">ニュース一覧を見る</a>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php get_footer()?>

