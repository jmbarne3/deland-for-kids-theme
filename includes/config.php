<?php
/**
 * All config functions here
 **/
function __init__() {
    add_theme_support( 'menus' );
    add_theme_support( 'post_thumbnails' );
    add_theme_support( 'custom-header', array(
        'width' => 1600,
        'height' => 450
    ) );

    register_nav_menu( 'header-menu', __( 'Header Menu' ) );
}

add_action( 'after_setup_theme', '__init__' );

function enqueue_frontend_assets() {
    // Javascripts
    wp_dequeue_script( 'jquery' );
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.2.1.min.js', null, null, true );
    wp_enqueue_script( 'tether', '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', ['jquery'], null, true );
    wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', ['jquery', 'tether'], null, true );\

    // Styles
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/static/css/style.min.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_frontend_assets', 10, 0 );