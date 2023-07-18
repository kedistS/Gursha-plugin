<?php 
if(is_array($order_lists)){ ?>
<table>
    <tr>
        <th>Username</th>
        <th>Food item</th>
        <th>Quantity</th>
        <th>date</th>
    </tr>  
    <?php 
    foreach($order_lists as $order){ ?>
    <tbody>
        <td><?php echo $user_data->user_login?></td>
        <td><?php echo $order['food_item']?></td>
        <td><?php echo $order['food_quantity']?></td>
        <td><?php echo human_time_diff($order['ordered_at']). ' ago.'?></td>
    </tbody>
    <?php } ?>

</table>
<?php } ?>