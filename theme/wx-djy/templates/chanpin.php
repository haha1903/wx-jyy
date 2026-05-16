<?php
/* Template Name: 产品 */
get_header();
$jp = wx_is_jp();

// fetch all product categories in order, then their products
$cats = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false, 'orderby' => 'term_order', 'order' => 'ASC']);
?>

<div id="contents1">
    <h2><?= $jp ? 'クシダ工業の機械加工' : '产品展示' ?></h2>

<?php foreach ($cats as $cat):
    $jp_name = get_term_meta($cat->term_id, 'name_jp', true);
    $heading = $jp && $jp_name ? $jp_name : $cat->name;

    $products = get_posts([
        'post_type'      => 'product',
        'tax_query'      => [['taxonomy' => 'product_cat', 'terms' => $cat->term_id]],
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
        'posts_per_page' => -1,
    ]);
    if (!$products) continue;
?>
    <h3><?= esc_html($heading) ?></h3>
    <ul>
        <li>
        <?php foreach ($products as $p):
            $img = get_the_post_thumbnail_url($p->ID, 'medium_large');
            if (!$img) continue;
            $title_jp = get_field('product_title_jp', $p->ID);
            $alt = $jp && $title_jp ? $title_jp : $p->post_title;
        ?>
            <div class="desc_jp"><img src="<?= esc_url($img) ?>" alt="<?= esc_attr($alt) ?>"></div>
        <?php endforeach; ?>
        </li>
    </ul>
<?php endforeach; ?>

<?php get_footer(); ?>
