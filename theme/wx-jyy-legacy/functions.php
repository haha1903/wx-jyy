<?php
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
});

add_action('wp_enqueue_scripts', function () {
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

/** zh (default) or jp, controlled by ?lang= or wx_lang cookie. */
function wx_lang() {
    static $cached = null;
    if ($cached !== null) return $cached;
    if (isset($_GET['lang'])) {
        $cached = ($_GET['lang'] === 'jp') ? 'jp' : 'zh';
        if (!headers_sent()) {
            setcookie('wx_lang', $cached, time() + 86400 * 30, '/');
        }
    } else {
        $cached = (($_COOKIE['wx_lang'] ?? '') === 'jp') ? 'jp' : 'zh';
    }
    return $cached;
}
function wx_is_jp() { return wx_lang() === 'jp'; }

/** Same URL with the language toggled. */
function wx_switch_url() {
    $target = wx_is_jp() ? 'zh' : 'jp';
    $uri = preg_replace('/([?&])lang=(zh|jp)/', '$1', $_SERVER['REQUEST_URI']);
    $uri = rtrim($uri, '?&');
    $sep = strpos($uri, '?') === false ? '?' : '&';
    return esc_url($uri . $sep . 'lang=' . $target);
}
