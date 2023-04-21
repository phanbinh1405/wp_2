<?php get_header()?>
	<main class="p-service">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<span>
					<?php 
						$titlepage = get_post_type_object( 'services' );
						echo $titlepage->labels->singular_name;
					?>
				</span>	
			</div>
		</div>
		<div class="c-headpage">
			<div class="l-container2">
				<h2 class="c-title">
					<?php 
						$titlepage = get_post_type_object( 'services' );
						echo $titlepage->labels->singular_name;
					?>
				</h2>
			</div>
		</div>
		<div class="feature_img">
			<img src="<?php echo get_template_directory_uri() ?>/assets/img/img_services01.png" alt="ご提供サービス">
		</div>

		<div class="p-service__content">
			<div class="l-container">
				<p class="notice">ひかり税理士法人がご提供するすべてのサービスを目的別に検索していただけます</p>
				<div class=" p-service__checkArea">
				    <form id="serviceSearch" method="get" action="#">
						<?php
							$args = [
								'hide_empty' => false,
								'taxonomy' => 'services-category',
								'parent'=>0,
								'orderby'=> 'term_id'
							];
							$parent_cats = get_terms($args);
							if($parent_cats){
								foreach ($parent_cats as $index=>$pcats){
									$subcats = get_term_children($pcats->term_id,'services-category');
									if ($pcats->name == "サービスの内容で選ぶ"){
										$form_class = 'form2';
									} 
									echo '<div class="checkArea__form '.$form_class.'">';
									echo '<h2 class="servicesList-heading">'.$pcats->name.'</h2>';

									echo '<div class="checkArea__inner">';
									if($subcats){
										foreach($subcats as $sub){
											$subterm = get_term_by( 'id', $sub,'services-category');
											if ($subterm->name == "税務" || $subterm->name == "財務" || $subterm->name == "相続"){
												$label_class = 'c-w156';
											}else{
												$label_class = 'c-w240';
											};
											
											echo '<div class="'.$label_class.'">';
											echo '<label>';
											echo '<input class="chkbutton" type="checkbox" name="cats[]" value="'.$sub.'">'.$subterm->name.'</label>';
											echo '</div>';

										}
									};
									echo '</div></div>';

								};
							}
							
						?>
					</form>
				</div>

				<?php 
					$total_services_post = wp_count_posts('services')->publish;
					$post_per_page = 12;
					$args = [
						'post_type' => 'services' , 
						'post_status' => 'publish',
						'posts_per_page' => $post_per_page,
						'paged' => 1 , 
					];

					$the_query = new WP_Query( $args );

				?>

				<p class="p-service__result"><span class="is-ajaxServicesCount"><?php echo $total_services_post ?></span> 件が該当しました</p>
				<ul class="c-column is-ajaxServicesPosts">
					
					<?php
					if ( $the_query->have_posts() ) {
			
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							?>
								<li class="c-column__item">
									<a href="<?php echo get_permalink() ?>">
										<?php if (get_field('icon')){
											echo '<img src="'.get_field('icon')['url'].'" alt="'.get_the_title().'">';
										}?>
										<p><?php the_title() ?> </p>
									</a>
								</li>
							<?php
						}
			
					} 

					wp_reset_postdata();
					?>
					
				</ul>


				<div class="endcontent">
					<img src="<?php echo get_template_directory_uri()?>/assets/img/img_more05.png" alt="<?php echo $titlepage->labels->singular_name;?>">
					<img src="<?php echo get_template_directory_uri() ?>/assets/img/img_more06.png" alt="<?php echo $titlepage->labels->singular_name;?>">
				</div>
			</div>
		</div>
	</main>
<?php get_footer()?>