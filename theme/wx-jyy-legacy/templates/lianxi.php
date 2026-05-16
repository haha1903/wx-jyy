<?php
/* Template Name: 联系我们 */
get_header();
$jp = wx_is_jp();

$cn_label = wx_field('cn_label', wx_options_pid());
$jp_label = wx_field('jp_label', wx_options_pid());
?>

<div id="contents1">
    <h2><?= $jp ? 'クシダ工業の機械加工' : '联系我们' ?></h2>
    <h3><?= esc_html(wx_field('contact_intro', $page_id) ?: ($jp ? 'お問い合わせ' : '公司概要')) ?></h3>
    <div id="right">
        <table align="center">
            <?php if ($v = wx_field('company_name', wx_options_pid())): ?>
                <tr><th class="s14a"><?= $jp ? '会社名' : '公司名称' ?></th><td class="s14a"><?= esc_html($v) ?></td></tr>
            <?php endif; ?>
            <?php if ($v = wx_field('ceo', wx_options_pid())): ?>
                <tr><th class="s14a"><?= $jp ? '代表取締役' : '总经理' ?></th><td class="s14a"><?= esc_html($v) ?></td></tr>
            <?php endif; ?>
            <?php if (!$jp && ($v = wx_field('overseas', wx_options_pid()))): ?>
                <tr><th class="s14a">海外部经理</th><td class="s14a"><?= esc_html($v) ?></td></tr>
            <?php endif; ?>
            <?php if ($v = get_field('founded', wx_options_pid())): ?>
                <tr><th class="s14a"><?= $jp ? '設立' : '设立年月日' ?></th><td class="s14a"><?= esc_html($v) ?></td></tr>
            <?php endif; ?>
            <?php if ($jp && ($v = get_field('capital_jp', wx_options_pid()))): ?>
                <tr><th class="s14a">資本金</th><td class="s14a"><?= esc_html($v) ?></td></tr>
            <?php endif; ?>
            <?php if ($jp && ($v = get_field('business_jp', wx_options_pid()))): ?>
                <tr><th class="s14a">事業内容</th><td class="s14a"><?= wp_kses_post($v) ?></td></tr>
            <?php endif; ?>
            <?php if ($v = get_field('cn_email', wx_options_pid())): ?>
                <tr><th class="s14a">E-mail</th><td class="s14a"><a href="mailto:<?= esc_attr($v) ?>"><?= esc_html($v) ?></a></td></tr>
            <?php endif; ?>
            <tr>
                <th class="s14a"><?= $jp ? '所在地' : '公司所在地' ?></th>
                <td class="s14a">
                    <strong><?= esc_html($cn_label) ?></strong><br>
                    <?php if ($v = wx_field('cn_addr', wx_options_pid())): ?><?= $jp ? '住所 : ' : '地址 ' ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('cn_tel', wx_options_pid())): ?><?= $jp ? 'TEL : ' : '电话 ' ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('cn_fax', wx_options_pid())): ?><?= $jp ? 'FAX : ' : '传真 ' ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('cn_mobile', wx_options_pid())): ?><?= $jp ? '携帯 : ' : '手机 ' ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('cn_postcode', wx_options_pid())): ?><?= $jp ? '〒' : '邮编 ' ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($map = wx_img_url(get_field('cn_map', wx_options_pid()))): ?><img src="<?= esc_url($map) ?>" alt=""><br><br><?php endif; ?>

                    <strong><?= esc_html($jp_label) ?></strong><br>
                    <?php if ($v = get_field('jp_postcode', wx_options_pid())): ?>〒<?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = wx_field('jp_addr', wx_options_pid())): ?><?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('jp_tel', wx_options_pid())): ?>TEL/FAX&nbsp;&nbsp;<?= esc_html($v) ?><br><?php endif; ?>
                    <?php if ($v = get_field('jp_mobile', wx_options_pid())): ?><?= $jp ? '携帯　' : 'MOBILE　' ?><?= esc_html($v) ?><br><br><?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

<?php get_footer(); ?>
