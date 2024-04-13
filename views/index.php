<?php
require_once __DIR__ ."/_header.php";

$db = _db();
$sql = $db->prepare('SELECT * FROM products');
$sql->execute();
$products = $sql->fetchAll();
?>
<main>
  <?php foreach($products as $product):?>
    
    <div class="flex flex-col items-center w-full">
    <form onsubmit="place_order(); return false" class="flex items-center justify-between gap-2 mb-4 bg-slate-700 py-6 px-4 w-1/2">
      <div class="w-1/12">Nr. <?= $product['product_id'] ?></div>
      <div class="w-1/5"><?= $product['product_name'] ?></div>
      <div class="w-1/5"><?= $product['product_price'] ?> kr.</div>

      <input type="hidden" name="product_id" id="" value="<?= $product['product_id'] ?>">
      <input type="hidden" name="product_name" id="" value="<?= $product['product_name'] ?>">
      <input type="hidden" name="product_price" id="" value="<?= $product['product_price'] ?>">

   <!-- Order a product button -->     
    <button
         class="order-product-button bg-slate-900 text-white py-2 rounded-full w-1/4"
         type="submit"
          data-product-id="<?= $product['product_id'] ?>"
          data-product-name="<?= $product['product_name'] ?>"
          data-product-price="<?= $product['product_price'] ?>">
        Order product
    </button>
    </form>
    </div>
    
  <?php endforeach?>
</main>
 
<?php require_once __DIR__ ."/_footer.php"?>