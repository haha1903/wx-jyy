<?php
/* Template Name: 设备 */
get_header();
$jp = wx_is_jp();

$sections = get_terms(['taxonomy' => 'equipment_section', 'hide_empty' => false, 'orderby' => 'term_order', 'order' => 'ASC']);
?>

<div id="contents1">
    <h2><?= $jp ? 'クシダ工業の工作機械' : '主要设备' ?></h2>

<?php foreach ($sections as $sec):
    $jp_name = get_term_meta($sec->term_id, 'name_jp', true);
    $heading = $jp && $jp_name ? $jp_name : $sec->name;

    $items = get_posts([
        'post_type'      => 'equipment',
        'tax_query'      => [['taxonomy' => 'equipment_section', 'terms' => $sec->term_id]],
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
        'posts_per_page' => -1,
    ]);
    if (!$items) continue;
?>
    <h3><?= esc_html($heading) ?></h3>
    <ul>
        <li>
        <?php foreach ($items as $e):
            $img = get_the_post_thumbnail_url($e->ID, 'medium_large');
            if (!$img) continue;
            $title_jp = get_field('equip_title_jp', $e->ID);
            $caption = $jp && $title_jp ? $title_jp : $e->post_title;
        ?>
            <div class="desc">
                <?= esc_html($caption) ?><br>
                <img src="<?= esc_url($img) ?>" alt="<?= esc_attr($caption) ?>">
            </div>
        <?php endforeach; ?>
        </li>
    </ul>
<?php endforeach; ?>

<?php get_footer(); ?>
