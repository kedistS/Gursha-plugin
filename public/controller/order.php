<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://kedistkid723@gmail.com
 * @since      1.0.0
 *
 * @package    Lounge_Managment
 * @subpackage Lounge_Managment/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Lounge_Managment
 * @subpackage Lounge_Managment/includes
 * @author     Kedist <kedistkid723@gmail.com>
 */
class Gursha_order {

    public function gursha_order_shortcode(){
        include gursha_PLAGIN_DIR . 'public/partials/order/index.php';
    }

    public function gursha_order_shortcode2(){
        echo 'Hello gursha2.';
    }

}