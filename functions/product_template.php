<div class="productt">
  <a href="each_product_view.php?product=<?= $items["incremented_name"];?>&page_name=shop_all">
    <div class="image_container2"><img src="admin/uploads/<?= $items["image_1"]; ?>" alt="<?= $items["product_name"]; ?>"></div>
    <p class="product-name1"><?= $items["product_name"]; ?></p>
  </a>
  <?php
    if($items["quantitty"] != 0){
      ?>
      <span class="product-price1">R<?= $items["price"]; ?>.00</span>
      <form action="functions/handle_cart.php" method="post">
        <input type="hidden" value="1" name="quantity" id="quantity" min="1">
        <input type="hidden" name="stock_qty" value="<?= $items["quantitty"]; ?>">
        <input type="hidden"  name="product_id" value="<?=$items["id"];?>">
        <input type="hidden"  name="SKU" value="<?=$items["incremented_name"];?>">
        <input type="hidden"  name="page" value="shop_all">
        <button class="add-to-cart" type="submit" name="add_to_cart-btn" data-product-id="<?= $items["id"]; ?>">Add to Cart</button>
      </form>
      <?php
    }else{
      ?>
      <span class="old-price">Out of Stock</span>
      <button class="add-to-cart" disabled data-product-id="<?= $items["id"]; ?>">Maybe Next Time</button>
      <?php
    }
    ?>
</div>