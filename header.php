<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
    <?php wp_head(); ?>
<script>
(function ($) {
    $(document).ready(function () {
        $('.preview-video').hover(function () {
            $('.main-video')[0].pause();
            $(this)[0].play();
        }, function () {
            $('.main-video')[0].play();
            $(this)[0].pause();

        })

        $('a').click(function () {

            $.post(ajax_object.ajax_url, {
                action: 'proba',
                id: 24  // << should grab this from input...

            }, function(data) {

                alert(data);
                var $response   =   $(data);
                var postdata    =   $response.filter('#postdata').html();

               // $('.TARGETDIV').html(postdata);
            });
           // $('.target').load(ajax_object.ajax_url + 'add_foobar');
            $('.sidebar').css({'margin-right': 0})
        })


    })
}(jQuery));
</script>
</head>
<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">
    <section id="navbar">
        <div class="navbar">
            <img class="logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/eventX.png">

        </div>
    </section>
    <section id="header">
        <h1 class="page-title"><?php echo esc_html(get_bloginfo('name')); ?></h1>
    </section>
    <div id="container">