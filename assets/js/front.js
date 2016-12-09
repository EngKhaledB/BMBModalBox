jQuery(window).bind("load", function () {
    if (window.bmb_box_enabled === true) {
        jQuery('#bmb-modal').fadeIn();
        jQuery('html').addClass('disableScroll');
        jQuery('#bmb-close').click(function (e) {
            e.preventDefault();
            jQuery('html').removeClass('disableScroll');
            jQuery('#bmb-modal').fadeOut();
        });
    }
});