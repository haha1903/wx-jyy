<?php
/* Template Name: 关于谛佳扬 */
get_header();
$jp = wx_is_jp();
$page_id = get_the_ID() ?: get_page_by_path('jieshao')->ID ?? 0;
?>

<div id="contents1" class="about-page">

    <!-- Intro -->
    <section class="about-intro">
        <div class="inner">
            <?php if ($e = wx_field('about_eyebrow', $page_id)): ?><div class="eyebrow"><?= esc_html($e) ?></div><?php endif; ?>
            <h2><?= esc_html(wx_field('about_title', $page_id)) ?></h2>
            <?php if ($l = wx_field('about_lead', $page_id)): ?><p class="lead"><?= wp_kses_post($l) ?></p><?php endif; ?>
        </div>
    </section>

    <!-- Intro block -->
    <?php if (wx_field('about_intro_title', $page_id) || wx_img_url(get_field('about_intro_image', $page_id))): ?>
    <section class="about-block">
        <div class="inner two-col">
            <?php if ($i = wx_img_url(get_field('about_intro_image', $page_id))): ?>
                <figure><img src="<?= esc_url($i) ?>" alt=""></figure>
            <?php endif; ?>
            <div>
                <?php if ($t = wx_field('about_intro_title', $page_id)): ?><h3><?= esc_html($t) ?></h3><?php endif; ?>
                <?= wp_kses_post(wx_field('about_intro_body', $page_id)) ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Features -->
    <?php
    $f1_items = (array) get_field('feature1_items', $page_id);
    $f2_items = (array) get_field('feature2_items', $page_id);
    if (wx_field('feature1_title', $page_id) || wx_field('feature2_title', $page_id) || $f1_items || $f2_items): ?>
    <section class="about-block alt">
        <div class="inner two-col">
            <div class="feature-card">
                <h3><?= esc_html(wx_field('feature1_title', $page_id)) ?></h3>
                <ul>
                <?php foreach ($f1_items as $row):
                    $t = $jp ? ($row['text_jp'] ?? '') : ($row['text_zh'] ?? '');
                    if (!$t && $jp) $t = $row['text_zh'] ?? '';
                ?>
                    <li><?= esc_html($t) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="feature-card">
                <h3><?= esc_html(wx_field('feature2_title', $page_id)) ?></h3>
                <ul>
                <?php foreach ($f2_items as $row):
                    $t = $jp ? ($row['text_jp'] ?? '') : ($row['text_zh'] ?? '');
                    if (!$t && $jp) $t = $row['text_zh'] ?? '';
                ?>
                    <li><?= esc_html($t) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Partner -->
    <?php if (wx_field('partner_title', $page_id) || wx_img_url(get_field('partner_image', $page_id))): ?>
    <section class="about-block">
        <div class="inner two-col reverse">
            <?php if ($i = wx_img_url(get_field('partner_image', $page_id))): ?>
                <figure><img src="<?= esc_url($i) ?>" alt=""></figure>
            <?php endif; ?>
            <div>
                <?php if ($t = wx_field('partner_title', $page_id)): ?><h3><?= esc_html($t) ?></h3><?php endif; ?>
                <?= wp_kses_post(wx_field('partner_body', $page_id)) ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php get_footer(); ?>
