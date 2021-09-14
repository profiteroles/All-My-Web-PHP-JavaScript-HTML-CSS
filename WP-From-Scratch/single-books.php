<?php get_header(); ?>
    <section class="page-wrap">
        <div class="container pt-5 pb-5">
            <h1><?php the_title(); ?></h1>

            <div class="row">
                <div class="col-lg-6">
                    <?php if (has_post_thumbnail()): ?>
                        <img src="<?php the_post_thumbnail_url('blog-large'); ?>" alt="<?php the_title(); ?>" class="img-fluid mb-3 img-thumbnail">
                    <?php endif; ?>
                    <?php get_template_part('includes/section', 'books'); ?>
                    <?php wp_link_pages(); ?>
                </div>
                <div class="col-lg-6">
                    <ul>
                        <li>Author: <?php the_field('author');//echo get_post_meta($post->ID,'author', true ) ?></li>
                        <li>Price: <?php the_field('price');//echo get_post_meta($post->ID,'price', true ) ?></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>