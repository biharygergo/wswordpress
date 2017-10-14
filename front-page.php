<?php get_header(); ?>
<section id="slider">

    <?= do_shortcode('[slider]');?>
</section>
<section id="content">
    <div class="container">

    <div class="main-content">

        <script>
            function toggleDetails(id) {
                jQuery('.excerpt' + id).toggleClass('hidden');
                jQuery('.content' + id).toggleClass('hidden');
            }
        </script>
            <div class="news">
                <h2 style="color: white;">News</h2>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="news-item">
                        <div class="news-item-header">
                            <h3><?php the_title()?></h3>
                        </div>
                        <div class="news-item-content">
                            <img class="news-image" src="<?php echo get_field('post_image')?>">
                            <div class="news-item-text">
                                <div class="excerpt<?php the_ID()?>">
                                    <p><?php the_excerpt()?></p>

                                </div>
                                <div class="content<?php the_ID()?> hidden">
                                    <p><?php the_content()?></p>
                                </div>
                            </div>

                        </div>
                        <div class="news-footer">
                            <button class="btn read-more" onclick="toggleDetails(<?php the_ID()?>)">Read more</button>

                        </div>
                    </div>
                <?php endwhile; endif; ?>


            </div>
            <div class="countdown">
               <script>
                   var date = new Date("<?php  echo get_theme_mod('event_date')?>");

                   (function ($) {
                       $(document).ready(function () {
                           setInterval(function () {
                               var now = new Date().getTime();
                               var dist = date - now;
                               var days = Math.floor(dist / (1000 * 60 * 60 * 24));
                               var hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                               var minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                               var seconds = Math.floor((dist % (1000 * 60)) / 1000);

                               $('.days').text(days);
                               $('.hours').text(hours);
                               $('.minutes').text(minutes);
                               $('.seconds').text(seconds);
                           }, 1000)
                       })
                   }(jQuery))
               </script>
                <div class="countdown-title">
                    <h3><?php echo get_theme_mod('event_name')?> opens on 2017.10.18.</h3>
                </div>
                <div class="countdown-content">
                    <div class="countdown-card">
                        <div class="card-header">
                            Days
                        </div>
                        <div class="card-body days">
                            12
                        </div>
                    </div>
                    <div class="countdown-card">
                        <div class="card-header">
                            hours
                        </div>
                        <div class="card-body hours">
                            12
                        </div>
                    </div>
                    <div class="countdown-card">
                        <div class="card-header">
                            minutes
                        </div>
                        <div class="card-body minutes">
                            12
                        </div>
                    </div>
                    <div class="countdown-card">
                        <div class="card-header">
                            seconds
                        </div>
                        <div class="card-body seconds">
                            12
                        </div>
                    </div>

                </div>
            </div>
            <div class="buy">
                <h2>Buy your tickets now!</h2>
                <button class="btn btn-cta"><a href="<?php echo get_theme_mod('ticket_link')?>">Buy now!</a></button>
            </div>
        </div>

    </div>
    <div class="sidebar">
        <h2 style="color: white;">Sponsors</h2>

        <div class="sponsors">
            <?= do_shortcode('[sponsors]');?>

        </div>
        <?php get_sidebar(); ?>

    </div>

</section>

<?php get_footer(); ?>