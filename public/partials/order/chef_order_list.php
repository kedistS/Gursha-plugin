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
        <th>order status</th>
    </tr>  
    <?php 
    foreach($user_orders as $order){ ?>
    <tbody>
        <td><?php echo $order_user_data->user_login?></td>
        <td><?php echo $order['food_item']?></td>
        <td><?php echo $order['food_quantity']?></td>
        <td><?php echo human_time_diff($order['ordered_at']). ' ago.'?></td>
        <td>
            <form>
                <select class="status-opetion" name="" id="">
                    <label for="status-opetion">Food menu</label>
                        <option value="pending">pending</option>
                        <option value="delivered">delivered</option>
                        <option value="declined">declined</option>
                </select>
                <button class="gursha-submit-status">Submit</button>
            </form>
        </td>
    </tbody>
    <?php } ?>

</table>
<?php } }?>

<script>
    var ajaxurl2 = "<?php echo admin_url('admin-ajax.php')?>"
    orderStatus = document.querySelector('.status-opetion')
    statusBtn = document.querySelector('.gursha-submit-status')

    statusBtn.addEventListener('click', function(e){
        e.preventDefault()



        jQuery.ajax({
            url:ajaxurl2,
            type: 'POST',
            data:{
                action: 'gursha_save_order_status',
                order_status: orderStatus.value,
            },
            success: function(sdfasdf){
                alert("status changed successfully");
            },
            error: function(response){
                alert("status change failed");
            }
        })
    })
</script>