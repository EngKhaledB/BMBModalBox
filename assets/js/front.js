jQuery(window).bind("load", function () {
    if (window.bmb_box_enabled === true) {
        jQuery('html').css('overflow', 'hidden !important');
        jQuery('#bmb-modal').fadeIn();
        jQuery('#bmb-close').click(function (e) {
            e.preventDefault();
            jQuery('html,body').css('overflow', '');
            jQuery('#bmb-modal').fadeOut();
        });
    }
});