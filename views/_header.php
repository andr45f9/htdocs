<?php require_once __DIR__ ."/../_.php"?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/app.css">
</head>
 
<header class="bg-slate-800 text-white text-xl flex justify-between items-center py-4 px-6">
  <div class="font-bold text-4xl">FOOD</div>
    <nav class="flex gap-4 justify-end items-center">
      
      <!-- HEADER FOR CUSTOMER -->
      <?php if( _is_user_customer() ): ?>
        <div class="flex gap-4">
          <a href="/views/customers.php">Profile</a>
          <a href="/views/index.php">Shop</a>
        </div>
      <?php endif ?>

      <!-- HEADER FOR PARTNER -->
      <?php if( _is_user_partner() ): ?>
        <div class="flex gap-4">
          <a href="/views/partners.php">Profile</a>
          <a href="/views/index.php">Shop</a>
        </div>
      <?php endif ?>

    <!-- HEADER FOR EMPLOYEE -->
      <?php if( _is_user_employee() ): ?>
        <div class="flex gap-4">
          <a href="/views/employees.php">Profile</a>
          <a href="/views/index.php">Shop</a>
        </div>
      <?php endif ?>

    <!-- HEADER FOR ADMIN -->
      <?php if( _is_user_admin() ): ?>
        <div class="flex gap-4">
          <a href="/views/admin.php">Profile</a>
          <a href="/views/index.php">Shop</a>
        </div>
      <?php endif ?>

    <!-- SIGNUP, LOGIN & LOGOUT FOR ALL -->
      <?php if( ! isset($_SESSION['user']) ): ?>
        <div class="flex gap-4">
          <a class="bg-slate-900 px-6 py-0.5 border-2 border-slate-500" href="/views/login.php">Login</a>
          <a class="bg-slate-900 px-6 py-0.5 border-2 border-slate-500" href="/views/signup.php">Signup</a>
        </div>
        
      <?php else: ?>
        <a class="bg-slate-900 px-6 py-0.5 border-2 border-slate-500" href="/views/logout.php">Logout</a>
      <?php endif ?>  
    </nav>
</header>
<body class="bg-slate-600 text-slate-100">