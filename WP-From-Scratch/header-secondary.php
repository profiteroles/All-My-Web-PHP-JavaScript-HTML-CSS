<!DOCTYPE html>
<html>
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<nav class="navbar navbar-expand-md navbar-light bg-orange" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-lg-2 col-md-3 col-sm image-fluid">
            <a href="/wordpress"><?php dynamic_sidebar('top_logo'); ?></a>
        </div>
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'top-menu',
            'depth'             => 1,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'bs-example-navbar-collapse-1',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>
        <div class="col-lg-3 col-md-6 display-6">
            <?php get_search_form(); ?>
        </div>
    </div>
</nav>





<!--<header>-->
<!--    <div class="container row align-content-lg-stretch">-->
<!--        <div class="col-lg-2 col-md-3 col-sm-3 image-fluid">-->
<!--            <a href="/wordpress">--><?php //dynamic_sidebar('top_logo'); ?><!--</a>-->
<!--        </div>-->
<!--        <div class="col-lg-6 col-md-9 col-sm-9 align-items-center container-fluid">-->
<!--            --><?php //wp_nav_menu(array('theme_location' => 'top-menu', 'menu_class' => 'top-bar')); ?>
<!--        </div>-->
<!--        <div class="col-lg-3 col-md-6 display-6">-->
<!--            --><?php //get_search_form(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</header>-->

