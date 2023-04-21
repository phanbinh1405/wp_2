<?php 
get_header('', array('title'=>wp_title('', false))) 
?>

	<main class="p-service">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="index.html">Home</a>
				<a href="publish.html">ご提供サービス</a>
				<span>法人税務顧問</span>
			</div>
		</div>
		<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post()?>
				<div class="c-headpage">
					<div class="l-container2">
						<h2 class="c-title"><?php the_title( ) ?></h2>
					</div>
					<?php if(get_field('description')): ?>
						<p>
							<?php echo get_field('description') ?>
						</p>
					<?php endif; ?>
				</div>

			<?php if (get_field("image")){ ?>
				<div class="feature_img">
					<img src="<?php echo get_field('image')['url']; ?>" alt="<?php the_title('', false); ?>">
				</div>
			<?php } ?>

				<div class="p-service__consultation">
					<dl class="l-container2">
						<dt>このような方はご相談ください</dt>
						<?php if(have_rows('target')): ?>
							<?php while(have_rows('target')): the_row()?>
								<dd class="c-checkMark"><?php the_sub_field('target_txt') ?></dd>
						<?php endwhile; endif;?>
					</dl>
				</div>

				<div class="p-service__merit">
					<?php if(have_rows('advantage')) { ?>
						<div class="l-container2">
							<h3 class="p-service__title">ひかり税理士法人を選ぶメリット</h3>
							<dl>
								<?php while(have_rows('advantage')): the_row() ?>
									<dt class="c-checkMark"><?php the_sub_field('advantage_title') ?></dt>
									<dd><?php the_sub_field('advantage_description') ?></dd>
								<?php endwhile;?>
							</dl>
						</div>
					<?php } ?>
				</div>

				<div class="p-service__flow">
					<div class="l-container2">
						<h3 class="p-service__title">サービスの流れ</h3>
						<?php if(have_rows('steps')): ?>
							<?php while(have_rows('steps')): the_row()?>
								<table>
									<tbody>
										<tr>
										<th>STEP<?php echo get_row_index() ?></th>
										<td>
											<h4 class="flow-title"><?php the_sub_field('step_tite') ?></h4>
											<?php if(have_rows('step_sub_container')): ?>
												<?php while(have_rows('step_sub_container')): the_row() ?>
													<h5 class="flow-subtitle"><?php the_sub_field('step-subtitle')  ?></h5>
													<?php if(have_rows('step_description')): ?>
														<?php while(have_rows('step_description')): the_row() ?>
														<p class="c-checkMark"><?php the_sub_field('step_des_content') ?></p>
													<?php endwhile; endif;?>
											<?php endwhile; endif;?>
										</td>
										</tr>
									</tbody>
								</table>
						<?php endwhile; endif; ?>
					</div>
				</div>

				<div class="p-service__division">
					<div class="l-container">
						<h3 class="p-service__subtitle">関連サービス</h3>
						<ul class="division-list c-flex">
							<li class="small-12 medium-4">
								<?php 
									$prev_post = get_adjacent_post( true, '', true, 'service-category' );
									if($prev_post) {
										$prev_post_link = get_permalink( $prev_post->ID );
										$prev_post_thumb = get_the_post_thumbnail($prev_post->ID);
								?>
								<a href="<?php echo $prev_post_link?>">
									<p class="img"><?php echo $prev_post_thumb?></p>
									<p class="text"><span class="arrow"><?php echo $prev_post->post_title ?></span></p>
								</a>
								<?php } ?>
							</li>
							<li class="small-12 medium-4">
								<?php 
									$next_post = get_adjacent_post( true, '', false, 'service-category' );
									if($next_post) {
									$next_post_link = get_permalink( $next_post->ID );
									$next_post_thumb = get_the_post_thumbnail($next_post->ID);
								?>
									<a href="<?php echo $next_post_link ?>">
										<p class="img"><?php echo $next_post_thumb ?></p>
										<p class="text"><span class="arrow"><?php echo $next_post->post_title ?></span></p>
									</a>
								<?php } ?>
							</li>
						</ul>
					</div>
					<div class="l-btn">
							<div class="c-btn c-btn--small">
								<a href="<?php echo get_post_type_archive_link( 'service' ) ?>">ご提供サービス一覧へ</a>
							</div>
						</div>
					</div>
				</div>
		<?php endwhile; endif;?>
	
	</main>

<?php get_footer() ?>