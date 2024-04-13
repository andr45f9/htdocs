<?php require_once __DIR__ ."/_header.php"?>

<main class="flex flex-col gap-4 mg:w-1/3 lg:w-1/3 w-full h-full m-auto p-12 text-lg">
    <h1 class="text-4xl pb-4 text-white">Sign Up</h1>

   <form onsubmit="validate(signup); return false" class="flex flex-col gap-2">
      <div class="flex flex-col" >
         <label class="text-slate-300" for="user_name">Your name must be min <?= USER_NAME_MIN?> max <?= USER_NAME_MAX?></label>
         <input class="p-2 bg-slate-700 text-slate-200" id="user_name"  type="text" name="user_name" data-validate="str" data-min="<?= USER_NAME_MIN?>" data-max="<?= USER_NAME_MAX?>">
      </div>
      <div class="flex flex-col" >
         <label class="text-slate-300" for="user_last_name">Your last name must be min <?= USER_LAST_NAME_MIN?> max <?= USER_LAST_NAME_MAX?></label>
         <input class="p-2 bg-slate-700 text-slate-200" id="user_last_name"  type="text" name="user_last_name" data-validate="str" data-min="<?= USER_LAST_NAME_MIN?>" data-max="<?= USER_LAST_NAME_MAX?>">
      </div>
      <div class="flex flex-col">
         <label class="text-slate-300" for="user_email">Your email</label>
         <input  class="p-2 bg-slate-700 text-slate-200" id="user_email" type="text" name="user_email" data-validate="email" >
      </div>
      <div class="flex flex-col">
         <label class="text-slate-300" for="user_password">Your password must be <?= USER_PASSWORD_MIN?> max <?= USER_PASSWORD_MAX?></label>
         <input class="p-2 bg-slate-700 text-slate-200" id="user_password"  type="text" name="user_password" data-validate="str" data-min="<?= USER_LAST_NAME_MIN?>" data-max="<?= USER_LAST_NAME_MAX?>">
      </div>
      <div class="flex flex-col">
         <label class="text-slate-300" for="user_confirm_password">Confirm password </label>
         <input class="p-2 bg-slate-700 text-slate-200" id="user_confirm_password"  type="text" name="user_confirm_password" data-validate="match" data-match-name="user_password">
      </div>

      <button class="bg-slate-900 text-white p-2 rounded-full mt-2">Signup</button>
   </form>
</main>

<?php require_once __DIR__ ."/_footer.php"?>