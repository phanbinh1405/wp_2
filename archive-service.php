<?php get_header(); ?>
<?php 
	$titlepage = get_post_type_object( 'service' );
?>

	<main class="p-service">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="index.html">Home</a>
				<span>ご提供サービス</span>
			</div>
		</div>
		<div class="c-headpage">
			<div class="l-container2">
				<h2 class="c-title">ご提供サービス</h2>
			</div>
		</div>

		<div class="feature_img">
			<img src="<?php echo get_template_directory_uri()?>/assets/img/img_services01.png" alt="ご提供サービス">
		</div>
		<?php
			$parent_cats = get_terms(array( 
				'taxonomy' => 'service-category',
				'orderby'    => 'ID',
				'hide_empty' => false,
				'parent' => 0
			));
		?>
		<div class="p-service__content">
			<div class="l-container">
				<p class="notice">ひかり税理士法人がご提供するすべてのサービスを目的別に検索していただけます</p>
				<!-- =======checkArea====== -->
				<div class=" p-service__checkArea">
					<form id="serviceSearch" method="get" action="#">
						<?php 
							if($parent_cats) {
								$form_class = 'checkArea__form';
								foreach($parent_cats as $index=>$pcat){
									$subcats = get_term_children($pcat->term_id,'service-category');
									
									if($pcat->name === 'サービスの内容で選ぶ') {
										$form_class = 'checkArea__form form2';
									}

									echo '<div class="'.$form_class.'">';
									echo '<legend class="servicesList-heading">'.$pcat->name.'</legend>';
									echo '<div class="checkArea__inner">';
									foreach($subcats as $scat) {
										$subterm = get_term_by( 'id', $scat,'service-category');
										if($subterm->name === '税務' || $subterm->name === '財務' || $subterm->name === '相続') {
											$class_width = 'c-w156';
										} else {
											$class_width = 'c-w240';
										}
										echo '<div class="'.$class_width.'">';
										echo '<label>';
										echo '<input class="chkbutton" type="checkbox" name="cats[]" value="'.$scat.'">'.$subterm->name.'</label>';
										echo '</div>';
									}
									echo '</div>';
									echo '</div>';
								}
							}
						?>
					</form>
				</div>

				<?php 
					$total_services_post = wp_count_posts('service')->publish;
					$args = [
						'post_type' => 'service' , 
						'post_status' => 'publish',
						'paged' => 1 , 
					];

					$query = new WP_Query( $args );

				?>
				<p class="p-service__result"><?php echo $total_services_post ?>件が該当しました</p>

				<ul class="c-column">
					<?php if($query->have_posts()): ?>
						<?php while($query->have_posts()): $query->the_post() ?>
							<li class="c-column__item">
								<a href="<?php the_permalink(); ?>">
								<?php if(get_the_post_thumbnail_url()): ?>
									<img src="<?php echo get_the_post_thumbnail_url()?>" alt="">
								<?php endif;?>
									<p><?php the_title();?></p>
								</a>
							</li>
					<?php endwhile; endif;?>
					<?php wp_reset_postdata(); ?>
				</ul>

				<div class="endcontent">
					<img src="<?php echo get_template_directory_uri()?>/assets/img/img_more05.png" alt="<?php echo $titlepage->labels->singular_name;?>">
					<img src="<?php echo get_template_directory_uri()?>/assets/img/img_more06.png" alt="<?php echo $titlepage->labels->singular_name;?>">
				</div>
			</div>
		</div>
	</main>
<?php get_footer();?>
