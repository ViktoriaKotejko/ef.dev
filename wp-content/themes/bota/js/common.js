jQuery(function($) {

    var mbox_max_height = Math.max.apply(null, $("div.span_1_of_3 .featuretext").map(function ()
    {
        return $(this).height();
    }).get());


    $('.featuretext').height(mbox_max_height);

});