<?php
require __DIR__ . '/inc/cpt.php';
require __DIR__ . '/inc/acf-fields.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
});

add_action('wp_enqueue_scripts', function () {
    // Single, modern stylesheet (theme root style.css). Version pegged to file mtime so changes bust CDN cache automatically.
    $css = get_template_directory() . '/style.css';
    wp_enqueue_style('wx-jyy', get_stylesheet_uri(), [], file_exists($css) ? filemtime($css) : null);
    wp_enqueue_script('jquery');
    wp_enqueue_script(
        'wx-gundong',
        get_template_directory_uri() . '/js/gundong.js',
        ['jquery'], '1.1', true
    );
});

function wx_asset($rel) {
    return esc_attr(get_template_directory_uri() . '/' . ltrim($rel, '/'));
}

/** zh (default) or jp, controlled by ?wxlang= or wx_lang cookie. (Avoid ?lang= — WP reserves it.) */
function wx_lang() {
    static $cached = null;
    if ($cached !== null) return $cached;
    if (isset($_GET['wxlang'])) {
        $cached = ($_GET['wxlang'] === 'jp') ? 'jp' : 'zh';
        if (!headers_sent()) {
            setcookie('wx_lang', $cached, time() + 86400 * 30, '/');
        }
    } else {
        $cached = (($_COOKIE['wx_lang'] ?? '') === 'jp') ? 'jp' : 'zh';
    }
    return $cached;
}
function wx_is_jp() { return wx_lang() === 'jp'; }

function wx_switch_url() {
    $target = wx_is_jp() ? 'zh' : 'jp';
    $uri = preg_replace('/([?&])wxlang=(zh|jp)/', '$1', $_SERVER['REQUEST_URI']);
    $uri = rtrim($uri, '?&');
    $sep = strpos($uri, '?') === false ? '?' : '&';
    return esc_url($uri . $sep . 'wxlang=' . $target);
}
