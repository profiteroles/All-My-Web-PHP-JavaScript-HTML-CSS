<?php wp_footer(); ?>
<footer id="site-footer" class="bg-dark p-4">
    <div class="container color-gray">
        <div class="row align-items-center">
            <section class="col-6 ">
                <h5 class="text-white">Quick Links</h5>
                <lo class="text-white">
                    <ul>
                        <a href="/wordpress" class="text-decoration-none ">
                            <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'footer-menu' => 'footer')); ?>
                        </a>
                    </ul>
                </lo>
            </section>
            <section class="col-lg-6 col-md-6 col-sm-6">
                <ul class="d-flex">
                    <?php get_template_part('includes/content', 'svgs'); ?>
                </ul>
            </section>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="col-md-12 text-center mt-5">
            <p class="text-white">Copyright uniQ App Store © 2021. All rights reserved.</p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>