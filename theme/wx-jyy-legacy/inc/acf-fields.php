<?php
/**
 * ACF field groups (PHP API). All visible content in templates is bound here.
 * Bilingual fields are paired (xxx_zh + xxx_jp); use wx_field()/wx_sub_field() to read.
 */

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    /* ===== reusable builders ===== */
    $txt2 = function ($name, $label) {
        return [
            ['key' => "f_{$name}_zh", 'name' => "{$name}_zh", 'label' => "$label (中文)", 'type' => 'text'],
            ['key' => "f_{$name}_jp", 'name' => "{$name}_jp", 'label' => "$label (日本語)", 'type' => 'text'],
        ];
    };
    $area2 = function ($name, $label) {
        return [
            ['key' => "f_{$name}_zh", 'name' => "{$name}_zh", 'label' => "$label (中文)", 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br'],
            ['key' => "f_{$name}_jp", 'name' => "{$name}_jp", 'label' => "$label (日本語)", 'type' => 'textarea', 'rows' => 3, 'new_lines' => 'br'],
        ];
    };
    $wys2 = function ($name, $label) {
        return [
            ['key' => "f_{$name}_zh", 'name' => "{$name}_zh", 'label' => "$label (中文)", 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0, 'tabs' => 'visual'],
            ['key' => "f_{$name}_jp", 'name' => "{$name}_jp", 'label' => "$label (日本語)", 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0, 'tabs' => 'visual'],
        ];
    };
    $img = function ($name, $label) {
        return [['key' => "f_{$name}", 'name' => $name, 'label' => $label, 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium']];
    };

    /* ===================== HOME ===================== */
    acf_add_local_field_group([
        'key'      => 'group_home',
        'title'    => '首页内容',
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'templates/home.php']]],
        'fields'   => array_merge(
            [['key' => 'f_tab_hero', 'label' => '主视觉', 'type' => 'tab']],
            $txt2('hero_eyebrow', 'Eyebrow 小字'),
            $txt2('hero_title', '主标题'),
            $area2('hero_subtitle', '副标题'),
            $img('hero_image', '背景图'),
            $txt2('hero_cta1', '主按钮文字'),
            [['key' => 'f_hero_cta1_url', 'name' => 'hero_cta1_url', 'label' => '主按钮链接', 'type' => 'text', 'default_value' => '/chanpin/']],
            $txt2('hero_cta2', '次按钮文字'),
            [['key' => 'f_hero_cta2_url', 'name' => 'hero_cta2_url', 'label' => '次按钮链接', 'type' => 'text', 'default_value' => '/lianxi/']],

            [['key' => 'f_tab_certs', 'label' => '公司资质', 'type' => 'tab']],
            $txt2('certs_title', '区块标题'),
            [[
                'key' => 'f_certs', 'name' => 'certs', 'label' => '证书图', 'type' => 'gallery',
                'return_format' => 'array', 'preview_size' => 'medium',
            ]],

            [['key' => 'f_tab_cats', 'label' => '业务领域', 'type' => 'tab']],
            $txt2('cats_title', '区块标题'),
            [[
                'key' => 'f_cats', 'name' => 'cats', 'label' => '卡片', 'type' => 'repeater',
                'min' => 1, 'max' => 6, 'layout' => 'block', 'button_label' => '添加卡片',
                'sub_fields' => [
                    ['key' => 'f_cat_image', 'name' => 'image', 'label' => '图', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail'],
                    ['key' => 'f_cat_title_zh', 'name' => 'title_zh', 'label' => '标题 (中)', 'type' => 'text'],
                    ['key' => 'f_cat_title_jp', 'name' => 'title_jp', 'label' => '标题 (日)', 'type' => 'text'],
                    ['key' => 'f_cat_desc_zh', 'name' => 'desc_zh', 'label' => '描述 (中)', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br'],
                    ['key' => 'f_cat_desc_jp', 'name' => 'desc_jp', 'label' => '描述 (日)', 'type' => 'textarea', 'rows' => 2, 'new_lines' => 'br'],
                    ['key' => 'f_cat_url', 'name' => 'url', 'label' => '链接', 'type' => 'text'],
                ],
            ]],

            [['key' => 'f_tab_belief', 'label' => '品质宣言', 'type' => 'tab']],
            $txt2('belief_title', '标题'),
            $area2('belief_p1', '正文 1'),
            $area2('belief_p2', '正文 2'),
            $img('belief_image', '配图'),
            $txt2('belief_cta', '按钮文字'),
            [['key' => 'f_belief_cta_url', 'name' => 'belief_cta_url', 'label' => '按钮链接', 'type' => 'text', 'default_value' => '/jieshao/']],

            [['key' => 'f_tab_factory', 'label' => '工厂实景', 'type' => 'tab']],
            $txt2('factory_title', '区块标题'),
            [[
                'key' => 'f_factory', 'name' => 'factory', 'label' => '照片', 'type' => 'repeater',
                'min' => 0, 'max' => 6, 'layout' => 'table', 'button_label' => '添加照片',
                'sub_fields' => [
                    ['key' => 'f_factory_image', 'name' => 'image', 'label' => '图', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail'],
                    ['key' => 'f_factory_cap_zh', 'name' => 'caption_zh', 'label' => '说明 (中)', 'type' => 'text'],
                    ['key' => 'f_factory_cap_jp', 'name' => 'caption_jp', 'label' => '说明 (日)', 'type' => 'text'],
                ],
            ]],

            [['key' => 'f_tab_news', 'label' => '新闻区块', 'type' => 'tab']],
            $txt2('news_title', '区块标题'),
            [['key' => 'f_news_count', 'name' => 'news_count', 'label' => '显示条数', 'type' => 'number', 'default_value' => 4, 'min' => 1, 'max' => 12]]
        ),
    ]);

    /* ===================== ABOUT (jieshao) ===================== */
    acf_add_local_field_group([
        'key'      => 'group_about',
        'title'    => '关于页内容',
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'templates/jieshao.php']]],
        'fields'   => array_merge(
            $txt2('about_eyebrow', 'Eyebrow 小字'),
            $txt2('about_title', '主标题'),
            $area2('about_lead', '导语'),

            [['key' => 'f_tab_about_intro', 'label' => '公司介绍', 'type' => 'tab']],
            $img('about_intro_image', '配图'),
            $txt2('about_intro_title', '小标题'),
            $wys2('about_intro_body', '正文'),

            [['key' => 'f_tab_about_features', 'label' => '服务/经营', 'type' => 'tab']],
            $txt2('feature1_title', '左卡标题'),
            [[
                'key' => 'f_feature1_items', 'name' => 'feature1_items', 'label' => '左卡条目', 'type' => 'repeater',
                'layout' => 'table', 'button_label' => '加一条',
                'sub_fields' => [
                    ['key' => 'f_f1_zh', 'name' => 'text_zh', 'label' => '中文', 'type' => 'text'],
                    ['key' => 'f_f1_jp', 'name' => 'text_jp', 'label' => '日本語', 'type' => 'text'],
                ],
            ]],
            $txt2('feature2_title', '右卡标题'),
            [[
                'key' => 'f_feature2_items', 'name' => 'feature2_items', 'label' => '右卡条目', 'type' => 'repeater',
                'layout' => 'table', 'button_label' => '加一条',
                'sub_fields' => [
                    ['key' => 'f_f2_zh', 'name' => 'text_zh', 'label' => '中文', 'type' => 'text'],
                    ['key' => 'f_f2_jp', 'name' => 'text_jp', 'label' => '日本語', 'type' => 'text'],
                ],
            ]],

            [['key' => 'f_tab_about_partner', 'label' => '合作企业', 'type' => 'tab']],
            $img('partner_image', '配图'),
            $txt2('partner_title', '小标题'),
            $wys2('partner_body', '正文')
        ),
    ]);

    /* ===================== NEWS (per-post bilingual body) ===================== */
    acf_add_local_field_group([
        'key'      => 'group_news',
        'title'    => '新闻内容 (双语)',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'news']]],
        'fields'   => array_merge(
            $txt2('news_date', '日期 (例: 2011 / 10)'),
            $area2('news_body', '正文'),
            [['key' => 'f_news_title_jp', 'name' => 'news_title_jp', 'label' => '日本語タイトル (标题填中文,这里填日语)', 'type' => 'text']]
        ),
    ]);

    /* ===================== PRODUCT (per-post) ===================== */
    acf_add_local_field_group([
        'key'      => 'group_product',
        'title'    => '产品信息',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'product']]],
        'fields'   => [
            ['key' => 'f_product_title_jp', 'name' => 'product_title_jp', 'label' => '产品标题 (日本語)', 'type' => 'text'],
        ],
    ]);

    /* ===================== EQUIPMENT ===================== */
    acf_add_local_field_group([
        'key'      => 'group_equipment',
        'title'    => '设备信息',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'equipment']]],
        'fields'   => array_merge(
            [['key' => 'f_equip_title_jp', 'name' => 'equip_title_jp', 'label' => '设备标题 (日本語)', 'type' => 'text']]
        ),
    ]);

    /* ===================== CONTACT (lianxi) ===================== */
    acf_add_local_field_group([
        'key'      => 'group_contact',
        'title'    => '联系页内容',
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'templates/lianxi.php']]],
        'fields'   => [
            ['key' => 'f_contact_intro_zh', 'name' => 'contact_intro_zh', 'label' => '页眉 (中文)', 'type' => 'text', 'default_value' => '公司概要'],
            ['key' => 'f_contact_intro_jp', 'name' => 'contact_intro_jp', 'label' => '页眉 (日本語)', 'type' => 'text', 'default_value' => 'お問い合わせ'],
        ],
    ]);

    /* ===================== SITE OPTIONS (全站联系方式 / 页脚 / SEO)
     * ACF Free 没有 options page，所以这套字段也挂到 "首页" page；用 wx_options_pid() 读取。
     */
    acf_add_local_field_group([
        'key'      => 'group_site',
        'title'    => '站点设置 (导航/联系/SEO)',
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'templates/home.php']]],
        'fields'   => array_merge(
            [['key' => 'f_tab_brand', 'label' => '品牌', 'type' => 'tab']],
            [['key' => 'f_site_logo', 'name' => 'site_logo', 'label' => '品牌 Logo (SVG/PNG)', 'type' => 'image', 'return_format' => 'url']],
            $txt2('site_brand', '品牌名'),

            [['key' => 'f_tab_contact_cn', 'label' => '联系 - 中国', 'type' => 'tab']],
            ['key' => 'f_cn_label_zh', 'name' => 'cn_label_zh', 'type' => 'text', 'label' => '中国区标签 (中)', 'default_value' => '中国区'],
            ['key' => 'f_cn_label_jp', 'name' => 'cn_label_jp', 'type' => 'text', 'label' => '中国区标签 (日)', 'default_value' => '中国本社'],
            ['key' => 'f_cn_addr_zh', 'name' => 'cn_addr_zh', 'type' => 'text', 'label' => '中国地址 (中)'],
            ['key' => 'f_cn_addr_jp', 'name' => 'cn_addr_jp', 'type' => 'text', 'label' => '中国地址 (日)'],
            ['key' => 'f_cn_tel', 'name' => 'cn_tel', 'type' => 'text', 'label' => '电话'],
            ['key' => 'f_cn_fax', 'name' => 'cn_fax', 'type' => 'text', 'label' => '传真'],
            ['key' => 'f_cn_mobile', 'name' => 'cn_mobile', 'type' => 'text', 'label' => '手机'],
            ['key' => 'f_cn_email', 'name' => 'cn_email', 'type' => 'text', 'label' => 'E-mail'],
            ['key' => 'f_cn_postcode', 'name' => 'cn_postcode', 'type' => 'text', 'label' => '邮编'],
            ['key' => 'f_cn_map', 'name' => 'cn_map', 'type' => 'image', 'label' => '地图图片', 'return_format' => 'url'],

            [['key' => 'f_tab_contact_jp', 'label' => '联系 - 日本', 'type' => 'tab']],
            ['key' => 'f_jp_label_zh', 'name' => 'jp_label_zh', 'type' => 'text', 'label' => '日本区标签 (中)', 'default_value' => '日本区'],
            ['key' => 'f_jp_label_jp', 'name' => 'jp_label_jp', 'type' => 'text', 'label' => '日本区标签 (日)', 'default_value' => '諦佳揚貿易'],
            ['key' => 'f_jp_postcode', 'name' => 'jp_postcode', 'type' => 'text', 'label' => '邮编'],
            ['key' => 'f_jp_addr_zh', 'name' => 'jp_addr_zh', 'type' => 'text', 'label' => '日本地址 (中)'],
            ['key' => 'f_jp_addr_jp', 'name' => 'jp_addr_jp', 'type' => 'text', 'label' => '日本地址 (日)'],
            ['key' => 'f_jp_tel', 'name' => 'jp_tel', 'type' => 'text', 'label' => 'TEL / FAX'],
            ['key' => 'f_jp_mobile', 'name' => 'jp_mobile', 'type' => 'text', 'label' => '携帯 / Mobile'],

            [['key' => 'f_tab_company_info', 'label' => '公司概要 (用于 lianxi 页)', 'type' => 'tab']],
            ['key' => 'f_ci_name_zh', 'name' => 'company_name_zh', 'type' => 'text', 'label' => '公司名称 (中)'],
            ['key' => 'f_ci_name_jp', 'name' => 'company_name_jp', 'type' => 'text', 'label' => '公司名称 (日)'],
            ['key' => 'f_ci_ceo_zh', 'name' => 'ceo_zh', 'type' => 'text', 'label' => '总经理 (中)'],
            ['key' => 'f_ci_ceo_jp', 'name' => 'ceo_jp', 'type' => 'text', 'label' => '总经理 (日)'],
            ['key' => 'f_ci_overseas_zh', 'name' => 'overseas_zh', 'type' => 'text', 'label' => '海外部经理 (中)'],
            ['key' => 'f_ci_overseas_jp', 'name' => 'overseas_jp', 'type' => 'text', 'label' => '海外部经理 (日)'],
            ['key' => 'f_ci_founded', 'name' => 'founded', 'type' => 'text', 'label' => '设立年月日'],
            ['key' => 'f_ci_capital', 'name' => 'capital_jp', 'type' => 'text', 'label' => '資本金 (日语用)'],
            ['key' => 'f_ci_business_jp', 'name' => 'business_jp', 'type' => 'textarea', 'label' => '事業内容 (日)', 'rows' => 2, 'new_lines' => 'br'],

            [['key' => 'f_tab_footer', 'label' => '页脚 / 备案', 'type' => 'tab']],
            ['key' => 'f_footer_copyright', 'name' => 'footer_copyright', 'type' => 'text', 'label' => 'Copyright 文字', 'default_value' => 'Copyright(c) %Y djy industry,Inc. All Rights Reserved.'],
            ['key' => 'f_beian', 'name' => 'beian', 'type' => 'text', 'label' => '备案号'],
            ['key' => 'f_beian_url', 'name' => 'beian_url', 'type' => 'text', 'label' => '备案号链接', 'default_value' => 'http://beian.miit.gov.cn/'],

            [['key' => 'f_tab_seo', 'label' => 'SEO Meta', 'type' => 'tab']],
            ['key' => 'f_meta_kw_zh', 'name' => 'meta_keywords_zh', 'type' => 'text', 'label' => 'Keywords (中)'],
            ['key' => 'f_meta_kw_jp', 'name' => 'meta_keywords_jp', 'type' => 'text', 'label' => 'Keywords (日)'],
            ['key' => 'f_meta_desc_zh', 'name' => 'meta_desc_zh', 'type' => 'textarea', 'label' => 'Description (中)', 'rows' => 2],
            ['key' => 'f_meta_desc_jp', 'name' => 'meta_desc_jp', 'type' => 'textarea', 'label' => 'Description (日)', 'rows' => 2]
        ),
    ]);
});
