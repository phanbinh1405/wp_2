<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php if(is_home() || is_front_page()){echo "Home";}else{wp_title('');}?>">
	<title>
		<?php if(is_home() || is_front_page()){
            echo "Hikari Zeirishi";
            }else{
                wp_title('');
            }?>
	</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
    <?php wp_head()?>
</head>

<body>
    <header class="c-header">
        <div class="l-container">
            <h1 class="c-logo"><a href="<?php echo esc_url( home_url() ); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="Hikari Zeirishi Tax"></a></h1>
            <nav class="c-gnav">
                <ul>
                    <?php $current_page = get_queried_object();
                        $page_slug = $current_page->name;
                        $page = $current_page ? $page_slug  :"";

                    ?>
                    <li <?php if($page == 'services'){echo 'class="active"';}?> ><a href="<?php echo esc_url( home_url('/services') ); ?>">サービス</a></li>
                    <li <?php if($page == 'publish'){echo 'class="active"';}?> ><a href="<?php echo esc_url( home_url('/publish') ); ?>">出版物</a></li>
                    <li><a href="<?php echo esc_url( home_url('/contact') ); ?>">お問い合わせ</a></li>
                </ul>
            </nav>
        </div>
    </header>