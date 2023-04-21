<?php get_header();
$post_type = get_post_type();
$post_type_object = get_post_type_object($post_type);?>
<main class="p-service">
	<?php custom_breadcrumbs(); ?>
	<div class="c-headpage">
		<div class="l-container2">
			<h1 class="c-title"><?php echo get_the_title(12); ?></h1>
		</div>
	</div>
	<div class="feature_img">
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_services01.png" alt="ご提供サービス">
	</div>
	<div class="p-service__content">
		<div class="l-container">
			<p class="notice">ひかり税理士法人がご提供するすべてのサービスを目的別に検索していただけます</p>
			<!-- =======checkArea====== -->
			<div class=" p-service__checkArea">
				<form id="serviceSearch" method="get" action="<?php the_permalink() ?>">
					<div class="checkArea__form">
						<legend class="servicesList-heading">サービスの対象で選ぶ</legend>
						<div class="checkArea__inner">
							<?php
							$terms1 = get_terms(array( 
								'taxonomy' => 'service-category',
								'orderby'    => 'ID'
							));
							if ($terms1) {
								foreach ($terms1 as $term) { ?>
									<div class="c-w240">
										<label>
											<input class="chkbutton" type="checkbox" name="service-category[]" value="<?php echo $term->term_id; ?>"><?php echo $term->name ?></label>
									</div>
							<?php }
							} ?>
						</div>
					</div>
					<div class="checkArea__form form2">
						<legend class="servicesList-heading">サービスの内容で選ぶ</legend>
						<div class="checkArea__inner">
							<?php
							$terms2 = get_terms(array( 
								'taxonomy' => 'service-category2',
								'orderby'    => 'ID'
							));
							if ($terms2) {
								foreach ($terms2 as $term) { ?>
									<div class="<?php echo (mb_strlen($term->name) > 3) ? 'c-w240' : 'c-w156' ?>">
										<label>
											<input class="chkbutton" type="checkbox" name="service-category2[]" value="<?php echo $term->term_id; ?>"><?php echo $term->name ?></label>
									</div>
							<?php }
							} ?>
						</div>
					</div>
				</form>
			</div>
			<?php
			$args = array(
				'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'service-category2',
						'terms' => array(27, 28, 29, 30, 31),
					),
					array(
						'taxonomy' => 'service-category',
						'terms' => array(23, 24, 25, 26),
					)
				)
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()) : ?>
				<p class="p-service__result"><span><?php echo $the_query->post_count; ?><span>件が該当しました</p>
				<ul class="c-column">
					<?php while ($the_query->have_posts()) : $the_query->the_post();
						$post = get_post();
						$rows = get_field('service');
						if ($rows) : ?>
							<li class="c-column__item"><a href="<?php echo get_permalink($post->ID); ?>">
									<?php if ($rows['icon'] == true) { ?>
										<img src="<?php echo esc_url($rows['icon']['url']); ?>" alt="<?php echo get_the_title($post->ID); ?>">
									<?php } ?>
									<p><?php echo get_the_title($post->ID); ?></p>
								</a>
							</li>
					<?php
						endif;
					endwhile; ?>
				</ul>
			<?php endif;
			wp_reset_postdata(); ?>
			<div class="endcontent">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_more05.png" alt="">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img_more06.png" alt="">
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>