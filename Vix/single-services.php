<?php get_header()?>
	<main class="p-service">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="index.html">Home</a>
				<a href="publish.html">ご提供サービス</a>
				<span>法人税務顧問</span>
			</div>
		</div>
		<?php 
			if(have_posts()){
				while(have_posts()){
					the_post();
					echo '<div class="c-headpage">';
					echo '<div class="l-container2">
						<h2 class="c-title">'.get_the_title().'</h2>
					</div>';
						$des = get_field('description');
						if($des){
							echo '<p>'.$des.'</p>';
						}
					echo '</div>';
					$img = get_field('image')['url'];
					if($img){
						echo '<div class="feature_img"><img src="'.$img.'" alt=""></div>';
					}
					
					echo '<div class="p-service__consultation">
						<dl class="l-container2">
						<dt>このような方はご相談ください</dt>';
								if(have_rows('target')){
									while(have_rows('target')){
										the_row();
										$target = get_sub_field('target');
										echo '<dd class=c-checkMark>'.$target.'</dd>';
									}
								}
					echo '</dl></div>';
					echo '<div class="p-service__merit">
					<div class="l-container2">
					  <h3 class="p-service__title">ひかり税理士法人を選ぶメリット</h3>
					  <dl>';
						  if(have_rows('advantage')){
							  while(have_rows('advantage')){
								  the_row();
								  $ad_title = get_sub_field('advantage-title');
								  $ad_desc = get_sub_field('advantage-description');
								  if($ad_title){
									  echo '<dt class="c-checkMark">'.$ad_title.'</dt>';
								  }
								  if($ad_desc){
									  echo '<dd>'.$ad_desc.'</dd>';
								  }
								  
							  }
						  }
					echo '</dl></div></div>';
					echo '<div class="p-service__flow">
						<div class="l-container2">
							<h3 class="p-service__title">サービスの流れ</h3>';
								if(have_rows('steps')){
									while (have_rows('steps')){
										the_row();
										echo '<table><tbody><tr>';
										echo '<th>STEP '.get_row_index().'</th>';
										$step_title = get_sub_field('step-title');
										echo '<td>';
										if($step_title){
											echo '<h4 class="flow-title">'.$step_title.'</h4>';
										}
										if(have_rows('step-subtitle')){
											while (have_rows('step-subtitle')){ 
												the_row();
												$step_subtitle = get_sub_field('step-subtitle');
												if($step_subtitle){
													echo '<h5 class="flow-subtitle">'.$step_subtitle.'</h5>';
												}
												if(have_rows('step-description')){
													while (have_rows('step-description')){
														the_row();
														$step_desc= get_sub_field('step-description');
														if($step_desc){
															echo '<p class="c-checkMark">'.$step_desc.'</p>';
														}
													}
												}
											}
										}
										echo '</td></tr></tbody></table>';
									}
								}
					echo '</div></div>';
		
					echo '<div class="p-service__division">
						<div class="l-container">
							<h3 class="p-service__subtitle">関連サービス</h3>
							<ul class="division-list c-flex">
								<li class="small-12 medium-4">';
										$prev_post = get_adjacent_post( true, '', true, 'services-category' );
										$prev_post_url = get_permalink($prev_post->ID);
										$prev_post_img = get_field('icon',$prev_post->ID);
										if($prev_post){
											echo '<a href="'.$prev_post_url.'">';
											if($prev_post_img){
												echo '<p class="img"><img src="'.$prev_post_img['url'].'" alt="'.$prev_post->post_title.'"></p>';
											}	
											echo '<p class="text"><span class="arrow">'.$prev_post->post_title.'</span></p>
												</a>';
										}
								echo '</li>
								<li class="small-12 medium-4">';
										$next_post = get_adjacent_post( true, '', false, 'services-category' );
										$next_post_url = get_permalink($next_post->ID);
										$next_post_img = get_field('icon',$next_post->ID);
										if($next_post){
											echo '<a href="'.$next_post_url.'">';
											if($next_post_img){
												echo '<p class="img"><img src="'.$next_post_img['url'].'" alt="'.$next_post->post_title.'"></p>';
											}
											echo '<p class="text"><span class="arrow">'.$next_post->post_title.'</span></p>
												</a>';
										}  
								echo '</li></ul></div>';				  
				}
			}
		?>
			      <div class="l-btn">
                        <div class="c-btn c-btn--small">
                            <a href="<?php echo esc_url( home_url('/services') ); ?>">ご提供サービス一覧へ</a>
                        </div>
                    </div>
			  </div>

		
	</main>
<?php get_footer()?>