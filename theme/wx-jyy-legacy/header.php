<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php if (wx_is_jp()): ?>
<meta name="keywords" content="無錫佳&陽精密機械有限会社：無錫佳&陽、佳&陽、マシンニング加工品、ＣＮＣ旋盤加工品、樹脂製品、金属加工、工作機械部品、半導体部品、バルブ、精密加工、プラスチック製品加工、テフロン加工">
<meta name="description" content="無錫佳&陽精密機械有限会社：無錫佳&陽、佳&陽、マシンニング加工品、ＣＮＣ旋盤加工品、樹脂製品、金属加工、工作機械部品、半導体部品、バルブ、精密加工、プラスチック製品加工、テフロン加工">
<?php else: ?>
<meta name="keywords" content="无锡佳与阳精密机械有限公司：无锡佳与阳,佳与阳,融合日本先进生产技术,切削加工工程塑料制品,工程塑料,切削加工,半导体,液晶,部品,精加工,数码机床">
<meta name="description" content="无锡佳与阳精密机械有限公司：无锡佳与阳,佳与阳,融合日本先进生产技术,切削加工工程塑料制品,工程塑料,切削加工,半导体,液晶,部品,精加工,数码机床">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="contentBody">
<a name="top"></a>
<div id="header">
    <h1<?php if (wx_is_jp()) echo ' class="jp"'; ?>><a href="<?php echo esc_url(home_url('/')); ?>"></a></h1>
    <ul>
        <li><a href="<?php echo wx_switch_url(); ?>"><?php echo wx_is_jp() ? '中文版' : '日本語'; ?></a></li>
    </ul>
</div>
<div id="navi">
    <ul>
        <?php
        $items = wx_is_jp() ? [
            ['home',         'ホーム',          '/'],
            ['desc',         '会社概要',        '/jieshao/'],
            ['product',      '機械加工',        '/chanpin/'],
            ['machine',      '使用設備',        '/shebei/'],
            ['relation last','お問い合わせ',    '/lianxi/'],
        ] : [
            ['home',         '首页',            '/'],
            ['desc',         '关于佳与阳',      '/jieshao/'],
            ['product',      '产品',            '/chanpin/'],
            ['machine',      '设备',            '/shebei/'],
            ['relation last','联系我们',        '/lianxi/'],
        ];
        foreach ($items as [$cls, $label, $url]) {
            echo '<li class="' . esc_attr($cls) . '"><a href="' . esc_url(home_url($url)) . '">' . esc_html($label) . '</a></li>';
        }
        ?>
    </ul>
</div>
<p class="topLink s12a"><a href="#top"><?php echo wx_is_jp() ? '↑ページ先頭へ' : '回到页首'; ?></a></p>
