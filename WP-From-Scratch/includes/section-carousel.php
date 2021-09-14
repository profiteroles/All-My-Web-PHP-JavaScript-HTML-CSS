<?php
/**
 * Template for the carousel.
 */
?>
<div id="carouselIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $carousel = new WP_Query(array('post_type' => 'bootcarousel'));
        $carouselNo = 0;
        while ($carousel->have_posts()):
        $carousel->the_post();
        $carouselNo++ ?>
        <?php if ($carouselNo == 1) : ?>
        <div class="carousel-item active">
            <?php else: ?>
            <div class="carousel-item">
                <?php endif; ?>
                <img class="d-block w-100"
                     src="<?php the_post_thumbnail_url('xl-image'); ?>" alt="<?php the_title(); ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php the_title(); ?></h5>
                    <p><?php the_content(); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
