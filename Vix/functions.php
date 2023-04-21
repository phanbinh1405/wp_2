<?php


	//USE CLASSIC EDITOR FOR POST
	add_filter('use_block_editor_for_post', '__return_false', 10);

	//PUBLISH CTP  
	add_theme_support( 'post-thumbnails' );
	function publish_on_menu() {
		register_post_type('publish',
			array(
				'labels'      => array(
					'name'          => __('出版物'),
					'singular_name' => __('Publish'),
				),
				'public'      => true,
				'rewrite' => array('slug' => '', 'with_front' => false),
				'show_in_rest' =>	true,
				'has_archive' => true,
				'menu_position' => 4

			)
		);
	}
	add_action('init', 'publish_on_menu');
	add_post_type_support( 'publish', 'thumbnail' ); 
	//SERVICE CTP
	function service_on_menu() {
		register_post_type('services',
			array(
				'labels'      => array(
					'name'          => __('サービス'),
					'singular_name' => __('ご提供サービス'),
				),
				'rewrite' =>	['slug' => '','with_front' => false],
				'public'      => true,
				// 'taxonomies'    =>  array('services-category'),
				'show_in_rest' =>	true,
				'has_archive' => true,
				'menu_position' => 5
			)
		);
	
		register_taxonomy('services-category' , 'services', 
			[
				'label' => __('Categories'),
				'hierarchical' => true,
				'show_in_rest' =>	true,
				'public' => true,
			]
		);
	}
	add_action('init', 'service_on_menu');
	add_post_type_support( 'services', 'thumbnail' );  
 
	//PAGINATION
	function post_pagination($total_pages,$paged){
		if ( $total_pages > 1) {
			$pagination = array(
				'base' => get_pagenum_link() . '%_%',
				'format' => 'page/%#%',
				'mid-size' => 3,
				'current' => $paged,
				'total' => $total_pages,
				'prev_next' => True,
				'prev_text' => ( '' ),
				'next_text' => ( '' ),
			);}
			if(is_page('出版物')){
				echo '<div class="c-pagination">'.paginate_links( $pagination ).'</div>';
			}else{
				echo '<li class="c-pagination" data-cates="all">'.paginate_links( $pagination ).'</li>';
			};
	}
	//LIST POST
	function list_post($cate_id = ''){
		?>
			<li class="c-listpost__item">
				<div class="c-listpost__info">
					<span class="c-datepost datepost"><?php echo get_the_date('Y年m月d日');?></span>
					<div class="c-cats">
					
						<?php
							if ($cate_id != ''){
								
								$cat = get_category($cate_id);
								$cat_color = get_field('catcolor', $cat->taxonomy.'_'.$cat->term_id);
								echo '<span class="c-cat cat">';
								echo '<i class="c-dotcat" style="background-color: '.$cat_color.'"></i>';
								echo '<a href="news/category/'.get_category_link($cat->term_id).'" class="">'.$cat->name.'</a> ';
								echo '</span>';
							} else{
								$cate = (wp_get_post_categories(get_the_ID())); 
								if (!empty($cate)){
									foreach ($cate as $key => $value) {
										$cat = get_category($value);
										$cat_color = get_field('catcolor', $cat->taxonomy.'_'.$cat->term_id);
										echo '<span class="c-cat cat">';
										echo '<i class="c-dotcat" style="background-color: '.$cat_color.'"></i>';
										echo '<a href="'.get_category_link($cat->term_id).'" class="">'.$cat->name.'</a> ';
										echo '</span>';
									}
								}
							}
						?>
					</span>
					</div>
				</div>
				<h3 class="titlepost"><a href="<?php echo get_post_permalink() ?>"><?php echo get_the_title() ?></a></h3>
			</li>

		<?php
	}
	//LIST PUBLISH
	function list_publish(){
		?>
			<li class="c-gridpost__item">
				<a href="<?php echo get_post_permalink() ?>">
					<?php 
						if(get_field('image')){
							echo '<div class="c-gridpost__thumb">
							<img src="'.get_field('image')['url'].'" alt="'.get_the_title().'">
						</div>';
						}
					?>
					
					<p class="datepost"><?php echo get_the_date('Y年m月d日');?></p>
					<h3><?php  the_title() ?></h3>
				</a>
			</li>
		<?php
	}
	//AJAX FILTER SERVICES
	function ajax_services_filter(){

		$result['type'] = 'error';
		$result['message'] = "Error";
		$total_services_post = wp_count_posts('services')->publish;
		$input = $_REQUEST["input"];
	
		$args = [
			'post_type' => 'services' , 
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'paged' => 1 , 
		];
	
		if (!empty($input)){
			$args['tax_query'] = [
				'relation' => 'or',
				[
					'taxonomy' => 'services-category',
					'field'    => 'term_id',
					'terms'		=> $input,
				]
			];
			
		}

		$the_query = new WP_Query( $args );
		
		if (is_wp_error($the_query) ) {
			$result = json_encode($result);
	
		} elseif (!is_wp_error($the_query) && $the_query->post_count == 0) {
			$result['type'] = 'empty';
			$result['message'] = "Khong co du lieu";
			$result = json_encode($result);
		} else{
				
			$posts = $the_query->posts;
			ob_start();
	
			foreach ($posts as $value) {
				?>
				<li class="c-column__item">
					<a href="<?php echo get_permalink($value->ID) ?>">
					<?php if (get_field('icon',$value->ID)){
							echo '<img src="'.get_field('icon',$value->ID)['url'].'" alt="'. get_the_title($value->ID).'">';
							}?>	

						<p><?php echo get_the_title($value->ID) ?></p>
					</a>
				</li>
			<?php	
			}
			
			wp_reset_postdata();
			$content = ob_get_contents();
			ob_end_clean();
			$result['type'] = "success";
			$result['message'] = "Thanh cong";
			$result['content'] = $content;
			$result['count'] = $the_query->post_count;
			$result = json_encode($result);
		}
	
		echo $result;
		die();
	}
	
	add_action( 'wp_ajax_nopriv_ajax_services_filter', 'ajax_services_filter' ); 
	add_action( 'wp_ajax_ajax_services_filter', 'ajax_services_filter' ); 
	//MW WP FORM 
	add_filter( 'mwform_error_message_mw-wp-form-214', 'custom_mwform_error_message', 10, 3 );
	function custom_mwform_error_message( $error, $key, $rule ) {
	if ( $key === 'firstname' || $key ==='lastname' || $key ==='message' || $key ==='email' || $key ==='emailconfirm' || $key ==='message' ) {
		if ( $rule === 'noempty' ) {
		return '入力されていません';
		}	
	}
	if($key ==='email' || $key==='emailconfirm'){
		if( $rule ==='mail'){
			return '有効なメールアドレスを入力してください。例:  example@gmail.com';
		}
	}
	if($key ==='emailconfirm' && $rule ==='eq'){
		return 'メールアドレスが一致しません';
	}
	if($key==='tel' && $rule==='numeric'){
		return '番号を入力してください';
	}
	if($key==='tel' && $rule==='between'){
		return '電話番号を10～12文字で入力してください';
	}
	return $error;
	}


	///OPTION FRONT PAGE 
	if( function_exists('acf_add_options_page') ) {
    
		acf_add_options_page(array(
			'page_title'    => 'Front Page',
			'menu_title'    => 'Front Page Setting',
			'menu_slug'     => 'front-page-settings',
			'capability'    => 'edit_posts',
			'redirect'      => false
		));
	}
?>                       
