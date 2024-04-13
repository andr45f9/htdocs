<?php
require_once __DIR__.'/_header.php';

// 1. Check if the user is admin, if not call the function redirect_based_on_role()
if (!_is_admin()) {
  redirect_based_on_role();
}
 
// 2. Get the admins info (used to display a welcoming H1)
$user_id = $_SESSION['user']['user_id'];
$user = $_SESSION['user'];
 
// 3. Connect to the databse 
$db = _db();

// 4. Prepare different queries to get all the information the admin should be able to see
//Prepare query to get all users
$queryUsers = $db->prepare('SELECT * FROM users');
$queryUsers->execute();
$users = $queryUsers->fetchAll();
 
//Prepare query to get all orders
$queryOrders = $db->prepare('SELECT * FROM orders');
$queryOrders->execute();
$orders = $queryOrders->fetchAll();
 
//Prepare query to get all products
$queryProducts = $db->prepare('SELECT * FROM products');
$queryProducts->execute();
$products = $queryProducts->fetchAll();
 
//Prepare query to get all roles
$queryRoles = $db->prepare('SELECT * FROM roles');
$queryRoles->execute();
$roles = $queryRoles->fetchAll();
 
 
#### ADMIN SEARCH ####
// 5. Store the api-search-admin page inside a variable
$frm_search_admin_url = 'api-search-admin.php';
// 6. Include the component _form_search_admin once
include_once __DIR__.'/_form_search_admin.php'
?>
 
<main class="w-full px-8 md:px-12 lg:px-44 text-lg">
  <h1 class="text-6xl pb-4 mb-6 text-white font-bold">Welcome <?= $user['user_role_name'] ?> <?= $user['user_name'] ?></h1>
 
  <h2 class="text-2xl text-slate-900 font-bold mb-2">All users</h2>
  <div class="user-info-wrapper mb-8 bg-slate-400 p-2 text-slate-900">

<!-- LOOP THROUGH ALL USERS -->
  <?php foreach($users as $user):?>
    <div class="flex w-full pt-4 p-2 border-b border-slate-500">
      <div class="w-1/12"><?= $user['user_id'] ?></div>
      <div class="w-1/6"><?= $user['user_name'] ?></div>
      <div class="w-1/6"><?= $user['user_last_name'] ?></div>
      <div class="w-1/6"><?= $user['user_role_name'] ?></div>
      <div class="w-1/6"><?= $user['user_address'] ?></div>

<!-- BLOCK USER BUTTON -->
<!-- 1 = Not blocked, 0 = blocked -->
    <button class="bg-slate-900 text-white px-0.5 w-1/12 mr-8 border-2 border-slate-500"
    data-user-id="<?= $user['user_id'] ?>"
    data-user-is-blocked="<?= $user['user_is_blocked'] ?>"
    onclick="toggle_blocked(event)">
    <?= $user['user_is_blocked'] === 0 ? "unblock" : "block" ?>
    </button>

<!-- DELETE USER BUTTON -->
    <form onsubmit="delete_user(); return false">
      <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
      <button class="w-full">
        🗑️ Delete user
      </button>
    </form>
    </div>
  <?php endforeach?>
</div>

<!-- ALL ORDERS IN THE SYSTEM -->
<h2 class="text-2xl text-slate-900 font-bold mb-2">All orders</h2>
<div class="user-info-wrapper mb-8 bg-slate-400 p-2 text-slate-900">
    <?php foreach($orders as $order):?>
    <div class="flex w-full pt-4 p-2 border-b border-slate-500">
      <div class="w-1/12"><?= $order['order_id'] ?></div>
      <div class="w-1/5"><?= $order['user_id_fk'] ?></div>
      <div class="w-1/5"><?= $order['product_id_fk'] ?></div>
      <div class="w-1/5"><?= $order['order_created_at'] ?></div>
      <div class="w-1/5"><?= $order['order_delivered_at'] ?></div>
      <div class="w-1/5"><?= $order['order_picked_up_at'] ?></div>
    </div>
  <?php endforeach?>
</div>
 
<!-- ALL PRODCUTS IN THE SYSTEM --> 
<h2 class="text-2xl text-slate-900 font-bold mb-2">All products available</h2>
<div class="user-info-wrapper mb-8 bg-slate-400 p-2 text-slate-900">
    <?php foreach($products as $product):?>
    <div class="flex w-full pt-4 p-2 border-b border-slate-500">
     <div class="w-1/12">Nr. <?= $product['product_id'] ?></div>
      <div class="w-1/5"><?= $product['product_name'] ?></div>
      <div class="w-1/5"><?= $product['product_price'] ?> kr.</div>
    </div>
  <?php endforeach?>
</div>
 
<!-- ALL ROLES IN THE SYSTEM -->
<h2 class="text-2xl text-slate-900 font-bold mb-2">All roles in the system</h2>
<div class="user-info-wrapper mb-8 bg-slate-400 p-2 text-slate-900">
    <?php foreach($roles as $role):?>
    <div class="flex w-full pt-4 p-2 border-b border-slate-500">
     <div class="w-1/12"><?= $role['role_id'] ?></div>
      <div class="w-1/5"><?= $role['role_name'] ?></div>
    </div>
  <?php endforeach?>
</div>
 
</main>
 
<?php require_once __DIR__.'/_footer.php'  ?>