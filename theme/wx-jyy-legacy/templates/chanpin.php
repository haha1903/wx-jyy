<?php
/* Template Name: 产品 */
$wx_page_css = '/css/chanpin/index.css';
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<ul id="pan">
    <?php if ($jp): ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
        <li>&nbsp;&gt;&nbsp;機械加工</li>
    <?php else: ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
        <li>&nbsp;&gt;&nbsp;产品介绍</li>
    <?php endif; ?>
</ul>

<div id="contents1">
    <h2>クシダ工業の機械加工</h2>

<?php if ($jp): ?>
    <h3>機械加工</h3>
    <h5>高精度な製品作りに挑戦</h5>
    <p class="s13a">当社は日本の生産技術と中国のコストをあわせ、試作品から大量生産において、品質と納期を厳しく守り、皆様のご要望にお応えできるものと考えております。</p>
    <br>
    <h5>取り扱い材料</h5>
    <p class="s13a">主に使用する材料はPOM，PP，PVC，UPE，PC，PTFE，PEEK，PPS，MCナイロンなど。</p>
    <p class="s13a">＊また銅、アルミ非鉄金属の加工も受け承まります。</p>
    <br>
    <h3>製品</h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp3.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp2.jpg" /></div>
        </li>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp4.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp5.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp6.jpg" /></div>
        </li>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp7.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp8.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin_jp9.jpg" /></div>
        </li>
        <li>&nbsp;</li>
    </ul>
<?php else: ?>
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

    <h3><?= $jp ? 'その他の事例' : '更多产品案例' ?></h3>
    <ul>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin1.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin2.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin3.jpg" /></div>
        </li>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin4.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin5.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin6.jpg" /></div>
        </li>
        <li>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin7.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin8.jpg" /></div>
            <div class="desc_jp"><img src="<?= $t ?>/image/chanpin/chanpin9.jpg" /></div>
        </li>
    </ul>
<?php endif; ?>

<?php get_footer(); ?>
