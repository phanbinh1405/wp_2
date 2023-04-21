<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmgp.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <title><?php 
    if (is_front_page()) { ?> 
        Home | <?php bloginfo('name'); 
    } else {
        wp_title('|', 'true', 'right'); bloginfo('name');
    } ?></title>  
    <meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/style.css">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="c-header">
        <div class="l-container">
            <?php task14_top(); ?>
            <?php task14_menu('primary'); ?>
        </div>
    </header>