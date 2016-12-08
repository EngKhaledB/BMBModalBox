<?php

if (defined('WP_UNINSTALL_PLUGIN')) {
    delete_option('brendan_modal_box_settings');
} else {
    exit("Direct access not allowed");
}

