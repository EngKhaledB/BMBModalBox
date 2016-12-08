jQuery(window).bind("load", function() {
    if (window.bmb_box_enabled === true) {
        jQuery('#bmb-modal').show();
        jQuery('html').css('overflow','hidden');
        jQuery('#bmb-close').click(function (e) {
            e.preventDefault();
            jQuery('#bmb-modal').hide();
            jQuery('html').css('overflow','');

        });
    }
});