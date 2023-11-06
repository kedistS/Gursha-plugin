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
class Gursha_order
{

    public function gursha_order_shortcode()
    {
        // update_user_meta(get_current_user_id(), 'gursha_orders','chicken');
        // global $wp_roles;
        // print_r($wp_r4oles);
        //wp_enqueue_script('trial', gursha_PLAGIN_URL . 'public/js/try.js', array('jquery'), '1.0', true);
        wp_enqueue_style('gursha_style', gursha_PLAGIN_URL . 'public/css/gursha_style.css', array(), '1.0');
        $customer_info = get_user_meta(get_current_user_id(), 'gursha_orders', true);
        $current_time = current_time('timestamp');
        $lunch_start_time = strtotime('18:00:00');
        $lunch_end_time = strtotime('20:59:59');
        $breakfast_start_time = strtotime('07:00:00');
        $breakfast_end_time = strtotime('11:59:59');
        $closed_start_time = strtotime('21:00:00');
        $closed_end_time = strtotime('5:59:59');
        $lunch = false;

        if (
            ($current_time >= $lunch_start_time && $current_time < $lunch_end_time)
        ) {
            // Lunchtime: Display lunch content
            $lunch = true;
            include gursha_PLAGIN_DIR . 'public/partials/order/index.php';
        } elseif (
            ($current_time >= $breakfast_start_time && $current_time < $breakfast_end_time)
        ) {
            // Breakfast time: Display breakfast content
            $lunch = false;
            include gursha_PLAGIN_DIR . 'public/partials/order/index.php';
        } else {
            // Closed hours: Display "we are closed" content
            include gursha_PLAGIN_DIR . 'public/partials/order/closed.php';
        }


        //print_r(get_user_meta(get_current_user_id(), 'gursha_orders', true));
        //print_r(isset($customer_info[0]['first_name']) ? $customer_info[0]['first_name'] : '');
    }
    public function gursha_order_list()
    {
        //     $users = get_users( array( 'fields' => array( 'ID' ) ) );
        //     foreach($users as $user){
        //     print_r(get_user_meta ( $user->ID));
        // }

        $user_data = wp_get_current_user();
        $value = $user_data->roles;
        if (in_array('chef_role', $value)) {
            $users = get_users(array('fields' => 'ids'));
            wp_enqueue_style('gursha_style', gursha_PLAGIN_URL . 'public/css/chef_order_list.css', array(), '1.0');
            include gursha_PLAGIN_DIR . 'public/partials/order/chef_order_list.php';
        } else {
            $order_lists = get_user_meta(get_current_user_id(), 'gursha_orders', true);
            wp_enqueue_style('gursha_style', gursha_PLAGIN_URL . 'public/css/order_list.css', array(), '1.0');
            include gursha_PLAGIN_DIR . 'public/partials/order/order-list.php';

        }

    }
    public function gursha_food_list()
    {
        wp_enqueue_style('gursha_style', gursha_PLAGIN_URL . 'public/css/gursha_food_list_style.css', array(), '1.0');
        include gursha_PLAGIN_DIR . 'public/partials/order/food.php';
    }

    public function wp_ajax_gursha_save_orders()
    {
        $previous_order = get_user_meta(get_current_user_id(), 'gursha_orders', true);
        $bill_id = wp_generate_uuid4();
        if (!is_array($previous_order))
            $previous_order = array();
        array_push(
            $previous_order,
            array(
                'bill_id' => $bill_id,
                'food_quantity' => $_POST['food_quantity'],
                'food_item' => $_POST['food_item'],
                'order_status' => 'pending',
                'ordered_at' => time(),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'city' => $_POST['city'],
                'street' => $_POST['street']
            )
        );
        update_user_meta(get_current_user_id(), 'gursha_orders', $previous_order);
        $email = $_POST['email'];

        $to = $email;
        $subject = 'Ordered successfully';
        $headers = array("content-type: text/html; charset = utf-8");
        $file_pathname = plugin_dir_url(__FILE__) . '../../' . 'emails/index.html';
        $message = file_get_contents($file_pathname);

        wp_mail($to, $subject, $message, $headers);
        die();
    }

    public function wp_ajax_gursha_save_order_status()
    {
        $user_id = $_POST['userId'];
        $bill_id = $_POST['billId'];
        $updated_status = $_POST['updated_order_status'];

        // $bill;
        $user_order = get_user_meta($user_id, 'gursha_orders', true);
        // $single_row = wp_list_filter($user_order, array('bill_id' =>$bill_id));
        foreach ($user_order as $i => $item) {

            if ($item['bill_id'] === $bill_id) {
                $user_order[$i]['order_status'] = $updated_status;
            }
        }
        update_user_meta($user_id, 'gursha_orders', $user_order);

        echo json_encode(array('status' => 'success', 'message' => $updated_status));
        die();
    }


    // public function add_cron_interval($schedules)
    // {
    //     $schedules['two_minutes'] = array(
    //         'interval' => 2 * 60,
    //         'display' => esc_html__('Every two minutes'),
    //     );
    //     return $schedules;
    // }

    public function schedule_event()
    {
        if (!wp_next_scheduled('gursha_order_shortcode')) {
            wp_schedule_event(strtotime('01:00:00'), 'daily', 'gursha_order_shortcode');
        }
    }
    // public function display_html_file()
    // {


    //     $current_time = time();
    //     $interval = floor(($current_time % (2 * 60 * 2)) / 60);
    //     $file_path = '';

    //     if ($interval == 0 || $interval == 1) {
    //         $file_path = __DIR__ . '/../partials/order/food.php';
    //     } else {
    //         $file_path = __DIR__ . '/../partials/order/index.php';
    //     }

    //     if (!empty($file_path) && file_exists($file_path)) {
    //         wp_enqueue_style('gursha_style', __DIR__ . '/../css/gursha_food_list_style.css', array(), '1.0');
    //         include $file_path;
    //     } else {
    //         echo 'PHP file not found.';
    //     }

    // }


}