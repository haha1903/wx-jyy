<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="keywords" content="无锡佳与阳精密机械有限公司：无锡佳与阳,佳与阳,融合日本先进生产技术,切削加工工程塑料制品,工程塑料,切削加工,半导体,液晶,部品,精加工,数码机床">
<meta name="description" content="无锡佳与阳精密机械有限公司：无锡佳与阳,佳与阳,融合日本先进生产技术,切削加工工程塑料制品,工程塑料,切削加工,半导体,液晶,部品,精加工,数码机床">
<?php
// Each template sets $wx_page_css to its own CSS file before calling get_header().
global $wx_page_css;
if (!empty($wx_page_css)) {
    echo '<link rel="stylesheet" type="text/css" href="' . wx_asset($wx_page_css) . '">' . "\n";
}
wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div class="contentBody">
<a name="top"></a>
<div id="header">
    <h1><a href="<?php echo esc_url(home_url('/')); ?>"></a></h1>
    <ul>
        <!-- 日语版预留：以后启用 Polylang 时再接通 -->
    </ul>
</div>
<div id="navi">
    <ul>
        <?php
        $items = [
            ['home',    '首页',     '/'],
            ['desc',    '关于佳与阳','/jieshao/'],
            ['product', '产品',     '/chanpin/'],
            ['machine', '设备',     '/shebei/'],
            ['relation last','联系我们','/lianxi/'],
        ];
        $current = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($items as [$cls, $label, $url]) {
            $u = trim($url, '/');
            $is_active = ($u === '' && $current === '') || ($u !== '' && str_starts_with($current, $u));
            echo '<li class="' . esc_attr($cls) . '"><a href="' . esc_url(home_url($url)) . '">' . esc_html($label) . '</a></li>';
        }
        ?>
    </ul>
</div>
<p class="topLink s12a"><a href="#top">回到页首</a></p>
