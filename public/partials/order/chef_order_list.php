<style>
    .card-blog-post{
        width: fit-content !important;
    }
</style>
<?php
foreach($users as $user_id){
    $user_orders  = get_user_meta($user_id, 'gursha_orders',true);
    $order_user_data = get_user_by('id',$user_id);

    if(is_array($user_orders)){
    ?>
<table>
    <tr>
        <th>Username</th>
        <th>Bill Id</th>
        <th>Food item</th>
        <th>Quantity</th>
        <th>date</th>
        <th>Choose status</th>
        <th>Action</th>
        <th>order status</th>
    </tr>  
    <?php 
    foreach($user_orders as $order){ ?>
    <tbody>
        <td><?php echo $order_user_data->user_login?></td>
        <td ><?php echo isset($order['bill_id']) ? $order['bill_id'] : ''?></td>
        <td><?php echo $order['food_item']?></td>
        <td><?php echo $order['food_quantity']?></td>
        <td><?php echo human_time_diff($order['ordered_at']). ' ago.'?></td>
       
        <td>
            <select class="status-opetion" name="" id="<?php echo $order['bill_id'] ?>">
                <label for="status-opetion">Food menu</label>
                <option value="pending">pending</option>
                <option value="delivered">delivered</option>
                <option value="declined">declined</option>
            </select>
        </td>
        <td>
        <button class="gursha-submit-status" data-user-id="<?php echo $user_id?>" data-bill-id="<?php echo isset($order['bill_id']) ? $order['bill_id'] : ''?>" >Submit</button>
        </td>
            <td id="status-<?php echo  $order['bill_id']?>"><?php echo $order['order_status']?></td>

    </tbody>
    <?php } ?>

</table>
<?php } }?>

<script>
    var ajaxurl2 = "<?php echo admin_url('admin-ajax.php')?>"
    const statusBtn = document.querySelectorAll('.gursha-submit-status')
    statusBtn.forEach(element=>{
        element.addEventListener('click', function(e){
            e.preventDefault()
            const userId = element.getAttribute('data-user-id')
            const billId = element.getAttribute('data-bill-id')
            const orderStatus = document.getElementById(billId)
            
            jQuery.ajax({
                url:ajaxurl2,
                type: 'POST',
                data:{
                    action: 'gursha_save_order_status',
                    updated_order_status: orderStatus.value,
                    userId,billId
                },
                beforeSend: function(data){
                    element.innerHTML = "Updating...";
                },
                success: function(response){
                    const data = JSON.parse(response)
                    const currentStatus = document.getElementById(`status-${billId}`)
                    currentStatus.innerHTML = data.message
                    element.innerHTML = "Submit";                    
                },
                error: function(response){
                    alert("status change failed");
                }
            })
        })
})
</script>