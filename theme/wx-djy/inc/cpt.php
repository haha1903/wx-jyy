<?php
/**
 * Custom Post Types: news / product / equipment
 * Each one is bilingual via paired ACF fields (xxx_zh + xxx_jp); see acf-fields.php.
 */

add_action('init', function () {

    // 公司新闻 / News
    register_post_type('news', [
        'label'        => '公司新闻',
        'public'       => true,
        'has_archive'  => false,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-megaphone',
        'supports'     => ['title', 'editor', 'page-attributes'],
        'rewrite'      => ['slug' => 'news'],
        'labels'       => [
            'name'          => '公司新闻',
            'singular_name' => '新闻',
            'add_new_item'  => '添加新闻',
            'edit_item'     => '编辑新闻',
            'all_items'     => '全部新闻',
        ],
    ]);

    // Product category taxonomy (medical / detection / semiconductor / general)
    register_taxonomy('product_cat', 'product', [
        'label'        => '产品分类',
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'product-cat'],
        'labels'       => [
            'name'          => '产品分类',
            'singular_name' => '分类',
            'add_new_item'  => '添加分类',
        ],
    ]);

    // 产品 / Product (each entry = a single product/image card)
    register_post_type('product', [
        'label'        => '产品',
        'public'       => true,
        'has_archive'  => false,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-products',
        'supports'     => ['title', 'thumbnail', 'page-attributes'],
        'taxonomies'   => ['product_cat'],
        'rewrite'      => ['slug' => 'product'],
        'labels'       => [
            'name'          => '产品',
            'singular_name' => '产品',
            'add_new_item'  => '添加产品',
            'edit_item'     => '编辑产品',
            'all_items'     => '全部产品',
        ],
    ]);

    // 设备 / Equipment
    register_post_type('equipment', [
        'label'        => '设备',
        'public'       => true,
        'has_archive'  => false,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-admin-tools',
        'supports'     => ['title', 'thumbnail', 'page-attributes'],
        'rewrite'      => ['slug' => 'equipment'],
        'labels'       => [
            'name'          => '设备',
            'singular_name' => '设备',
            'add_new_item'  => '添加设备',
            'edit_item'     => '编辑设备',
            'all_items'     => '全部设备',
        ],
    ]);

    // Equipment section (主要设备 / 加工中心 / 加工工序)
    register_taxonomy('equipment_section', 'equipment', [
        'label'        => '设备分组',
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'equipment-section'],
        'labels'       => [
            'name'          => '设备分组',
            'singular_name' => '分组',
            'add_new_item'  => '添加分组',
        ],
    ]);
});

/**
 * Bilingual field helper: returns the requested language's value, falling back to ZH if JP is empty.
 *
 *   wx_field('title')                 -> title_zh or title_jp depending on current language
 *   wx_field('title', $post_id)       -> same, for a specific post
 *   wx_sub_field('caption')           -> bilingual flavored get_sub_field for ACF repeaters
 */
function wx_field($name, $post_id = null) {
    if (!function_exists('get_field')) return '';
    $suffix = wx_is_jp() ? '_jp' : '_zh';
    $v = get_field($name . $suffix, $post_id);
    if (!$v && wx_is_jp()) {
        // fallback to zh if jp is empty
        $v = get_field($name . '_zh', $post_id);
    }
    return $v;
}

function wx_sub_field($name) {
    if (!function_exists('get_sub_field')) return '';
    $suffix = wx_is_jp() ? '_jp' : '_zh';
    $v = get_sub_field($name . $suffix);
    if (!$v && wx_is_jp()) {
        $v = get_sub_field($name . '_zh');
    }
    return $v;
}

/** Normalize ACF image field (id / array / url) to a plain URL. */
function wx_img_url($v) {
    if (!$v) return '';
    if (is_array($v)) return $v['url'] ?? '';
    if (is_numeric($v)) return wp_get_attachment_url((int) $v) ?: '';
    return (string) $v;
}

/** Options live on the home page (ACF Free has no options page). */
function wx_options_pid() {
    $pid = (int) get_option('page_on_front');
    return $pid ?: null;
}
