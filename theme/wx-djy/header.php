<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php if (wx_is_jp()): ?>
<meta name="keywords" content="無錫諦佳揚科技有限会社：無錫諦佳揚、諦佳揚、マシンニング加工品、ＣＮＣ旋盤加工品、樹脂製品、金属加工、工作機械部品、半導体部品、バルブ、精密加工、プラスチック製品加工、テフロン加工">
<meta name="description" content="無錫諦佳揚科技有限会社：無錫諦佳揚、諦佳揚、マシンニング加工品、ＣＮＣ旋盤加工品、樹脂製品、金属加工、工作機械部品、半導体部品、バルブ、精密加工、プラスチック製品加工、テフロン加工">
<?php else: ?>
<meta name="keywords" content="无锡谛佳扬科技有限公司，谛佳扬，工程塑料切削加工，精密机械加工，半导体部品，医疗部品，电子部品，POM PEEK PTFE 加工，日本技术合作">
<meta name="description" content="无锡谛佳扬科技有限公司：与日本知名企业技术合作，专业工程塑料切削加工，服务半导体、医疗、电子等高精度领域。">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="contentBody">
<a name="top"></a>
<div id="header">
    <h1<?php if (wx_is_jp()) echo ' class="jp"'; ?>>
        <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(wx_is_jp() ? '無錫諦佳揚科技有限会社' : '无锡谛佳扬科技有限公司'); ?>">
            <img class="brand-logo" src="<?php echo esc_url(get_template_directory_uri() . '/image/logo.svg'); ?>" alt="">
            <span class="brand-name"><?php echo wx_is_jp() ? '無錫諦佳揚科技有限会社' : '无锡谛佳扬科技有限公司'; ?></span>
        </a>
    </h1>
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
            ['desc',         '关于谛佳扬',      '/jieshao/'],
            ['product',      '产品',            '/chanpin/'],
            ['machine',      '设备',            '/shebei/'],
            ['relation last','联系我们',        '/lianxi/'],
        ];
        $req = '/' . trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/') . '/';
        if ($req === '//') $req = '/';
        foreach ($items as [$cls, $label, $url]) {
            $active = ($url === '/' && $req === '/') || ($url !== '/' && strpos($req, $url) === 0);
            $css_cls = trim($cls . ($active ? ' active' : ''));
            echo '<li class="' . esc_attr($css_cls) . '"><a href="' . esc_url(home_url($url)) . '">' . esc_html($label) . '</a></li>';
        }
        ?>
    </ul>
</div>
<p class="topLink s12a"><a href="#top"><?php echo wx_is_jp() ? '↑ページ先頭へ' : '回到页首'; ?></a></p>
