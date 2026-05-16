<?php
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(['primary' => 'Primary Menu']);
});

add_action('wp_enqueue_scripts', function () {
    // Page-specific CSS is loaded directly in each template; only enqueue jquery for home slider.
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'wx-gundong',
        get_template_directory_uri() . '/js/gundong.js',
        ['jquery'], '1.0', true
    );
});

// Rewrite any /image/ or /css/ references in legacy HTML so they hit the theme directory.
function wx_asset($rel) {
    return esc_attr(get_template_directory_uri() . '/' . ltrim($rel, '/'));
}
