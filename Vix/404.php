<?php get_header()?>
<main id="site-content">
	<div class="c-error__content">
	<div class="l-container"> 
		<h1 class="c-error__404">404</h1>
		<p class="c-error__title">お探しのページは見つかりませんでした</p>
		<div class="c-error__intro"><p>お探しのページは見つかりませんでした。削除されたか、名前が変更されたか、存在しなかった可能性があります。</p></div>
        <a href="<?php echo esc_url( home_url() ); ?>" class="c-error__backbtn">ページトップへ戻る</a>
	</div>
	</div>
</main>
<?php get_footer()?>