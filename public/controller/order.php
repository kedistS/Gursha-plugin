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
        // update_user_meta(get_current_user_id(), 'gursha_orders','chicken');
        // global $wp_roles;
        // print_r($wp_roles);
        //wp_enqueue_script('trial', gursha_PLAGIN_URL . 'public/js/try.js', array('jquery'), '1.0', true);
        include gursha_PLAGIN_DIR . 'public/partials/order/index.php';
    }
    public function gursha_order_list(){
    //     $users = get_users( array( 'fields' => array( 'ID' ) ) );
    //     foreach($users as $user){
    //     print_r(get_user_meta ( $user->ID));
    // }

    $user_data = wp_get_current_user();
    $value = $user_data->roles;
    if(in_array('chef_role', $value)){
        $users = get_users(array('fields' => 'ids'));
        include gursha_PLAGIN_DIR . 'public/partials/order/chef_order_list.php';
    }else{
            $order_lists = get_user_meta(get_current_user_id(), 'gursha_orders',true);
            include gursha_PLAGIN_DIR . 'public/partials/order/order-list.php';
            
        }

    }
    public function gursha_food_list(){
        include gursha_PLAGIN_DIR . 'public/partials/order/food.php';
    }

    public function wp_ajax_gursha_save_orders(){
        $previous_order = get_user_meta(get_current_user_id(), 'gursha_orders', true);
        // $previous_order[] = array(
        //     'food_quantity' => $_POST['food_quantity'],  
        //     'food_item' => $_POST['food_item'] ,
        //     'ordered_at' => time() ,
        // );
        if(!is_array($previous_order))
            $previous_order = array();
        array_push($previous_order, 
            array(
                'food_quantity' => $_POST['food_quantity'],  
                'food_item' => $_POST['food_item'] ,
                'ordered_at' => time() ,
            )
        );
        update_user_meta(get_current_user_id(), 'gursha_orders', $previous_order);

        print_r(get_user_meta(get_current_user_id(), 'gursha_orders', true));
        // update_user_meta(get_current_user_id(), 'gursha_orders',$new_order);
        die();
    }
    
    

}