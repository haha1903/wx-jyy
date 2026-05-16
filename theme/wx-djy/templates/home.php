<?php
/* Template Name: 首页 */
get_header();
$jp = wx_is_jp();

// The home page is rendered via front-page.php which does not set the loop;
// resolve its ID explicitly so ACF fields/repeaters bind to it.
$page_id = wx_options_pid();

// helpers
$cta1_url = get_field('hero_cta1_url', $page_id) ?: '/chanpin/';
$cta2_url = get_field('hero_cta2_url', $page_id) ?: '/lianxi/';
$belief_cta_url = get_field('belief_cta_url', $page_id) ?: '/jieshao/';
?>

<div id="contents1">

    <!-- Hero -->
    <section class="hp-hero">
        <?php if ($url = wx_img_url(get_field('hero_image', $page_id))): ?>
            <img src="<?= esc_url($url) ?>" alt="">
        <?php endif; ?>
        <div class="copy">
            <?php if ($eb = wx_field('hero_eyebrow', $page_id)): ?><div class="eyebrow"><?= esc_html($eb) ?></div><?php endif; ?>
            <h2><?= esc_html(wx_field('hero_title', $page_id)) ?></h2>
            <p><?= wp_kses_post(wx_field('hero_subtitle', $page_id)) ?></p>
            <div class="actions">
                <?php if ($t1 = wx_field('hero_cta1', $page_id)): ?>
                    <a class="btn-cta" href="<?= esc_url(home_url($cta1_url)) ?>"><?= esc_html($t1) ?></a>
                <?php endif; ?>
                <?php if ($t2 = wx_field('hero_cta2', $page_id)): ?>
                    <a class="btn-ghost" href="<?= esc_url(home_url($cta2_url)) ?>"><?= esc_html($t2) ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Certifications (CPT: cert) -->
    <?php $cert_q = new WP_Query(['post_type'=>'cert','posts_per_page'=>-1,'orderby'=>'menu_order date','order'=>'ASC']);
    if ($cert_q->have_posts()): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('certs_title', $page_id)) ?></h3>
        <div class="certs">
            <?php while ($cert_q->have_posts()): $cert_q->the_post();
                $url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                if (!$url) continue;
            ?>
                <img src="<?= esc_url($url) ?>" alt="<?= esc_attr(get_the_title()) ?>">
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Business categories (CPT: biz_card) -->
    <?php $cat_q = new WP_Query(['post_type'=>'biz_card','posts_per_page'=>-1,'orderby'=>'menu_order date','order'=>'ASC']);
    if ($cat_q->have_posts()): ?>
    <section class="section">
        <h3><?= esc_html(wx_field('cats_title', $page_id)) ?></h3>
        <div class="cat-grid">
            <?php while ($cat_q->have_posts()): $cat_q->the_post();
                $img   = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                $title_jp = get_field('title_jp');
                $title = $jp && $title_jp ? $title_jp : get_the_title();
                $desc  = wx_field('biz_desc');
                $href  = get_field('biz_url') ?: '/';
            ?>
                <a class="cat-card" href="<?= esc_url(home_url($href)) ?>">
                    <?php if ($img): ?><div class="ph"><img src="<?= esc_url($img) ?>" alt=""></div><?php endif; ?>
                    <div class="body">
                        <h4><?= esc_html($title) ?></h4>
                        <p><?= wp_kses_post($desc) ?></p>
                        <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                    </div>
                </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Belief / brand statement -->
    <?php if (wx_field('belief_title', $page_id)): ?>
    <section class="belief">
        <div class="copy">
            <h3><?= esc_html(wx_field('belief_title', $page_id)) ?></h3>
            <?php if ($p = wx_field('belief_p1', $page_id)): ?><p><?= wp_kses_post($p) ?></p><?php endif; ?>
            <?php if ($p = wx_field('belief_p2', $page_id)): ?><p style="opacity:.85"><?= wp_kses_post($p) ?></p><?php endif; ?>
            <?php if ($t = wx_field('belief_cta', $page_id)): ?>
                <a class="btn-cta" style="background:var(--hp-blue);border-color:var(--hp-blue);color:#fff" href="<?= esc_url(home_url($belief_cta_url)) ?>"><?= esc_html($t) ?></a>
            <?php endif; ?>
        </div>
        <?php if ($bi = wx_img_url(get_field('belief_image', $page_id))): ?>
            <div class="photo"><img src="<?= esc_url($bi) ?>" alt=""></div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Factory showcase (CPT: factory_photo) -->
    <?php $fp_q = new WP_Query(['post_type'=>'factory_photo','posts_per_page'=>-1,'orderby'=>'menu_order date','order'=>'ASC']);
    if ($fp_q->have_posts()): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('factory_title', $page_id)) ?></h3>
        <div class="factory-grid">
            <?php while ($fp_q->have_posts()): $fp_q->the_post();
                $url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                $cap_jp = get_field('caption_jp');
                $cap = $jp && $cap_jp ? $cap_jp : get_the_title();
            ?>
                <figure>
                    <?php if ($url): ?><img src="<?= esc_url($url) ?>" alt=""><?php endif; ?>
                    <?php if ($cap): ?><figcaption><?= esc_html($cap) ?></figcaption><?php endif; ?>
                </figure>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- News (pulled from CPT) -->
    <?php
    $news_count = (int) (get_field('news_count', $page_id) ?: 4);
    $news_q = new WP_Query([
        'post_type'      => 'news',
        'posts_per_page' => $news_count,
        'orderby'        => 'menu_order date',
        'order'          => 'DESC',
    ]);
    if ($news_q->have_posts()):
    ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('news_title', $page_id)) ?: ($jp ? 'お知らせ' : '公司新闻') ?></h3>
        <div class="news-grid">
            <?php while ($news_q->have_posts()): $news_q->the_post();
                $date_str = get_field('news_date_zh');
                if ($jp && get_field('news_date_jp')) $date_str = get_field('news_date_jp');
                $body = wx_field('news_body');
            ?>
                <article class="news-item">
                    <div class="date"><?= esc_html($date_str) ?></div>
                    <p class="txt"><?= $body ? wp_kses_post($body) : esc_html(get_the_title()) ?></p>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Contact bar (pulled from site options) -->
    <?php
    $cn_label = wx_field('cn_label', wx_options_pid());
    $jp_label = wx_field('jp_label', wx_options_pid());
    ?>
    <section class="contact-bar">
        <div>
            <h4><?= esc_html($cn_label) ?></h4>
            <?php if ($v = wx_field('cn_addr', wx_options_pid())): ?><div class="row"><b><?= $jp ? '住所' : '地址' ?></b><?= esc_html($v) ?></div><?php endif; ?>
            <?php if ($v = get_field('cn_tel', wx_options_pid())): ?><div class="row"><b>TEL</b><?= esc_html($v) ?></div><?php endif; ?>
            <?php if ($v = get_field('cn_fax', wx_options_pid())): ?><div class="row"><b>FAX</b><?= esc_html($v) ?></div><?php endif; ?>
            <?php if ($v = get_field('cn_mobile', wx_options_pid())): ?><div class="row"><b>MOBILE</b><?= esc_html($v) ?></div><?php endif; ?>
        </div>
        <div>
            <h4><?= esc_html($jp_label) ?></h4>
            <?php if ($v = wx_field('jp_addr', wx_options_pid())): ?><div class="row"><b><?= $jp ? '住所' : '地址' ?></b><?= esc_html($v) ?></div><?php endif; ?>
            <?php if ($v = get_field('jp_tel', wx_options_pid())): ?><div class="row"><b>TEL/FAX</b><?= esc_html($v) ?></div><?php endif; ?>
            <?php if ($v = get_field('jp_mobile', wx_options_pid())): ?><div class="row"><b><?= $jp ? '携帯' : 'MOBILE' ?></b><?= esc_html($v) ?></div><?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>
