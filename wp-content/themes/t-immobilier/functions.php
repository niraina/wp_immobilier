<?php
require_once 'incs/enqueues.php';

function theme_supports() 
{
    add_theme_support('menus');
    register_nav_menu('header', 'Menu principale');
    add_theme_support( 'woocommerce');
}

function theme_menu_class($_classes){
    $_classes[] = 'nav-item';
    return $_classes;
}

function theme_menu_link_class($_attrs) {
    $_attrs['class'] = 'nav-link';
    return $_attrs;
}

// $_template_path = get_template_directory_uri();
// $_template_path = parse_url($_template_path, PHP_URL_PATH);
// pass: A#I4KVCH^@^AKtkleF

add_action('after_setup_theme', 'theme_supports');
add_filter('nav_menu_css_class', 'theme_menu_class');
add_filter('nav_menu_link_attributes', 'theme_menu_link_class');