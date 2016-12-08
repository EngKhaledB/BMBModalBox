<?php
/*
Plugin Name: Brendan Modal Box
Description: A demo plugin for testing.
Version: 1.0
Author: Khaled Abu Alqomboz ( eng.khaledb@gmail.com )
Author URI: https://www.upwork.com/freelancers/~015481ec324b2f803a
*/

namespace KhaledB;
if (!defined('ABSPATH')) die('Direct access not allowed');

if (!defined('BMB_DEBUG_MODE')) define('BMB_DEBUG_MODE', false);
if (!defined('BMB_PATH')) define('BMB_PATH', plugin_dir_path(__FILE__));
if (!defined('BMB_URL')) define('BMB_URL', plugin_dir_url(__FILE__));


if (!class_exists('BrendanModalBox')):
    class BrendanModalBox
    {
        private $options;

        function __construct()
        {
            register_activation_hook(__FILE__, array($this, 'activate'));
            add_action('init', array($this, 'init'));
            $this->add_modal_to_footer();
        }

        function activate()
        {
            if (!get_option('brendan_modal_box_setting')) {
                add_option('brendan_modal_box_settings', array(
                    'enabled' => false,
                    'body_text' => '',
                    'background' => '',
                    'link_text' => '',
                    'link_url' => ''
                ));
            }
        }


        function init()
        {
            add_action('wp_enqueue_scripts', array($this, 'front_enqueue'));
        }

        function front_enqueue()
        {
            wp_enqueue_style('bmb-front', BMB_URL . 'assets/css/front.css', (BMB_DEBUG_MODE) ? time() : null);
            wp_enqueue_script('bmb-front', BMB_URL . 'assets/js/front.js', array('jquery'), (BMB_DEBUG_MODE) ? time() : null, true);
        }

        function add_modal_to_footer()
        {
            $this->options = get_option('brendan_modal_box_settings');

            if (!empty($this->options) && isset($this->options['enabled']) && $this->options['enabled']) {
                if (!isset($_COOKIE['bmb_viewed'])) {
                    add_action('wp_footer', array($this, 'modal_html'));
                    setcookie("bmb_viewed", 1, time() + 21600);
                }
            }
        }

        function modal_html()
        {
            echo sprintf("
            <script>
                window.bmb_box_enabled = true;
            </script>
            <div id=\"bmb-modal\">
                <div id=\"bmb-content-wrap\"
                     style=\"background: url('%s') no-repeat center; background-size: cover\">
                    <span id=\"bmb-close\">x</span>

                    <div id=\"bmb-content\">%s</div>
                    <a href=\"%s\" id=\"bmb-modal-link\">%s</a>
                </div>
            </div>", $this->options['background'], $this->options['body_text'], $this->options['link_url'], $this->options['link_text']);
        }
    }

endif;

new BrendanModalBox();

if (is_admin()) {
    require_once('admin/brendan-modal-box-admin.php');
    new BrendanModalBoxAdmin();
}