<?php
/* Template Name: 关于谛佳扬 */
get_header();
$jp = wx_is_jp();
?>

<div id="contents1" class="about-page">

    <!-- Intro -->
    <section class="about-intro">
        <div class="inner">
            <?php if ($e = wx_field('about_eyebrow')): ?><div class="eyebrow"><?= esc_html($e) ?></div><?php endif; ?>
            <h2><?= esc_html(wx_field('about_title')) ?></h2>
            <?php if ($l = wx_field('about_lead')): ?><p class="lead"><?= wp_kses_post($l) ?></p><?php endif; ?>
        </div>
    </section>

    <!-- Intro block -->
    <?php if (wx_field('about_intro_title') || get_field('about_intro_image')): ?>
    <section class="about-block">
        <div class="inner two-col">
            <?php if ($i = get_field('about_intro_image')): ?>
                <figure><img src="<?= esc_url($i) ?>" alt=""></figure>
            <?php endif; ?>
            <div>
                <?php if ($t = wx_field('about_intro_title')): ?><h3><?= esc_html($t) ?></h3><?php endif; ?>
                <?= wp_kses_post(wx_field('about_intro_body')) ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Features -->
    <?php if (wx_field('feature1_title') || wx_field('feature2_title')): ?>
    <section class="about-block alt">
        <div class="inner two-col">
            <div class="feature-card">
                <h3><?= esc_html(wx_field('feature1_title')) ?></h3>
                <ul>
                <?php if (have_rows('feature1_items')): while (have_rows('feature1_items')): the_row(); ?>
                    <li><?= esc_html(wx_sub_field('text')) ?></li>
                <?php endwhile; endif; ?>
                </ul>
            </div>
            <div class="feature-card">
                <h3><?= esc_html(wx_field('feature2_title')) ?></h3>
                <ul>
                <?php if (have_rows('feature2_items')): while (have_rows('feature2_items')): the_row(); ?>
                    <li><?= esc_html(wx_sub_field('text')) ?></li>
                <?php endwhile; endif; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Partner -->
    <?php if (wx_field('partner_title') || get_field('partner_image')): ?>
    <section class="about-block">
        <div class="inner two-col reverse">
            <?php if ($i = get_field('partner_image')): ?>
                <figure><img src="<?= esc_url($i) ?>" alt=""></figure>
            <?php endif; ?>
            <div>
                <?php if ($t = wx_field('partner_title')): ?><h3><?= esc_html($t) ?></h3><?php endif; ?>
                <?= wp_kses_post(wx_field('partner_body')) ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php get_footer(); ?>
