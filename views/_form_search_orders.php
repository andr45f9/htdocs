<!-- 
The attribute data-url has the api-search-won-orders as it's value.

The method is GET because we need to get the matchin results from the api.

The name of the input field is query!

oninput() we call the search_own_orders() function in app.js

 -->
<form data-url="<?= $frm_search_url_orders ?>" id="frm_search_own_orders" onsubmit="return false" method="GET" class="relative flex items-center w-1/3 ml-auto mb-6 mr-8 text-slate-500">
  <input name="query" type="text" id="search-field"
  class="w-full pl-2 bg-stone-100 rounded-sm shadow-md p-1 border border-blue-200"
  placeholder="<?= ($_SESSION['user']['user_role_name'] === 'customer') ? 'Search by User ID' : 'Search by Order ID' ?>"
  oninput="search_own_orders()"
  onfocus="document.querySelector('#query_results').classList.remove('hidden')"
  onblur="document.querySelector('#query_results').classList.add('hidden')"
  >
  <div id="query_results"
  class="hidden absolute top-full w-full h-48  border
  border-blue-200 bg-stone-200 overflow-hidden overflow-y-visible">        
  </div>
</form>