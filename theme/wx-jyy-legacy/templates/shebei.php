<?php
/* Template Name: 设备 */
$wx_page_css = '/css/shebei/index.css';
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<ul id="pan">
    <?php if ($jp): ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
        <li>&nbsp;&gt;&nbsp;主要設備</li>
    <?php else: ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
        <li>&nbsp;&gt;&nbsp;主要设备</li>
    <?php endif; ?>
</ul>

<div id="contents1">
    <h2>クシダ工業の工作機械</h2>

    <h3>主要设备</h3>
    <ul>
        <li>
            <div class="desc"><?= $jp ? 'アメリカ原装輸入 哈斯VF-2' : '美国原装进口 哈斯VF-2' ?><br><img src="<?= $t ?>/image/shebei/shebei1.jpg" alt="设备1"></div>
            <div class="img">LG MAZAK 200-IIL<br><img src="<?= $t ?>/image/shebei/shebei2.jpg" alt="设备2"></div>
        </li>
        <li>
            <div class="desc">MITUTOYO<?= $jp ? '光学内視鏡(関連会社)' : '光学内视镜（合作企业）' ?><br><img src="<?= $t ?>/image/shebei/shebei3.jpg" alt="设备1"></div>
            <div class="img">MITUTOYO<?= $jp ? '三次元測定器(関連会社)' : ' 三次元测定器（合作企业）' ?><br><img src="<?= $t ?>/image/shebei/shebei5.jpg" alt="设备2"></div>
        </li>
    </ul>

<?php if (!$jp): ?>
    <h3>加工中心</h3>
    <ul>
        <li><img src="<?= $t ?>/image/shebei/chejian.jpg" alt="设备1"></li>
        <li>&nbsp;</li>
        <li><img src="<?= $t ?>/image/shebei/chejian2.jpg" alt="设备1"></li>
    </ul>

    <h3>加工工序</h3>
    <ul>
        <li><img src="<?= $t ?>/image/shebei/gongxu.jpg" alt="设备1"></li>
    </ul>
<?php endif; ?>

<?php get_footer(); ?>
