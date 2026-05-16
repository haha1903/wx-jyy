<?php
/* Template Name: 关于佳与阳 */
$wx_page_css = '/css/jieshao/index.css';
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<ul id="pan">
    <?php if ($jp): ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
        <li>&nbsp;&gt;&nbsp;会社概要</li>
    <?php else: ?>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
        <li>&nbsp;&gt;&nbsp;公司介绍</li>
    <?php endif; ?>
</ul>

<div id="contents1">
<?php if ($jp): ?>
    <h2>会社案内</h2>
    <div id="main">
        <h3>会社概要</h3>
        <div id="right">
            <h4></h4>
            <table align="center">
                <tr><th class="s14a">会&nbsp;社&nbsp;名</th><td class="s14a">無錫佳&amp;陽精密機械有限会社</td></tr>
                <tr><th class="s14a">代表取締役</th><td class="s14a">孟 偉斌 （モウ イビン）</td></tr>
                <tr><th class="s14a">設&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;立</th><td class="s14a">2011年3月9日</td></tr>
                <tr><th class="s14a">資&nbsp;本&nbsp;金</th><td class="s14a">3200万円</td></tr>
                <tr><th class="s14a">事業内容</th><td class="s14a">マシンニング加工品、ＣＮＣ旋盤加工品（樹脂及び金属）、工作機械部品、半導体部品設計製作</td></tr>
                <tr><th class="s14a">E-mail</th><td class="s14a">mengweibin@wx-jyy.com</td></tr>
                <tr>
                    <th class="s14a">所&nbsp;在&nbsp;地</th>
                    <td class="s14a">
                        <strong>中国本社</strong><br>〒214131<br>
                        中国江蘇省無錫市新区城南路208号B-1<br>
                        TEL:86-510-85606316/FAX:86-510-85626316<br><br>
                        <strong>佳陽貿易</strong><br>〒453-0863<br>
                        愛知県名古屋市中村区八社2－164<br>
                        TEL/FAX:052-413-5519<br>携帯：090-1272-8880<br><br>
                    </td>
                </tr>
                <tr>
                    <th class="s14a">関連会社</th>
                    <td class="s14a">
                        <strong>櫛田工業株式会社</strong><br>〒490-1107<br>
                        愛知県海部郡甚目寺町森1番地の12<br><br>
                        <strong>中堅商事株式会社</strong><br>〒490-1444<br>
                        愛知県海部郡飛島村木場2－129
                    </td>
                </tr>
            </table>
            <div>&nbsp;</div>
        </div>

        <div class="left">
            <h3>佳&amp;陽について</h3>
            <div class="box">
                <p class="s13a">当社は中国で数少ない合成樹脂の切削加工は中心に、高い技術力を持ち、自動車関係、電子、OA機械、医療設備の樹脂部品の切削加工、半導体、液晶製造ラインにおける冶具設計製作、及びそのほか精密製品製造ラインにおける冶具の設計製造をしています。<br><br></p>
            </div>
            <h3>企業理念</h3>
            <div class="box">
                <div class="left">
                    <p class="s13a">私共は制品の品質を守り、誠心誠意取り組み、常に先端のユーザーニーズに応えることを経営理念としております。お客様とより良い信頼関係を結び、先端技術を用い、きっと皆様のご要望にお応えできるものと考えております。<br><br></p>
                </div>
                <br>
                <img alt="" src="<?= $t ?>/image/jieshao/gongsimen.jpg">
                <img alt="" src="<?= $t ?>/image/jieshao/shebei4.jpg">
            </div>
        </div>
    </div>
<?php else: ?>
    <h2>会社案内</h2>
    <div id="main">
        <h3>关于佳与阳</h3>
        <div class="box">
            <p class="s13a">无锡佳与阳精密机械有限公司是国内少有的以专业工程塑料切削加工为主的企业。本公司与日本知名企业技术合作，生产汽车、电子电器设备、医疗设备、通信设备等工程塑料部品的切削加工，及半导体、液晶等制造装置的药液、纯水供给用树脂空气压阀门的设计加工。<br><br></p>
            <p class="s13a">本公司融合日本的先端技术和管理方式，引进原装进口数控设备和检测设备，在与日本同等的加工恒温环境下，保证产品质量，从单件试样到批量生产及纳期上都能满足客户要求。<br><br></p>
            <p class="s13a">本公司主要使用素材有POM聚甲醛；PP聚丙烯；PVC聚氯乙烯；UPE超高分子聚乙烯；PC聚碳酸酯；PTFE聚四氟乙烯；PEEK聚醚醚酮；PPS聚苯硫醚，MC尼龙等(国内和进口材料齐全)。<br><br></p>
            <p class="s13a">*按客户要求，也承接铜材和铝材为主的配件产品。</p>
            <br>
        </div>

        <div class="jieshao">
            <div class="jieshaoLeft"><img alt="" src="<?= $t ?>/image/jieshao/guanyu1.jpg"></div>
            <div class="jieshaoRight">
                <div class="homeTitle">服务领域</div>
                <ul>
                    <li class="s12a">半导体装置用工程塑料零件加工</li>
                    <li class="s12a">电子电器工程塑料零件加工</li>
                    <li class="s12a">医疗设备器材用工程塑料零件加工</li>
                    <li class="s12a">通信设备器材用工程零件加工</li>
                    <li class="s12a">其他种类试制品加工</li>
                </ul>
            </div>
        </div>

        <br>

        <div class="jieshao">
            <div class="jieshaoLeft"><img alt="" src="<?= $t ?>/image/jieshao/guanli1.jpg"></div>
            <div class="jieshaoRight">
                <div class="homeTitle">企业模式</div>
                <ul>
                    <li class="s12a">融合日本的先端技术和管理方式</li>
                    <li class="s12a">引进原装进口数控设备和检测设备，保证产品质量</li>
                    <li class="s12a">和客户建立良好的信誉，为客户提供优质的产品</li>
                </ul>
            </div>
        </div>

        <h3>合作企业</h3>
        <div class="box">
            <div class="left">
                <p class="s13a padding">佳与阳与日本<a href="http://www.kushida-industry.co.jp" target="_blank" rel="noopener">櫛田工業(株)工程塑料专业公司</a>技术合作。</p>
            </div>
            <p class="right"><img alt="" src="<?= $t ?>/image/jieshao/qiye.jpg"></p>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
