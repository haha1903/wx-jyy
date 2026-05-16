<?php
/* Template Name: 首页 */
$wx_page_css = '/css/home/index.css';
get_header();
$t = get_template_directory_uri();
?>

<ul id="pan"><li></li></ul>

<div id="contents1">
    <div class="infos">
        <div class="icons"></div>
        <div class="infoBox">
            <div class="info"><img src="<?= $t ?>/image/home/index_img_jieshao.jpg"/></div>
            <div class="info"><img src="<?= $t ?>/image/home/index_img_chanpin.jpg"/></div>
            <div class="info"><img src="<?= $t ?>/image/home/index_img_linian.jpg"/></div>
        </div>
    </div>

    <br>

    <div class="boxLeft boxFull">
        <div class="homeTitle">公司资质</div>
        <img alt="" src="<?= $t ?>/image/home/zizhi_e.jpg">
        <img alt="" src="<?= $t ?>/image/home/zizhi_c.jpg">
    </div>

    <br>

    <div class="boxLeft">
        <div class="homeTitle">公司新闻</div>
        <ul>
            <li class="s12a"><img src="<?= $t ?>/image/home/a2.gif" alt="new">2011年10月，佳与阳与日本栉田工业（株）就来年针对半导体，液晶等制造装置用特殊树脂空气压阀门的开发研制达成共识。</li>
            <li class="s12a"><img src="<?= $t ?>/image/home/a2.gif" alt="new">2011年9月6日至7日，佳与阳携手合作伙伴日本栉田工业（株）精彩亮相&ldquo;中日制造采购洽谈会－－上海2011展会&rdquo;。在展会上，佳与阳的工程塑料切削加工产品——药液、纯水供给用树脂空气压阀门——得到了极大的关注。</li>
            <li class="s12a"><img src="<?= $t ?>/image/home/a2.gif" alt="new">2011年7月30日，日本大和リテック（株）榊原社長考察佳与阳。佳与阳总经理孟伟斌陪同考察，双方还就工程塑料的切削加工工业前景、高精密机械加工、公司合作等等事项进行了深入的交流。</li>
            <li class="s12a"><img src="<?= $t ?>/image/home/a2.gif" alt="new">2011年3月，佳与阳成立。日本栉田工业（株）及三菱重工空调系统（上海）有限公司等领导光临道贺。支持公司成立！</li>
        </ul>
    </div>

    <div class="boxRight">
        <table class="btn" height="180">
            <tr><td height="35">&nbsp;</td></tr>
            <tr><td colspan="2">中国区</td></tr>
            <tr><td>TEL</td><td>86-510-85606316</td></tr>
            <tr><td>FAX</td><td>86-510-85626316</td></tr>
            <tr><td>MOBILE</td><td>86-13771153090</td></tr>
            <tr><td colspan="2">日本区</td></tr>
            <tr><td>MOBILE</td><td>0081-90-1272-8880</td></tr>
        </table>
    </div>

<?php get_footer(); ?>
