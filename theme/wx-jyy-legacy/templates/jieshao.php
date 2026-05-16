<?php
/* Template Name: 关于谛佳扬 */
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<div id="contents1" class="about-page">

    <!-- Intro -->
    <section class="about-intro">
        <div class="inner">
            <div class="eyebrow"><?= $jp ? '会社案内' : 'ABOUT US' ?></div>
            <h2><?= $jp ? '日本の技術で、中国製造を変える。' : '以日本技术，重塑中国精密制造。' ?></h2>
            <p class="lead"><?= $jp
                ? '当社は中国で数少ない樹脂切削加工のスペシャリスト。半導体、医療、自動車部品の精密加工に特化し、高い品質と納期を追求します。'
                : '无锡谛佳扬科技有限公司是国内少有的以专业工程塑料切削加工为主的企业，与日本知名企业技术合作，专注半导体、医疗、电子等高精度部品的切削加工。' ?></p>
        </div>
    </section>

    <!-- Photo + intro -->
    <section class="about-block">
        <div class="inner two-col">
            <figure><img src="<?= $t ?>/image/jieshao/guanyu1.jpg" alt=""></figure>
            <div>
                <h3><?= $jp ? '会社について' : '关于我们' ?></h3>
                <?php if ($jp): ?>
                    <p>当社は日本の生産技術と中国のコストを融合し、自動車、電子、医療設備、通信設備向けの樹脂部品の切削加工、及び半導体・液晶などの製造装置向けの薬液・純水用樹脂エアーオペレイトバルブの設計加工を行っております。</p>
                    <p>原装輸入の数値制御機器と検測設備により、日本と同等の恒温加工環境で品質を保証。試作品から大量生産・納期まで、お客様のご要望にお応えします。</p>
                    <p>主な使用素材：POM、PP、PVC、UPE、PC、PTFE、PEEK、PPS、MCナイロン等（国内・輸入材料完備）。<br>＊銅・アルミ等の非鉄金属加工も承ります。</p>
                <?php else: ?>
                    <p>本公司与日本知名企业技术合作，生产汽车、电子电器设备、医疗设备、通信设备等工程塑料部品的切削加工，及半导体、液晶等制造装置的药液、纯水供给用树脂空气压阀门的设计加工。</p>
                    <p>引进原装进口数控设备和检测设备，在与日本同等的加工恒温环境下，保证产品质量，从单件试样到批量生产及纳期上都能满足客户要求。</p>
                    <p>主要使用素材：POM、PP、PVC、UPE、PC、PTFE、PEEK、PPS、MC 尼龙等（国内和进口材料齐全）。<br>＊按客户要求，也承接铜材和铝材为主的配件产品。</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Features grid -->
    <section class="about-block alt">
        <div class="inner two-col">
            <div class="feature-card">
                <h3><?= $jp ? '事業領域' : '服务领域' ?></h3>
                <ul>
                <?php
                $items_zh = ['半导体装置用工程塑料零件加工','电子电器工程塑料零件加工','医疗设备器材用工程塑料零件加工','通信设备器材用工程零件加工','其他种类试制品加工'];
                $items_jp = ['半導体装置用樹脂部品の切削加工','電子・電器用樹脂部品加工','医療機器用樹脂部品加工','通信設備用樹脂部品加工','各種試作品加工'];
                foreach (($jp ? $items_jp : $items_zh) as $i) echo "<li>".esc_html($i)."</li>";
                ?>
                </ul>
            </div>
            <div class="feature-card">
                <h3><?= $jp ? '経営方針' : '企业模式' ?></h3>
                <ul>
                <?php
                $items_zh = ['融合日本的先端技术和管理方式','引进原装进口数控设备和检测设备，保证产品质量','和客户建立良好的信誉，为客户提供优质的产品'];
                $items_jp = ['日本の先端技術と管理方式の融合','原装輸入の数値制御機器・検測設備で品質保証','お客様との信頼関係を築き、優れた製品を提供'];
                foreach (($jp ? $items_jp : $items_zh) as $i) echo "<li>".esc_html($i)."</li>";
                ?>
                </ul>
            </div>
        </div>
    </section>

    <!-- Partner -->
    <section class="about-block">
        <div class="inner two-col reverse">
            <figure><img src="<?= $t ?>/image/jieshao/qiye.jpg" alt=""></figure>
            <div>
                <h3><?= $jp ? '提携企業' : '合作企业' ?></h3>
                <?php if ($jp): ?>
                    <p>日本の樹脂加工専門企業 <a href="http://www.kushida-industry.co.jp" target="_blank" rel="noopener">櫛田工業株式会社</a> と長期技術提携。半導体・液晶向け特殊樹脂エアバルブの共同開発を行っております。</p>
                <?php else: ?>
                    <p>谛佳扬与日本 <a href="http://www.kushida-industry.co.jp" target="_blank" rel="noopener">櫛田工業（株）工程塑料专业公司</a> 长期技术合作，共同开发半导体、液晶等制造装置用特殊树脂空气压阀门。</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
