<div class="form-input">
    <label for=""></label>
</div>

<form>
    <div class="form-input">
        <label for="food-item">Food menu</label>
        <select class="food-item" name="" id="">
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
        </select>
    </div>
    <div class="form-input">
        <label for="food-quenatity">Quantity</label>
        <input type="number" name="" id="foodQuantity">
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
        console.log('food item',foodItem.value)
        console.log('food quantity',foodQuantity.value)

    })
</script>