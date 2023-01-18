<?php
function theme_register ()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.min.css', array(), '5');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('bootstrap-bundle-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.js', array(), '5', true);
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), '1.0', true);

}
add_action('wp_enqueue_scripts', 'theme_register');