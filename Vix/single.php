<?php get_header() ?>
	<main class="p-news">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<a href="<?php echo esc_url(home_url('/news')) ?>">ニュース一覧</a>
				<span><?php echo get_the_title()?></span>
			</div>
		</div>
		
		<div class="p-news__content">
			<div class="l-container">
				<?php 
					if(have_posts()){
						while(have_posts()){
							the_post();
							
							echo '<div class="feature_img">';
							if(the_post_thumbnail()){
								$featured_img_url = get_the_post_thumbnail_url($post_id);
								echo '<img src="'.$featured_img_url.'" alt="'.get_the_title().'">';
							}
							echo '</div>';
							echo '<div class="c-ttlpostpage">';
							echo '<h2>'. get_the_title().'</h2>';
							echo '<span>'.get_the_date('Y年m月d日').'</span>';
							echo '<span class="c-listpost__cat">'; 
								$cate = (wp_get_post_categories(get_the_ID())); 
								if (!empty($cate)){
									foreach ($cate as $key => $value) {
										$cat = get_category($value);
										$cat_color = get_field('catcolor', $cat->taxonomy.'_'.$cat->term_id);
										echo '<i class="c-dotcat" style="background-color: '.$cat_color.'"></i>';
										echo '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a> ';
									}
								}
							echo '</span></div>';
						echo '<div class="single__content">'. the_content().'</div>';		
						}
					}
				?>

				
				<div class="l-btn">
					<div class="c-btn c-btn--small2">
						<a href="<?php echo esc_url(home_url( '/news' )) ?>">ニュース一覧を見る</a>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php get_footer()?>
