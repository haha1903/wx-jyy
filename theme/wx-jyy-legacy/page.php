<?php
// Fallback for pages that don't pick a specific template — render the post content inside the legacy chrome.
$wx_page_css = '/css/jieshao/index.css';
get_header();
?>

<ul id="pan">
    <li><a href="<?php echo esc_url(home_url('/')); ?>">首页</a></li>
    <?php if (have_posts()): the_post(); ?>
        <li>&nbsp;&gt;&nbsp;<?php the_title(); ?></li>
    <?php endif; ?>
</ul>

<div id="contents1">
    <?php if (have_posts()) the_content(); ?>

<?php get_footer(); ?>
