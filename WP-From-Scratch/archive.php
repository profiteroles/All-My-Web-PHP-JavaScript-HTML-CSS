<section class="page-wrap">
    <div class="container pt-5 pb-5">
        <h1><?php echo single_cat_title(); ?></h1>
        <?php get_template_part('includes/section', 'archive'); ?>
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
    </div>
</section>
