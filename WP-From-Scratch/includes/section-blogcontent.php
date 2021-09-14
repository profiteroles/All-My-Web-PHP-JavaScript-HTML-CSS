<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h3><?php the_title(); ?></h3>
    <p> <?php echo get_the_date('l jS F, Y'); ?></p>
    <?php the_content(); ?>

    <p>Posted by <?php echo get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name') ?></p>
    <?php $tags = get_the_tags();
    if ($tags):
    foreach ($tags as $tag): ?>

        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge bg-danger"><?php echo $tag->name; ?></a>
    <?php endforeach; ?>
    <!--<?php the_author(); ?> //Display Name on user's profile page -->

    <?php $categories = get_the_category();
    foreach ($categories as $cat) : ?>
        <a href="<?php echo get_category_link($cat->term_id);?>"><?php echo $cat->name; ?></a>


<!--        --><?php //comments_template(); ?>

    <?php endforeach; endif;?>
<?php endwhile; endif; ?>