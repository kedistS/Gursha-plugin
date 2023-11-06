<div class="order-input">
    <div class="form-input">
        <label for="food-item">Food menu</label>
        <select class="food-item" name="" id="">
            <?php if ($lunch) { ?>
                <option value="ክትፎ">ክትፎ</option>
                <option value="ጥብስ">ጥብስ</option>
                <option value="ጥብስ ፍርፍር">ጥብስ ፍርፍር</option>
                <option value="በያይነት">በያይነት</option>
            <?php } else { ?>
                <option value="ፉል">ፉል</option>
                <option value="ፍርፍር">ፍርፍር</option>
            <?php } ?>
        </select>
    </div>
    <div class="form-input">
        <label for="foodQuantity">Quantity</label>
        <input type="number" name="" min="1" id="foodQuantity" required>
    </div>
    <div class="customer-info">

        <h2 class="customer-info-header">Billing Information</h2>
        <div class="customer-info-item">
            <label for="customer-first-name">First Name</label>
            <input type="text" id="customer-first-name"
                value="<?php echo isset($customer_info[0]['first_name']) ? $customer_info[0]['first_name'] : '' ?>">
        </div>
        <div class="customer-info-item">
            <label for="customer-last-name">Last Name</label>
            <input type="text" id="customer-last-name"
                value="<?php echo isset($customer_info[0]['last_name']) ? $customer_info[0]['last_name'] : '' ?>">
        </div>
        <div class="customer-info-item">
            <label for="email">Email</label>
            <input type="text" id="email"
                value="<?php echo isset($customer_info[0]['email']) ? $customer_info[0]['email'] : '' ?>">
        </div>
        <div class="customer-info-item">
            <label for="town">Town/City</label>
            <input type="text" id="town"
                value="<?php echo isset($customer_info[0]['city']) ? $customer_info[0]['city'] : '' ?>">
        </div>
        <div class="customer-info-item">
            <label for="street">Street Address</label>
            <input type="text" id="street"
                value="<?php echo isset($customer_info[0]['street']) ? $customer_info[0]['street'] : '' ?>">
        </div>
    </div>
    <div class="submit-order">
        <button class="gursha-submit-order">Submit</button>
    </div>
</div>

<?php $order_status = 'pending' ?>

<script>
    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>"
    var foodItem = document.querySelector('.food-item')
    var foodQuantity = document.getElementById('foodQuantity')
    var customerFirstName = document.getElementById('customer-first-name')
    var customerLastName = document.getElementById('customer-last-name')
    var customerEmail = document.getElementById('email')
    var customerCity = document.getElementById('town')
    var customerStreet = document.getElementById('street')
    var orderBtn = document.querySelector('.gursha-submit-order')

    orderBtn.addEventListener('click', function (e) {
        if (foodQuantity.value.length === 0 || foodQuantity.value <= 0) {
            event.preventDefault();
            alert("Please enter correct quantity value");
        } else {

            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'gursha_save_orders',
                    food_item: foodItem.value,
                    food_quantity: foodQuantity.value,
                    first_name: customerFirstName.value,
                    last_name: customerLastName.value,
                    email: customerEmail.value,
                    city: customerCity.value,
                    street: customerStreet.value
                },
                success: function (sdfasdf) {
                    alert("Ordered successfully");
                },
                error: function (response) {
                    alert("order failed");
                }
            })
        }
    })
</script>