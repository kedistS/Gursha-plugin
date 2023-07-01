<table>
    <tr>
        <th>Username</th>
        <th>Food item</th>
        <th>Quantity</th>
        <th>date</th>
    </tr>   
    <tbody>
        <td><?php echo $user_data->user_login?></td>
        <td><?php echo $order_lists['food_quantity']?></td>
        <td><?php echo $order_lists['food_item']?></td>
        <td><?php echo human_time_diff($order_lists['ordered_at']). ' ago.'?></td>
    </tbody>

</table>