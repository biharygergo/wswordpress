<?php
add_action('after_setup_theme', 'blankslate_setup');
function blankslate_setup()
{
    load_theme_textdomain('blankslate', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    global $content_width;
    if (!isset($content_width)) $content_width = 640;
    register_nav_menus(
        array('main-menu' => __('Main Menu', 'blankslate'))
    );
}

add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
function blankslate_load_scripts()
{
    wp_enqueue_script('jquery');
}

add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_filter('the_title', 'blankslate_title');
function blankslate_title($title)
{
    if ($title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter('wp_title', 'blankslate_filter_wp_title');
function blankslate_filter_wp_title($title)
{
    return $title . esc_attr(get_bloginfo('name'));
}

add_action('widgets_init', 'blankslate_widgets_init');
function blankslate_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'blankslate'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

function blankslate_custom_pings($comment)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter('get_comments_number', 'blankslate_comments_number');
function blankslate_comments_number($count)
{
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

function addCustomizer($wp_customize){
    $wp_customize->add_section('countdown', array('title' => 'Countdown settings'));
    $wp_customize->add_setting('event_date', array('default' => '2017-10-19T10:30:00Z'));
    $wp_customize->add_control('date_contol', array('section'=>'countdown', 'settings' => 'event_date', 'label' => 'Date of the event in ISO format'));
    $wp_customize->add_setting('event_name', array('default' => 'No name set'));
    $wp_customize->add_control('name_contol', array('section'=>'countdown', 'settings' => 'event_name', 'label' => 'Name of the event'));

    $wp_customize->add_section('link', array('title' => 'CTA Settings'));
    $wp_customize->add_setting('ticket_link', array('default' => 'http://www.ticketmaster.com'));
    $wp_customize->add_control('link_contol', array('section'=>'link', 'settings' => 'ticket_link', 'label' => 'Tickets URL'));
}
add_action( 'customize_register', 'addCustomizer' );

add_action( 'wp_ajax_proba', 'prefix_ajax_add_foobar' );
add_action( 'wp_ajax_nopriv_proba', 'prefix_ajax_add_foobar' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_script('header-script', get_stylesheet_directory_uri() . '/header.js', array('jquery'));
    wp_localize_script( 'header-script', 'ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function prefix_ajax_add_foobar() {
    // Handle request then generate response using WP_Ajax_Response

    // Don't forget to stop execution afterward
    $post =  get_post($_POST['id']);
    $posts = new WP_Query(['p' => $_POST['id']]);
    $GLOBALS['wp_query'] = $posts;
    echo get_template_part('page');

    die();
}
add_filter('allowed_http_origins', 'add_allowed_origins');

function add_allowed_origins($origins) {
    $origins[] = 'http://192.168.221.129';
    return $origins;
}