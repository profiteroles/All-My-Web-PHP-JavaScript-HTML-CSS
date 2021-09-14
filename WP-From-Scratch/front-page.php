<?php get_header(); ?>

<?php get_template_part('includes/section', 'carousel'); ?>

<section class="bg-white flush-with-above m-5 ">
    <div class="container">
        <div class="row justify-content-around align-items-center">
            <div class="col-12 col-md-5 order-md-2 mb-5 mb-md-0">
                <div class="lead">
                    <?php dynamic_sidebar('home_content'); ?>
                </div>
            </div>
            <!--end of col-->
            <div class="col-12 col-md-5 order-md-1">
                <div class="img-fluid shadow"></div>
                <?php dynamic_sidebar('image_under_slider'); ?>
            </div>
            <!--end of col-->
        </div>
    </div>
</section>

<section class="row justify-content-center text-center section-intro">
    <?php dynamic_sidebar('home_video'); ?>
</section>

<section class="row justify-content-center text-center section-intro">
    <?php dynamic_sidebar('custom_widgets'); ?>
</section>
<?php get_footer(); ?>
