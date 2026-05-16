<?php
/* Template Name: 首页 */
get_header();
$t = get_template_directory_uri();
$jp = wx_is_jp();
?>

<ul id="pan"><li><?= $jp ? 'ホーム' : '首页' ?></li></ul>

<div id="contents1">

    <!-- Hero -->
    <section class="hero">
        <h2><?= $jp ? '精密加工のスペシャリスト' : '专注精密机械切削加工' ?></h2>
        <p><?= $jp
            ? '日本の先端技術と中国コストを融合し、最高品質の樹脂・金属加工をお届けします。'
            : '融合日本先端技术与管理方式，专业从事工程塑料及金属精密切削加工。' ?></p>
        <div class="badges">
            <span><?= $jp ? '日本技術提携' : '日本技术合作' ?></span>
            <span><?= $jp ? '輸入設備' : '进口数控设备' ?></span>
            <span><?= $jp ? '恒温加工環境' : '恒温加工环境' ?></span>
            <span><?= $jp ? '試作〜量産対応' : '试制 / 量产' ?></span>
        </div>
    </section>

    <!-- Three business cards -->
    <div class="bizgrid">
        <a class="bizcard" href="<?= esc_url(home_url('/jieshao/')) ?>">
            <div class="ph"><img src="<?= $t ?>/image/home/<?= $jp ? 'index_img_jieshao_jp.jpg' : 'index_img_jieshao.jpg' ?>"></div>
            <div class="body">
                <h4><?= $jp ? '会社概要' : '关于佳与阳' ?></h4>
                <p><?= $jp ? '日本企業と技術提携、樹脂切削加工をリードする企業。' : '与日本知名企业技术合作，专业工程塑料切削加工。' ?></p>
            </div>
        </a>
        <a class="bizcard" href="<?= esc_url(home_url('/chanpin/')) ?>">
            <div class="ph"><img src="<?= $t ?>/image/home/<?= $jp ? 'index_img_chanpin_jp.jpg' : 'index_img_chanpin.jpg' ?>"></div>
            <div class="body">
                <h4><?= $jp ? '機械加工製品' : '产品展示' ?></h4>
                <p><?= $jp ? '医療・半導体・検査・電子など各分野の精密部品。' : '医疗、半导体、检测设备等多领域精密部品。' ?></p>
            </div>
        </a>
        <a class="bizcard" href="<?= esc_url(home_url('/shebei/')) ?>">
            <div class="ph"><img src="<?= $t ?>/image/home/<?= $jp ? 'index_img_linian_jp.jpg' : 'index_img_linian.jpg' ?>"></div>
            <div class="body">
                <h4><?= $jp ? '使用設備' : '主要设备' ?></h4>
                <p><?= $jp ? 'ハース、MAZAK、MITUTOYO 等の原装輸入機器。' : '哈斯、MAZAK、MITUTOYO 等原装进口设备。' ?></p>
            </div>
        </a>
    </div>

    <!-- Certifications -->
    <h3><?= $jp ? '品質認証' : '公司资质' ?></h3>
    <div class="certs">
        <img src="<?= $t ?>/image/home/zizhi_e.jpg" alt="ISO 9001 EN">
        <img src="<?= $t ?>/image/home/zizhi_c.jpg" alt="ISO 9001 CN">
    </div>

    <!-- News + contact -->
    <div class="homerow">
        <div>
            <h3><?= $jp ? 'お知らせ' : '公司新闻' ?></h3>
            <ul class="newslist">
            <?php if ($jp):
                $news = [
                    ['2011','10','日本櫛田工業株式会社と来年向け半導体、液晶等の製造装置向けに薬液、純水用のエアーオペレイトバルブ制作の共同開発を合意。'],
                    ['2011','09','関連会社櫛田工業株式会社と日中ものづくり商談会＠上海2011を参加し、特殊樹脂バルブを出展。'],
                    ['2011','07','日本大和リテック株式会社榊原社長一行がご来社、ご指導をいただきました。'],
                    ['2011','03','当社を成立。日本櫛田工業株式会社及び三菱重工空調系統（上海）有限会社などの関係者様ご来社。'],
                ];
            else:
                $news = [
                    ['2011','10','佳与阳与日本栉田工业（株）就来年针对半导体、液晶等制造装置用特殊树脂空气压阀门的开发研制达成共识。'],
                    ['2011','09','佳与阳携手日本栉田工业（株）精彩亮相"中日制造采购洽谈会 — 上海 2011 展会"，工程塑料切削加工产品获得极大关注。'],
                    ['2011','07','日本大和リテック（株）榊原社長考察佳与阳。双方就工程塑料切削加工工业前景与公司合作进行深入交流。'],
                    ['2011','03','佳与阳成立。日本栉田工业（株）及三菱重工空调系统（上海）有限公司等领导光临道贺。'],
                ];
            endif;
            foreach ($news as [$y,$m,$txt]): ?>
                <li>
                    <div class="date"><span class="y"><?= $y ?></span><span class="m"><?= $m ?></span></div>
                    <div class="txt"><?= esc_html($txt) ?></div>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <h3><?= $jp ? 'お問い合わせ' : '联系方式' ?></h3>
            <div class="contactcard">
                <h4><?= $jp ? '中国本社' : '中国区' ?></h4>
                <div class="row"><b>TEL</b>86-510-85606316</div>
                <div class="row"><b>FAX</b>86-510-85626316</div>
                <div class="row"><b>MOBILE</b>86-13771153090</div>
                <div class="reg">
                    <h4 style="margin:0 0 10px"><?= $jp ? '佳陽貿易' : '日本区' ?></h4>
                    <?php if ($jp): ?>
                        <div class="row"><b>TEL/FAX</b>052-413-5519</div>
                        <div class="row"><b>携帯</b>090-1272-8880</div>
                    <?php else: ?>
                        <div class="row"><b>MOBILE</b>0081-90-1272-8880</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
