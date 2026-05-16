<?php
/* Template Name: 联系我们 */
get_header();
$jp = wx_is_jp();
$page_id = get_the_ID();
$opt = wx_options_pid();

$form_id_zh = (int) get_field('contact_form_id', $page_id);
$form_id_jp = (int) get_field('contact_form_id_jp', $page_id);
$form_id = ($jp && $form_id_jp) ? $form_id_jp : $form_id_zh;
$form_title = wx_field('contact_form_title', $page_id) ?: ($jp ? 'お問い合わせフォーム' : '在线留言');

$company_name = wx_field('company_name', $opt);
$ceo          = wx_field('ceo', $opt);
$overseas     = wx_field('overseas', $opt);
$founded      = get_field('founded', $opt);
$email        = get_field('cn_email', $opt);

$cn_label   = wx_field('cn_label', $opt);
$cn_addr    = wx_field('cn_addr', $opt);
$cn_tel     = get_field('cn_tel', $opt);
$cn_fax     = get_field('cn_fax', $opt);
$cn_mobile  = get_field('cn_mobile', $opt);
$cn_postcode= get_field('cn_postcode', $opt);

$jp_label   = wx_field('jp_label', $opt);
$jp_addr    = wx_field('jp_addr', $opt);
$jp_tel     = get_field('jp_tel', $opt);
$jp_mobile  = get_field('jp_mobile', $opt);
$jp_postcode= get_field('jp_postcode', $opt);

$baidu_ak   = get_field('baidu_map_ak', $opt);
$baidu_lng  = get_field('baidu_map_lng', $opt);
$baidu_lat  = get_field('baidu_map_lat', $opt);
?>

<div id="contents1" class="lianxi-page">
    <h2><?= $jp ? 'お問い合わせ' : '联系我们' ?></h2>

    <div class="lianxi-layout">
        <!-- LEFT: form (primary CTA) -->
        <section class="lianxi-form-col">
            <h3 class="lianxi-h"><?= esc_html($form_title) ?></h3>
            <p class="lianxi-sub"><?= $jp ? '担当者よりご連絡いたします。' : '我们会尽快与您联系。' ?></p>
            <?php if ($form_id && shortcode_exists('forminator_form')): ?>
                <?= do_shortcode('[forminator_form id="' . $form_id . '"]') ?>
            <?php endif; ?>
        </section>

        <!-- RIGHT: contact info card -->
        <aside class="lianxi-info-col">
            <h3 class="lianxi-h"><?= $jp ? '会社概要' : '公司概要' ?></h3>

            <?php if ($company_name): ?>
                <div class="lianxi-company"><?= esc_html($company_name) ?></div>
            <?php endif; ?>

            <ul class="lianxi-facts">
                <?php if ($ceo): ?>
                    <li><span class="k"><?= $jp ? '代表取締役' : '总经理' ?></span><span class="v"><?= esc_html($ceo) ?></span></li>
                <?php endif; ?>
                <?php if (!$jp && $overseas): ?>
                    <li><span class="k">海外部经理</span><span class="v"><?= esc_html($overseas) ?></span></li>
                <?php endif; ?>
                <?php if ($founded): ?>
                    <li><span class="k"><?= $jp ? '設立' : '设立' ?></span><span class="v"><?= esc_html($founded) ?></span></li>
                <?php endif; ?>
            </ul>

            <div class="lianxi-block">
                <h4 class="lianxi-block-h"><?= esc_html($cn_label ?: ($jp ? '中国オフィス' : '中国区')) ?></h4>
                <ul class="lianxi-contact">
                    <?php if ($cn_addr): ?>
                        <li><span class="ic">📍</span><?= esc_html($cn_addr) ?><?= $cn_postcode ? ' &nbsp;<span class="muted">'.esc_html($jp?'〒':'邮编 ').esc_html($cn_postcode).'</span>' : '' ?></li>
                    <?php endif; ?>
                    <?php if ($cn_tel): ?>
                        <li><span class="ic">☎</span><a href="tel:<?= esc_attr(preg_replace('/[^0-9+]/','',$cn_tel)) ?>"><?= esc_html($cn_tel) ?></a><?= $cn_fax ? ' <span class="muted">/ '.esc_html($jp?'FAX ':'传真 ').esc_html($cn_fax).'</span>' : '' ?></li>
                    <?php endif; ?>
                    <?php if ($cn_mobile): ?>
                        <li><span class="ic">📱</span><a href="tel:<?= esc_attr(preg_replace('/[^0-9+]/','',$cn_mobile)) ?>"><?= esc_html($cn_mobile) ?></a></li>
                    <?php endif; ?>
                    <?php if ($email): ?>
                        <li><span class="ic">✉</span><a href="mailto:<?= esc_attr($email) ?>"><?= esc_html($email) ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if ($jp_addr || $jp_tel || $jp_mobile): ?>
            <div class="lianxi-block">
                <h4 class="lianxi-block-h"><?= esc_html($jp_label ?: '日本オフィス') ?></h4>
                <ul class="lianxi-contact">
                    <?php if ($jp_addr): ?>
                        <li><span class="ic">📍</span><?= $jp_postcode ? '<span class="muted">〒'.esc_html($jp_postcode).'</span> ' : '' ?><?= esc_html($jp_addr) ?></li>
                    <?php endif; ?>
                    <?php if ($jp_tel): ?>
                        <li><span class="ic">☎</span><?= esc_html($jp_tel) ?></li>
                    <?php endif; ?>
                    <?php if ($jp_mobile): ?>
                        <li><span class="ic">📱</span><?= esc_html($jp_mobile) ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>
        </aside>
    </div>

    <!-- BOTTOM: Baidu Map full width -->
    <?php if ($baidu_ak && $baidu_lng && $baidu_lat): ?>
        <section class="lianxi-map">
            <div id="baidu-map" data-ak="<?= esc_attr($baidu_ak) ?>" data-lng="<?= esc_attr($baidu_lng) ?>" data-lat="<?= esc_attr($baidu_lat) ?>" data-title="<?= esc_attr($company_name ?: '') ?>" data-addr="<?= esc_attr($cn_addr ?: '') ?>"></div>
        </section>
        <script src="https://api.map.baidu.com/api?v=3.0&ak=<?= esc_attr($baidu_ak) ?>&callback=wxInitBaiduMap"></script>
        <script>
        function wxInitBaiduMap(){
            var el = document.getElementById('baidu-map');
            if(!el) return;
            var lng = parseFloat(el.dataset.lng), lat = parseFloat(el.dataset.lat);
            var map = new BMap.Map('baidu-map');
            var pt = new BMap.Point(lng, lat);
            map.centerAndZoom(pt, 17);
            map.enableScrollWheelZoom(false);
            map.addControl(new BMap.NavigationControl());
            map.addControl(new BMap.ScaleControl());
            var marker = new BMap.Marker(pt);
            map.addOverlay(marker);
            var info = new BMap.InfoWindow('<strong>'+el.dataset.title+'</strong><br>'+el.dataset.addr, {width:260});
            marker.addEventListener('click', function(){ map.openInfoWindow(info, pt); });
            map.openInfoWindow(info, pt);
        }
        </script>
    <?php else: ?>
        <section class="lianxi-map lianxi-map-placeholder">
            <div class="placeholder-inner">
                <?php $legacy_map = wx_img_url(get_field('cn_map', $opt)); ?>
                <?php if ($legacy_map): ?>
                    <img src="<?= esc_url($legacy_map) ?>" alt="<?= esc_attr($company_name) ?>">
                <?php else: ?>
                    <p class="muted"><?= $jp ? '地図準備中' : '地图加载中…（请在站点设置里配置百度地图 AK + 坐标）' ?></p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
