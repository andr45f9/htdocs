<!-- setting the data attribute data-url to be the variable $frm_search_admin_url
    which in the admin page is storing the api-search-admin api/page. 

    Using a GET method, to get all the information from the database.

    Name of the input field is query, which we use to match the characters the user adds in the
    inputfield to what information there is in the database.

    oninput we call the search_data() function in app.js
 -->
<form data-url="<?= $frm_search_admin_url ?>" id="frm_search" onsubmit="return false" method="GET" class="relative flex items-center w-1/3 ml-auto mb-6 mr-8 text-slate-500">
  <input name="query" type="text" id="search-field"
    class="w-full pl-2 bg-stone-100 rounded-sm shadow-md p-1 border border-blue-200"
    placeholder="Search in the system"
    oninput="search_data()"
    onfocus="document.querySelector('#query_results').classList.remove('hidden')"
    onblur="document.querySelector('#query_results').classList.add('hidden')"
  >
  <div id="query_results"
    class="hidden absolute top-full w-full h-48 border
    border-blue-200 bg-stone-200 overflow-hidden overflow-y-visible">        
  </div>
</form>