<?php

//Enqueue CSS files
function load_stylesheets()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('style', get_template_directory_uri() . '/dist/app.css', [], 1, 'all');
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'load_stylesheets');

//Enqueue JS files
function load_js()
{
    wp_register_script('app', get_template_directory_uri() . '/dist/app.js', ['jquery'], 1, true);
    wp_enqueue_script('app');
}
add_action('wp_enqueue_scripts', 'load_js');


//Theme Options
add_theme_support("menus");
add_theme_support("post-thumbnails");
add_theme_support('widgets');
add_theme_support('background');

//Menus
register_nav_menus(
    array(
//        'primary' => __('Primary Menu', 'profiterol'),
        'top-menu' => __('Top Menu', 'theme'),
        'mobile-menu'=>'Mobile Menu Location',
        'footer-menu' => __('Footer Menu', 'theme'),
    )
);

//custom image size
add_image_size('xl-image', 1200, 600, true);
add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 300, 200, true);

//Register SideBars
function custom_widgets()
{
    register_sidebar(
        array(
            'name' => esc_html__('Top Logo', 'logowidget'),
            'id' => 'top_logo',
            'description' => esc_html__('add logo img to the nav bar', 'logowidget'),
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        )
    );

    register_sidebar(
        array(
            'name'=> esc_html__('Image Under Slider', 'imageUnderSlider'),
            'id'=>'image_under_slider',
            'description'=> esc_html__('Adding Image under the Slider', 'imageUnderSlider'),
            'before_widget'=>'',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        )
    );



        register_sidebar(
            array(
                'name'=> esc_html__('Home Page Content', 'textContent'),
                'id'=>'home_content',
                'description'=> esc_html__('Shows the Home Page Content', 'textContent'),
                'before_widget'=>'',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );
    register_sidebar(
        array(
            'name'=> esc_html__('Home Page Video', 'homevideo'),
            'id'=>'home_video',
            'description'=> esc_html__('Shows the Video', 'homevideo'),
            'before_widget'=>'',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        )
    );



        register_sidebar(
            array(
                'name'=> esc_html__('Custom Widgets Area', 'customwidgetsarea'),
                'id'=>'custom_widgets',
                'description'=> esc_html__('Shows the Widgets', 'customwidgetsarea'),
                'before_widget'=>'',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            )
        );

    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'class' => 'custom',
        'description' => 'Standard Sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s"',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class=widget-title"',
        'after_title' => '</h1',
    ));

    register_sidebar(
        array(
            'name' => 'Top Image',
            'id' => 'top-image',
            'description' => 'Top Image',
            'before_widget' => '<aside id="%1$s" class="widget %2$s"',
            'after_widget' => '</aside>',
        )
    );
}
add_action('widgets_init', 'custom_widgets');

function bootcarousel_function()
{
    add_theme_support('post-thumbnails');
    register_post_type('bootcarousel',

        array(
            'labels' => array(
                'name' => 'Carousel Option',
                'add_new_item' => 'Add new Carousel',
            ),
            'public' => true,
            'menu_icon' => 'dashicons-images-alt2',
            'supports' => array('title', 'editor', 'thumbnail')
        ));
}

add_action('after_setup_theme', 'bootcarousel_function');
function my_first_post_type()
{
    $args = array(
        'labels' => array(
            'name' => 'Books',
            'singular_name' => 'Book',
        ),
//        'hierarchical'=> true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-book-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
//        'rewrite'=>array('slug'=>'books')
    );
    register_post_type('books', $args);
}

add_action('init', 'my_first_post_type');

function my_first_taxonomy()
{
    $args = array(
        'labels' => array('name' => 'Genres', 'singular_name' => 'Genre'),
        'public' => true,
        'hierarchical' => true,
    );
    register_taxonomy('genres', array('books'), $args);
}

add_action('init', 'my_first_taxonomy');

add_action('wp_ajax_enquiry', 'enquiry_form');
add_action('wp_ajaxn_nopriv_enquiry', 'enquiry_form');
function enquiry_form()
{
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_send_json_error('Nonce is incorrect', 401);
        die();
    }

    $formData = [];
    wp_parse_str($_POST['enquiry'], $formData);

    $admin_email = get_option('admin_email');
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Book Website <' . $admin_email . '>';
    $headers[] = 'Reply-to' . $formData['email'];
//    $headers[] = 'BCC: '. 'to any one';

    $send_to = $admin_email;
    $subject = $formData['subject'];
    $enquiryFrom = 'Enquiry from ' . $formData['fname'];
    $message = '';
    foreach ($formData as $index => $field) {
        $message .= '<strong>' . $index . '</strong>' . $field . '<br/>';
    }

    try {
        if (wp_mail($send_to, $subject, $message, $headers)) {
            wp_send_json_success('Request is Sent');
        } else {
            wp_send_json_error('Issue Has Occoured\nPlease Try Again');
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }

    wp_send_json_success($formData['fname']);
}

//Nav Walker Override the WP Nav with BootSrap Nav Bar
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action('after_setup_theme', 'register_navwalker');

function my_shortcode($atts, $content = null, $tag = '')
{
    ob_start();
    set_query_var('attributes', $atts);
    get_template_part('includes/latest', 'books');
    return ob_get_clean();
}

add_shortcode('latest_books', 'my_shortcode');