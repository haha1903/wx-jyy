<?php
/* Template Name: 产品 */
$wx_page_css = '/css/chanpin/index.css';
get_header();
$t = get_template_directory_uri();
?>

<ul id="pan">
    <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
    <li>&nbsp;&gt;&nbsp;产品介绍</li>
</ul>

<div id="contents1">
    <h2>クシダ工業の機械加工</h2>

    <h3>医疗类产品</h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_yiliao1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_yiliao2.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_yiliao3.jpg" /></div>
        </li>
    </ul>

    <h3>检测设备类产品</h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jiance1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jiance2.jpg" /></div>
        </li>
    </ul>

    <h3>半导体类产品</h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_bandaoti1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_bandaoti2.jpg" /></div>
        </li>
    </ul>

    <h3>综合类产品</h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe2.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe3.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe4.jpg" /></div>
        </li>
        <li>&nbsp;</li>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe5.jpg" /></div>
        </li>
    </ul>

<?php get_footer(); ?>
