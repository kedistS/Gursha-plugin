<?php 
class Gursha_role{
    function xx__update_custom_roles() {
        if ( get_option( 'chef_version' ) < 1 ) {
            add_role( 'chef_role', 'Chef', array( 'read' => true, 'level_0' => true ) );
            update_option( 'chef_version', 1 );
        }
    }
    
}
?>