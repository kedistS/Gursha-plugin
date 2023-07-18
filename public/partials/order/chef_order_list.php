<?php
foreach($users as $user_id){
    $user_orders  = get_user_meta($user_id, 'gursha_orders',true);
    $order_user_data = get_user_by('id',$user_id);

    if(is_array($user_orders)){
    ?>
<table>
    <tr>
        <th>Username</th>
        <th>Food item</th>
        <th>Quantity</th>
        <th>date</th>
    </tr>  
    <?php 
    foreach($user_orders as $order){ ?>
    <tbody>
        <td><?php echo $order_user_data->user_login?></td>
        <td><?php echo $order['food_item']?></td>
        <td><?php echo $order['food_quantity']?></td>
        <td><?php echo human_time_diff($order['ordered_at']). ' ago.'?></td>
    </tbody>
    <?php } ?>

</table>
<?php } }?>