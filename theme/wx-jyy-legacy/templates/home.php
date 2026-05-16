<?php
/* Template Name: 首页 */
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<div id="contents1">

    <!-- Hero: dark photo background, big white title (HP style) -->
    <section class="hp-hero">
        <img src="<?= $t ?>/image/shebei/chejian.jpg" alt="">
        <div class="copy">
            <div class="eyebrow"><?= $jp ? '精密機械加工' : 'PRECISION MACHINING' ?></div>
            <h2><?= $jp ? '日本の技術。中国の力。' : '日本技术，中国制造。' ?></h2>
            <p><?= $jp
                ? '当社は中国で数少ない樹脂切削加工のスペシャリスト。半導体、医療、電子分野の高精度部品を提供します。'
                : '与日本知名企业技术合作，专业从事工程塑料及金属精密切削加工，服务半导体、医疗、电子等高精度领域。' ?></p>
            <div class="actions">
                <a class="btn-cta" href="<?= esc_url(home_url('/chanpin/')) ?>"><?= $jp ? '製品を見る' : '查看产品' ?></a>
                <a class="btn-ghost" href="<?= esc_url(home_url('/lianxi/')) ?>"><?= $jp ? 'お問い合わせ' : '联系我们' ?></a>
            </div>
        </div>
    </section>

    <!-- Three category cards -->
    <section class="section">
        <h3><?= $jp ? '事業領域' : '业务领域' ?></h3>
        <div class="cat-grid">
            <a class="cat-card" href="<?= esc_url(home_url('/jieshao/')) ?>">
                <div class="ph"><img src="<?= $t ?>/image/jieshao/guanyu1.jpg" alt=""></div>
                <div class="body">
                    <h4><?= $jp ? '会社概要' : '关于佳与阳' ?></h4>
                    <p><?= $jp ? '日本企業と技術提携、樹脂切削加工をリードする企業。' : '与日本知名企业技术合作，专业工程塑料切削加工。' ?></p>
                    <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                </div>
            </a>
            <a class="cat-card" href="<?= esc_url(home_url('/chanpin/')) ?>">
                <div class="ph"><img src="<?= $t ?>/image/chanpin/chanpin_zonghe1.jpg" alt=""></div>
                <div class="body">
                    <h4><?= $jp ? '機械加工製品' : '产品展示' ?></h4>
                    <p><?= $jp ? '医療・半導体・検査・電子など各分野の精密部品。' : '医疗、半导体、检测设备等多领域精密部品。' ?></p>
                    <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                </div>
            </a>
            <a class="cat-card" href="<?= esc_url(home_url('/shebei/')) ?>">
                <div class="ph"><img src="<?= $t ?>/image/shebei/shebei1.jpg" alt=""></div>
                <div class="body">
                    <h4><?= $jp ? '使用設備' : '主要设备' ?></h4>
                    <p><?= $jp ? 'ハース、MAZAK、MITUTOYO 等の原装輸入機器。' : '哈斯、MAZAK、MITUTOYO 等原装进口设备。' ?></p>
                    <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                </div>
            </a>
        </div>
    </section>

    <!-- Belief / brand statement (HP style: dark half + photo half) -->
    <section class="belief">
        <div class="copy">
            <h3><?= $jp ? '品質第一、誠心誠意' : '品质第一，诚心诚意' ?></h3>
            <p><?= $jp
                ? '日本の先端技術と管理方式を融合し、原装輸入の数値制御機器と検測設備により、日本と同等の恒温加工環境で品質を保証。'
                : '融合日本先端技术与管理方式，引进原装进口数控设备和检测设备，在与日本同等的恒温加工环境下，保证产品质量。' ?></p>
            <p style="opacity:.85"><?= $jp ? '試作品から大量生産まで、品質と納期を厳しく守ります。' : '从单件试样到批量生产，严守品质与交期。' ?></p>
            <a class="btn-cta" style="background:var(--hp-blue);border-color:var(--hp-blue);color:#fff" href="<?= esc_url(home_url('/jieshao/')) ?>"><?= $jp ? '会社案内' : '了解我们' ?></a>
        </div>
        <div class="photo"><img src="<?= $t ?>/image/shebei/shebei5.jpg" alt=""></div>
    </section>

    <!-- Certifications -->
    <section class="section compact">
        <h3><?= $jp ? '品質認証 ISO 9001' : '公司资质 ISO 9001' ?></h3>
        <div class="certs">
            <img src="<?= $t ?>/image/home/zizhi_e.jpg" alt="ISO 9001 EN">
            <img src="<?= $t ?>/image/home/zizhi_c.jpg" alt="ISO 9001 CN">
        </div>
    </section>

    <!-- News -->
    <section class="section compact">
        <h3><?= $jp ? 'お知らせ' : '公司新闻' ?></h3>
        <div class="news-grid">
        <?php if ($jp):
            $news = [
                ['2011 / 10','日本櫛田工業株式会社と来年向け半導体、液晶等の製造装置向けに薬液、純水用のエアーオペレイトバルブ制作の共同開発を合意。'],
                ['2011 / 09','関連会社櫛田工業株式会社と日中ものづくり商談会＠上海2011を参加し、特殊樹脂バルブを出展。'],
                ['2011 / 07','日本大和リテック株式会社榊原社長一行がご来社、ご指導をいただきました。'],
                ['2011 / 03','当社を成立。日本櫛田工業株式会社及び三菱重工空調系統（上海）有限会社などの関係者様ご来社。'],
            ];
        else:
            $news = [
                ['2011 / 10','佳与阳与日本栉田工业（株）就来年针对半导体、液晶等制造装置用特殊树脂空气压阀门的开发研制达成共识。'],
                ['2011 / 09','佳与阳携手日本栉田工业（株）精彩亮相"中日制造采购洽谈会 — 上海 2011 展会"，工程塑料切削加工产品获得极大关注。'],
                ['2011 / 07','日本大和リテック（株）榊原社長考察佳与阳。双方就工程塑料切削加工工业前景与公司合作进行深入交流。'],
                ['2011 / 03','佳与阳成立。日本栉田工业（株）及三菱重工空调系统（上海）有限公司等领导光临道贺。'],
            ];
        endif;
        foreach ($news as [$date,$txt]): ?>
            <article class="news-item">
                <div class="date"><?= esc_html($date) ?></div>
                <p class="txt"><?= esc_html($txt) ?></p>
            </article>
        <?php endforeach; ?>
        </div>
    </section>

    <!-- Contact bar -->
    <section class="contact-bar">
        <div>
            <h4><?= $jp ? '中国本社' : '中国区' ?></h4>
            <div class="row"><b>地址</b><?= $jp ? '中国江蘇省無錫市新区城南路208号B-1' : '无锡市新区城南路208号B-1' ?></div>
            <div class="row"><b>TEL</b>86-510-85606316</div>
            <div class="row"><b>FAX</b>86-510-85626316</div>
            <div class="row"><b>MOBILE</b>86-13771153090</div>
        </div>
        <div>
            <h4><?= $jp ? '佳陽貿易' : '日本区' ?></h4>
            <div class="row"><b><?= $jp ? '住所' : '地址' ?></b><?= $jp ? '愛知県名古屋市中村区八社2-164' : '愛知県名古屋市中村区八社2-164' ?></div>
            <?php if ($jp): ?>
                <div class="row"><b>TEL/FAX</b>052-413-5519</div>
                <div class="row"><b>携帯</b>090-1272-8880</div>
            <?php else: ?>
                <div class="row"><b>MOBILE</b>0081-90-1272-8880</div>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>
