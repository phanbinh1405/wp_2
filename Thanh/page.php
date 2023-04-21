<?php get_header();
$page = get_post(); 
$page_slug = $post->post_name;
?>
<main class="p-<?php echo $page_slug ?>">
	<div class="c-title c-title--page">
		<h1><?php echo get_the_title(); ?></h1>
	</div>
	<div class="l-container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif;
		?>
	</div>
</main>
<?php get_footer(); ?>