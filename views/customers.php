<?php
require_once __DIR__ ."/_header.php";

// 1. Get the customers info (used to display a welcoming H1)
$user_id = $_SESSION['user']['user_id'];
$user = $_SESSION['user'];

// 2. Connect to the databse 
$db = _db();

// 3. Prepare a SQL query to get the one user
$q = $db->prepare('SELECT * FROM users WHERE user_id = :user_id');
$q->bindValue(':user_id', $user_id);
$q->execute();
$user = $q->fetch();

// 4. Prepare a SQL query to get that one users orders
$queryUsersOrders = $db->prepare('SELECT * FROM orders WHERE user_id_fk = :user_id');
$queryUsersOrders->bindValue(':user_id', $user_id);
$queryUsersOrders->execute();
$orders = $queryUsersOrders->fetchAll();

#### SEARCH FOR OWN ORDER ####
// 5. Store the api url inside a variable
$frm_search_url_orders = 'api-search-own-orders.php';
// 6. Include once the component file _form_search_orders.php
include_once __DIR__.'/_form_search_orders.php'
?>

<main class="w-full p-12 text-lg">
      <h1 class="text-6xl pb-4 text-white font-bold">Welcome <?= $user['user_role_name'] ?> <?= $user['user_name'] ?></h1>
     
      <!-- DELETE YOUR USER -->
      <form onsubmit="delete_user(); return false" class="mb-6">
         <input class="hidden" name="user_id" type="text" value="<?= $user['user_id'] ?>">
         <button class="text-white py-2 px-4 font-bold">
            🗑️ Delete profile 
         </button>
      </form>

<div class="flex gap-4 justify-between items-start">
   <div>
      <h2 class="text-2xl pb-4 text-slate-900 font-bold">Profile Information</h2>
      <div class=" bg-slate-700 p-4 w-80">
         <p><strong>ID:</strong> <?= $user['user_id'] ?></p>
         <p><strong>Name:</strong> <?= $user['user_name'] ?></p>
         <p><strong>Last Name:</strong> <?= $user['user_last_name'] ?></p>
         <p><strong>E-mail:</strong> <?= $user['user_email'] ?></p>
         <p><strong>Role:</strong> <?= $user['user_role_name'] ?></p>
         <p><strong>Address:</strong> <?= $user['user_address'] ?></p>
      </div>
   </div>

   <div class="w-2/5">
      <h2 class="text-2xl pb-4 text-slate-900 font-bold">Update Your Profile Information</h2>
      <form class="pb-4" onsubmit="validate(update_user); return false">
         <div class="flex flex-col pb-2" >
            <label  class="text-slate-300" for="user_name">Your name must be min <?= USER_NAME_MIN?> max <?= USER_NAME_MAX?></label>
            <input class="p-2 bg-slate-700 text-white" id="user_name"  type="text" name="user_name" data-validate="str" data-min="<?= USER_NAME_MIN?>" data-max="<?= USER_NAME_MAX?>" value="<?= $user['user_name'] ?>">
         </div>
         <div class="flex flex-col pb-2" >
            <label class="text-slate-300" for="user_last_name">Your last name must be min <?= USER_LAST_NAME_MIN?> max <?= USER_LAST_NAME_MAX?></label>
            <input class="p-2 bg-slate-700 text-white" id="user_last_name"  type="text" name="user_last_name" data-validate="str" data-min="<?= USER_LAST_NAME_MIN?>" data-max="<?= USER_LAST_NAME_MAX?>" value="<?= $user['user_last_name'] ?>">
         </div>
         <div class="flex flex-col pb-2">
            <label class="text-slate-300" for="user_email">Your email</label>
            <input class="p-2 bg-slate-700 text-white" id="user_email" type="text" name="user_email" data-validate="email" value="<?= $user['user_email'] ?>">
         </div>
         <div class="flex flex-col">
            <label class="text-slate-300" for="user_address">Your address must be <?= USER_ADDRESS_MIN?> max <?= USER_ADDRESS_MAX?></label>
            <input class="p-2 bg-slate-700 text-white" id="user_address" type="text" name="user_address" data-validate="str" value="<?= $user['user_address'] ?>" >
         </div>

         <!-- UPDATE YOUR USER INFORMATION -->
         <button class="bg-slate-900 text-white py-2 rounded-full w-full mt-4">Update Profile</button>
      </form>
   </div>
</div>

 <div class="flex flex-col items-start w-full mt-4">
 <h2 class="text-2xl pb-4 text-slate-900 font-bold">View all your orders</h2>
  <?php foreach($orders as $order):?>
  <div class="flex items-center justify-between gap-2 mb-4 bg-slate-700 py-6 px-4 w-1/2">
      <div class="w-2/5">Order ID: <?= $order['order_id'] ?></div>
      <div class="w-3/5">Created at: <?= $order['order_created_at'] ?></div>
  </div>
  <?php endforeach?>
 </div>
</main>

<?php require_once __DIR__ ."/_footer.php"?>
 
