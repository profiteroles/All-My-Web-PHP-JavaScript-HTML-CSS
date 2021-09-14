<?php get_header(); ?>
<section class="page-wrap">
    <div class="container pt-5 pb-5">
        <h1>Search Results for '<?php echo get_search_query(); ?>'</h1>
        <?php get_template_part('includes/section', 'archive'); ?>
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
    </div>
</section>

<?php get_footer(); ?>
