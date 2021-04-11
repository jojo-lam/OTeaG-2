<?php $cart_product = fetchProduct();

// echo var_dump($cart_product);

?>


<div class="cartItem">
  <div class="cartItemImageWrapper">
    <img src="<?php echo $cart_product['image_link'];?>" class=cartImage>
  </div>

  <div class="itemPrice">
    <div class="cartItemName">
      <?php echo $cart_product['name']; ?>    
    </div>
    <br>
    <div class="cartItemPrice">
      Price: $<?php echo $cart_product['price']; ?> 
    </div>

    <div class="cartItemQuantity">
    Quantity: <?php echo $cart_product['bags']; ?>
    </div>
  </div>
</div>
