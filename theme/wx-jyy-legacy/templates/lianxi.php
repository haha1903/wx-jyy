<?php
/* Template Name: 联系我们 */
$wx_page_css = '/css/outline/index.css';
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<ul id="pan">
    <?php if ($jp): ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
        <li>&nbsp;&gt;&nbsp;お問い合わせ</li>
    <?php else: ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
        <li>&nbsp;&gt;&nbsp;联系我们</li>
    <?php endif; ?>
</ul>

<div id="contents1">
    <h2>クシダ工業の機械加工</h2>

<?php if ($jp): ?>
    <h3>お問い合わせ</h3>
    <h5>中国本社</h5>
    <p class="s13a">〒214131</p>
    <p class="s13a">中国江蘇省無錫市新区城南路208号B-1</p>
    <p class="s13a">TEL : 86-510-85606316 / FAX : 86-510-85626316</p>
    <p></p><br>
    <p class="s13a">E-mail : mengweibin@wx-jyy.com</p>
    <h5>佳陽貿易</h5>
    <p class="s13a">〒453-0863</p>
    <p class="s13a">愛知県名古屋市中村区八社2－164</p>
    <p class="s13a">TEL / FAX  :052-413-5519</p>
    <p class="s13a">携帯 : 090-1272-8880</p>
<?php else: ?>
    <h3>公司概要</h3>
    <div id="right">
        <h4></h4>
        <table align="center">
            <tr><th class="s14a">公司名称</th><td class="s14a">无锡谛佳扬科技有限公司</td></tr>
            <tr><th class="s14a">总经理</th><td class="s14a">孟伟斌</td></tr>
            <tr><th class="s14a">海外部经理</th><td class="s14a">张婷</td></tr>
            <tr><th class="s14a">设立年月日</th><td class="s14a">2011年3月9日</td></tr>
            <tr><th class="s14a">E-mail</th><td class="s14a"><a href="mailto:mwb2001@hotmail.com">mwb2001@hotmail.com</a></td></tr>
            <tr>
                <th class="s14a">公司所在地</th>
                <td class="s14a">
                    <strong>中国区</strong><br>
                    地址 无锡市新区城南路208号B-1<br>
                    电话 86-510-85606316<br>
                    传真 86-510-85626316<br>
                    手机 86-13771153090<br>
                    邮编 214131<br>
                    <img src="<?= $t ?>/image/lianxi/dizhi1.jpg" alt="地址"><br><br>
                    <strong>日本区</strong><br>
                    〒453-0863<br>
                    愛知県名古屋市中村区八社2－164<br>
                    TEL/FAX&nbsp;&nbsp;&nbsp;052-413-5519<br>
                    MOBILE　0081-90-1272-8880<br><br>
                </td>
            </tr>
        </table>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
