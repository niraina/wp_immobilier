<?php
function assets_register ()
{
    /*CSS files*/
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css');
    wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    /*Javascript files*/
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'assets_register');