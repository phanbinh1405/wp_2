<?php get_header() ?>
	<main class="p-publish">
		<div class="c-breadcrumb">
			<div class="l-container">
				<a href="<?php echo esc_url(home_url()) ?>">Home</a>
				<a href="<?php echo esc_url(home_url('/publish')) ?>">出版物</a>
				<span><?php the_title()?></span>
			</div>
		</div>
	
		<div class="l-container">
			<div class="p-publish__single">
				<?php 
					if(have_posts()){
						while(have_posts()){
							the_post();
							$publish_date = get_field('publishdate');
							$author = get_field('author');
							$publisher = get_field('publisher');
							$img = get_field('image');
							$price = get_field('price');
							$desc = get_field('description');
							$content = get_field('content');
							if ($img){
								echo '<div class="feature_img">';
								echo '<img src="'.$img['url'].'" alt="'.get_the_title().'">';
								echo '</div>';
							}
							echo '<div class="p-publish__info">';
									if (get_the_title() != ""){echo '<h2>'.get_the_title().'</h2>';};
									if ($publish_date){echo '<p class="datepost">'.$publish_date.'</p>';};
									if ($author || $publisher){
										echo '<p class="author">';
										if($author){echo '著者  :'.$author.'<br>';};
										if($publisher){echo '出版社 :'.$publisher;};
										echo '</p>';
									};
									if ($price){echo '<p class="price">¥'.$price.' (税別)</p>';};
									echo '<div class="desc">';
									if ($desc){echo '<p>'.$desc.'</p>';};
									if($content){
										echo '<h4>目次</h4>';
										echo $content;
									};
									echo '</div></div>';
						}}
				?>

				
			</div>
			<div class="l-btn">
				<div class="c-btn c-btn--small2">
					<a href="<?php echo esc_url(home_url('/publish')) ?>">出版物一覧へ</a>
				</div>
			</div>
		</div>
	</main>
	<?php get_footer() ?>