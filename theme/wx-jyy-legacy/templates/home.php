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

    <!-- Certifications -->
    <?php $certs = get_field('certs', $page_id); if ($certs): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('certs_title', $page_id)) ?></h3>
        <div class="certs">
            <?php foreach ((array) $certs as $c):
                $url = is_array($c) ? ($c['url'] ?? '') : (is_numeric($c) ? wp_get_attachment_url((int)$c) : (string)$c);
                if (!$url) continue;
            ?>
                <img src="<?= esc_url($url) ?>" alt="">
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Business categories -->
    <?php $cats = (array) get_field('cats', $page_id); if ($cats): ?>
    <section class="section">
        <h3><?= esc_html(wx_field('cats_title', $page_id)) ?></h3>
        <div class="cat-grid">
            <?php foreach ($cats as $row):
                $url = wx_img_url($row['image'] ?? '');
                $title = $jp ? ($row['title_jp'] ?? '') : ($row['title_zh'] ?? '');
                $desc  = $jp ? ($row['desc_jp']  ?? '') : ($row['desc_zh']  ?? '');
                if (!$title && $jp) $title = $row['title_zh'] ?? '';
                if (!$desc && $jp)  $desc  = $row['desc_zh']  ?? '';
            ?>
                <a class="cat-card" href="<?= esc_url(home_url($row['url'] ?? '/')) ?>">
                    <?php if ($url): ?>
                        <div class="ph"><img src="<?= esc_url($url) ?>" alt=""></div>
                    <?php endif; ?>
                    <div class="body">
                        <h4><?= esc_html($title) ?></h4>
                        <p><?= wp_kses_post($desc) ?></p>
                        <span class="more"><?= $jp ? '詳しく →' : '了解更多 →' ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
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

    <!-- Factory showcase -->
    <?php $factory = (array) get_field('factory', $page_id); if ($factory): ?>
    <section class="section compact">
        <h3><?= esc_html(wx_field('factory_title', $page_id)) ?></h3>
        <div class="factory-grid">
            <?php foreach ($factory as $row):
                $url = wx_img_url($row['image'] ?? '');
                $cap = $jp ? ($row['caption_jp'] ?? '') : ($row['caption_zh'] ?? '');
                if (!$cap && $jp) $cap = $row['caption_zh'] ?? '';
            ?>
                <figure>
                    <?php if ($url): ?><img src="<?= esc_url($url) ?>" alt=""><?php endif; ?>
                    <?php if ($cap): ?><figcaption><?= esc_html($cap) ?></figcaption><?php endif; ?>
                </figure>
            <?php endforeach; ?>
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
