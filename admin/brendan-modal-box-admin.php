<?php
/*
Plugin Name: Brendan Modal Nox
Description: A demo plugin for testing.
Version: 1.0
Author: Khaled Abu Alqomboz ( eng.khaledb@gmail.com )
Author URI: https://www.upwork.com/freelancers/~015481ec324b2f803a
*/

namespace KhaledB;
// Disable Direct access
if (!defined('ABSPATH')) die('Direct access not allowed');


if (!class_exists('BrendanModalBoxAdmin')):
    class BrendanModalBoxAdmin
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'menu'));
            add_action('admin_init', array($this, 'init'));
            $this->check_post();
        }

        function init()
        {
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));


        }

        function menu()
        {
            add_menu_page('BMB Modal',
                'BMB Modal', 'manage_options',
                'bmb_modal', array($this, 'setting_view'),'dashicons-format-image');
        }

        function setting_view()
        {
            global $options;
            $options = get_option('brendan_modal_box_settings');
            require_once(BMB_PATH . 'admin/settings-view.php');
        }

        function admin_enqueue()
        {
            wp_enqueue_script('bmb-admin', BMB_URL . 'assets/js/admin.js', array('jquery'), (BMB_DEBUG_MODE) ? time() : null, true);
            wp_enqueue_style('bmb-admin', BMB_URL . 'assets/css/admin.css', array(), (BMB_DEBUG_MODE) ? time() : null);
        }

        function check_post()
        {
            if (isset($_POST['bmb_submit_button'])) {
                $brendan_modal_box_settings = array(
                    'enabled' => isset($_POST['bmb_enabled']) == true,
                    'body_text' => $_POST['bmb_body_text'],
                    'background' => $_POST['bmb_background'],
                    'link_text' => $_POST['bmb_link_text'],
                    'link_url' => $_POST['bmb_link_url']
                );
                update_option('brendan_modal_box_settings', $brendan_modal_box_settings);
                $_SESSION['bmb_success'] = true;
                $_SESSION['bmb_msg'] = 'Settings saved!';
            }
        }
    }

endif;
