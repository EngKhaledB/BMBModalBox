jQuery(document).ready(function(jQuery){

    var mediaUploader;

    jQuery('#bmb_background_btn').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false });

        mediaUploader.on('select', function() {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            jQuery('#bmb_background').val(attachment.url);
            jQuery('#bmb_background_thumb').attr('src',attachment.url);
        });
        mediaUploader.open();
    });

});