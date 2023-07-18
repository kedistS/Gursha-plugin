<div class="form-input">
    <label for=""></label>
</div>

<form>
    <div class="form-input">
        <label for="food-item">Food menu</label>
        <select class="food-item" name="" id="">
            <option value="ክትፎ">ክትፎ</option>
            <option value="ጥብስ">ጥብስ</option>
            <option value="ጥብስ ፍርፍር">ጥብስ ፍርፍር</option>
            <option value="በያይነት">በያይነት</option>
        </select>
    </div>
    <div class="form-input">
        <label for="foodQuantity">Quantity</label>
        <input type="number" name="" min="1" id="foodQuantity">
    </div>
    <div class="submit-order">
        <button class="gursha-submit-order">Submit</button>
    </div>
</form>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php')?>"
    foodItem = document.querySelector('.food-item')
    foodQuantity = document.getElementById('foodQuantity')
    orderBtn = document.querySelector('.gursha-submit-order')

    orderBtn.addEventListener('click', function(e){
        e.preventDefault()
        // console.log('food item',foodItem.value)
        // console.log('food quantity',foodQuantity.value)

        jQuery.ajax({
            url:ajaxurl,
            type: 'POST',
            data:{
                action: 'gursha_save_orders',
                food_item: foodItem.value,
                food_quantity: foodQuantity.value
            },
            success: function(sdfasdf){
                alert("Ordered successfully");
            },
            error: function(response){
                alert("order failed");
            }
        })
    })
</script>