<?php
/* Template Name: 首页 */
get_header();
$jp = wx_is_jp();

// helpers
$cta1_url = get_field('hero_cta1_url') ?: '/chanpin/';
$cta2_url = get_field('hero_cta2_url') ?: '/lianxi/';
$belief_cta_url = get_field('belief_cta_url') ?: '/jieshao/';
?>

<div id="contents1">

    <!-- Hero -->
    <section class="hp-hero">
        <?php if ($img = get_field('hero_image')): ?>
            <img src="<?= esc_url($img) ?>" alt="">
        <?php endif; ?>
        <div class="copy">
            <?php if ($eb = wx_field('hero_eyebrow')): ?><div class="eyebrow"><?= esc_html($eb) ?></div><?php endif; ?>
            <h2><?= esc_html(wx_field('hero_title')) ?></h2>
            <p><?= wp_kses_post(wx_field('hero_subtitle')) ?></p>
            <div class="actions">
                <?php if ($t1 = wx_field('hero_cta1')): ?>
                    <a class="btn-cta" href="<?= esc_url(home_url($cta1_url)) ?>"><?= esc_html($t1) ?></a>
                <?php endif; ?>
                <?php if ($t2 = wx_field('hero_cta2')): ?>
                    <a class="btn-ghost" href="<?= esc_url(home_url($cta2_url)) ?>"><?= esc_html($t2) ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Certifications -->
    <?php $certs = get_field('certs'); if ($certs): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('certs_title')) ?></h3>
        <div class="certs">
            <?php foreach ($certs as $c): ?>
                <img src="<?= esc_url($c['url']) ?>" alt="<?= esc_attr($c['alt'] ?? '') ?>">
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Business categories -->
    <?php if (have_rows('cats')): ?>
    <section class="section">
        <h3><?= esc_html(wx_field('cats_title')) ?></h3>
        <div class="cat-grid">
            <?php while (have_rows('cats')): the_row(); ?>
                <a class="cat-card" href="<?= esc_url(home_url(get_sub_field('url') ?: '/')) ?>">
                    <?php if ($img = get_sub_field('image')): ?>
                        <div class="ph"><img src="<?= esc_url($img) ?>" alt=""></div>
                    <?php endif; ?>
                    <div class="body">
                        <h4><?= esc_html(wx_sub_field('title')) ?></h4>
                        <p><?= wp_kses_post(wx_sub_field('desc')) ?></p>
                        <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Belief / brand statement -->
    <?php if (wx_field('belief_title')): ?>
    <section class="belief">
        <div class="copy">
            <h3><?= esc_html(wx_field('belief_title')) ?></h3>
            <?php if ($p = wx_field('belief_p1')): ?><p><?= wp_kses_post($p) ?></p><?php endif; ?>
            <?php if ($p = wx_field('belief_p2')): ?><p style="opacity:.85"><?= wp_kses_post($p) ?></p><?php endif; ?>
            <?php if ($t = wx_field('belief_cta')): ?>
                <a class="btn-cta" style="background:var(--hp-blue);border-color:var(--hp-blue);color:#fff" href="<?= esc_url(home_url($belief_cta_url)) ?>"><?= esc_html($t) ?></a>
            <?php endif; ?>
        </div>
        <?php if ($bi = get_field('belief_image')): ?>
            <div class="photo"><img src="<?= esc_url($bi) ?>" alt=""></div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Factory showcase -->
    <?php if (have_rows('factory')): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('factory_title')) ?></h3>
        <div class="factory-grid">
            <?php while (have_rows('factory')): the_row(); ?>
                <figure>
                    <?php if ($img = get_sub_field('image')): ?>
                        <img src="<?= esc_url($img) ?>" alt="">
                    <?php endif; ?>
                    <?php if ($cap = wx_sub_field('caption')): ?>
                        <figcaption><?= esc_html($cap) ?></figcaption>
                    <?php endif; ?>
                </figure>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- News (pulled from CPT) -->
    <?php
    $news_count = (int) (get_field('news_count') ?: 4);
    $news_q = new WP_Query([
        'post_type'      => 'news',
        'posts_per_page' => $news_count,
        'orderby'        => 'menu_order date',
        'order'          => 'DESC',
    ]);
    if ($news_q->have_posts()):
    ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('news_title')) ?: ($jp ? 'お知らせ' : '公司新闻') ?></h3>
        <div class="news-grid">
            <?php while ($news_q->have_posts()): $news_q->the_post();
                $date_str = get_field('news_date_zh'); // not bilingual — show as-is
                if ($jp && get_field('news_date_jp')) $date_str = get_field('news_date_jp');
                $body = wx_field('news_body');
                $title_jp = get_field('news_title_jp');
                $display_title = $jp && $title_jp ? $title_jp : get_the_title();
            ?>
                <article class="news-item">
                    <div class="date"><?= esc_html($date_str) ?></div>
                    <p class="txt"><?= $body ? wp_kses_post($body) : esc_html($display_title) ?></p>
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
