/**
 * Created by Competitor on 10/14/2017.
 */
(function ($) {
    $(document).ready(function () {
        $('.preview-video').hover(function () {
            $('.main-video')[0].pause();
            $(this)[0].play();
        }, function () {
            $('.main-video')[0].play();
            $(this)[0].pause();

        })

        $('.sidebar-btn').click(function () {

            $.post(ajax_object.ajax_url, {
                action: 'add_foobar ',
                id: 2  // << should grab this from input...

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