<!DOCTYPE html>
<html lang="en-us">
    <head>
    <?php wp_head(); ?>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary" role="navigation">
                <div class="container">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                        wp_nav_menu( array(
                            'theme_location'  => 'header-menu',
                            'depth'           => 1,
                            'container'       => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => 'header-menu',
                            'menu_class'      => 'nav navbar-nav',
                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'          => new WP_Bootstrap_Navwalker()
                        ) );
                    ?>
                </div>
            </nav>
            <div style="background: url('<?php header_image(); ?>'); min-height: 450px;" class="mb-4">
                <h1><?php the_title(); ?></h1>
            </div>
        </header>