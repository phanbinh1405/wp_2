<?php get_header(); ?>

<main class="p-publish">
	<?php get_breadcrumb() ?>
	<div class="l-container">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post() ?>
				<div class="p-publish__single">
					<?php if (get_field('image')) : ?>
						<div class="feature_img">
							<img src="<?php echo get_field('image')['url'] ?>" alt="<?php the_title() ?>">
						</div>
					<?php endif; ?>
					<div class="p-publish__info">
						<?php if (get_field('title')) { ?>
							<h2><?php echo get_field('title') ?></h2>
						<?php } ?>
						<?php if (get_field('title')) { ?>
							<p class="datepost"><?php echo get_field('publication_date') ?> 発行</p>
						<?php } ?>

						<?php if (get_field('author') || get_field('publisher')) { ?>
							<p class="author">
								<?php if (get_field('author')) { ?>
									著者  : <?php echo get_field('author') ?><br>
								<?php } ?>
								<?php if (get_field('publisher')) { ?>
									出版社 : <?php echo get_field('publisher') ?>
								<?php } ?>
							</p>
						<?php } ?>

						<?php if (get_field('price')) { ?>
							<p class="price">¥<?php echo get_field('price') ?> (税別)</p>
						<?php } ?>
						<?php if (get_field('description') || get_field('contents')) { ?>
							<div class="desc">
								<?php if (get_field('description')) { ?>
									<p><?php echo get_field('description') ?></p>
								<?php } ?>
								<?php if (get_field('contents')) { ?>
									<h4>目次</h4>
									<p><?php echo get_field('contents') ?></p>
							</div>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
		<?php endwhile;
		endif; ?>
		<div class="l-btn">
			<div class="c-btn c-btn--small2">
				<a href="<?php echo get_post_type_archive_link('publish') ?>">出版物一覧へ</a>
			</div>
		</div>
	</div>
</main>
<?php get_footer() ?>