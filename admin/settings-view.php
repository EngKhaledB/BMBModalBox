<?php if (!defined('ABSPATH')) exit;
global $options;
if (isset($_SESSION['bmb_success'])) {
    $success = true;
    unset($_SESSION['bmb_success']);
}
?>
<div class="bmb-wrap">
    <h1>Branden Modal Box Settings</h1>
    <?php if ($success): ?>
        <div class="updated settings-error notice is-dismissible">
            <p><strong>Settings saved.</strong></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
    <?php endif; ?>
    <hr/>

    <form id="bmb-form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="content">
            <p>
                <label for="bmb_enabled" class="strong-label">
                    <input type="checkbox" id="bmb_enabled" <?php echo $options['enabled'] ? 'checked="checked"' : '' ?>
                           value="1" name="bmb_enabled"/>
                    Enable Modal
                </label>
            </p>


            <p>
                <label class="strong-label">Modal Content</label>
                <?php wp_editor(stripcslashes($options['body_text']), 'bmb_body_text', array('editor_height' => 180)) ?>
            </p>

            <p>

                <label class="strong-label">Background</label>
                <input id="bmb_background" type="text" value="<?php echo $options['background'] ?>"
                       name="bmb_background" class="w300px"/>
                <input id="bmb_background_btn" type="button" class="button" value="Upload Image"/>
                <img id="bmb_background_thumb" style="max-width:300px; max-height: 300px; display: block; clear: both;"
                     alt=""/>
            </p>

            <p>
                <label class="strong-label">Link Text</label>
                <input type="text" id="bmb_link_text" value="<?php echo $options['link_text'] ?>" name="bmb_link_text"
                       class="w300px"/>
            </p>

            <p>
                <label class="strong-label">Link URL</label>
                <input type="text" id="bmb_link_url" value="<?php echo $options['link_url'] ?>" name="bmb_link_url"
                       class="w300px"/>
            </p>
        </div>
        <p>
            <input type="submit" name="bmb_submit_button" id="submit" class="button button-primary"
                   value="Save Changes">
        </p>
    </form>
</div>