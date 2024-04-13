<?php require_once __DIR__.'/_header.php'?>
 
<main class="flex flex-col gap-4 mg:w-1/3 lg:w-1/3 w-full h-full m-auto p-12 text-lg">
<h1 class="text-4xl pb-4 text-white">Login</h1>
  <form  onsubmit="validate(login); return false" class="flex flex-col gap-2">
    <div class="flex flex-col">
      <label class="text-slate-300" for="user_name" for="">email</label>    
      <input class="p-2 bg-slate-700 text-slate-200" name="user_email" type="text"
      data-validate="email">
    </div>
 
    <div class="flex flex-col">
      <label class="text-slate-300" for="user_name" for="">user password mix <?= USER_PASSWORD_MIN ?> max <?= USER_PASSWORD_MAX ?></label>    
      <input class="p-2 bg-slate-700 text-slate-200"  name="user_password" type="text"
      data-validate="str" data-min="<?= USER_PASSWORD_MIN ?>" data-max="<?= USER_PASSWORD_MAX ?>"
      class="">
    </div>
 
    <button class="bg-slate-900 text-white p-2 rounded-full mt-2">Login</button>
  </form>
  
</main>
 
<?php require_once __DIR__.'/_footer.php'  ?>