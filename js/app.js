// ########################## CLEAR SEARCH_ORDERS RESULTS - ADMIN  ##########################
// related to the function search_orders
// Clears the query_results to begin with

// Get the search field
const searchInput = document.querySelector("#search-field");
// Get the search results
const queryResults = document.querySelector("#query_results");

// Clear the results box
function clearQueryResults() {
  queryResults.innerHTML = "";
}

// clear the search input
function clearSearchInput() {
  searchInput.value = "";
}

// Add eventListener to the input field, and clear the result everytime there is clicked on the input
searchInput.addEventListener("click", clearQueryResults);

// Add an eventlistener to the document
document.addEventListener("click", function (event) {
  // Then control/check if the click happened inside the input field
  if (!searchInput.contains(event.target)) {
    clearSearchInput();
  }
});

// ########################## SIGNUP USER ##########################
async function signup() {
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("/api/api-signup.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  }

  location.href = "/views/login.php";
}

// ########################## LOGIN USER ##########################
async function login() {
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("/api/api-login.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  }
  location.href = "/views/admin.php";
}

// ########################## UPDATE USER  ##########################
async function update_user() {
  const frm = event.target;
  console.log(frm);
  const conn = await fetch("/api/api-update-user.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);
  location.reload();
}

// ########################## DELETE USER ##########################
async function delete_user() {
  // Get the form
  const frm = event.target;
  console.log(frm);

  // Make a asynchronous post request to the api
  const conn = await fetch("/api/api-delete-user.php", {
    method: "POST",
    body: new FormData(frm),
  });
  const response = await conn.text();
  console.log(response);

  // Remove the forms parent element
  // For customer, employee and partner the parent element will be the whole main tag. Deleting the whole page
  // For the admin, it will just be the one div rapping around one user
  frm.parentElement.remove();
}

// ########################## TOGGLE BLOCKED USER ##########################
//New toggle_blocked function where we use data attributes instead of attaching as parameters
async function toggle_blocked(event) {
  // Get the button, which in this case is send as a parameter "event"
  const button = event.currentTarget;
  // Get the user id from the attribute
  const user_id = button.dataset.userId;
  // Get the current status of the user blocked
  let user_is_blocked = button.dataset.userIsBlocked;

  // Toggle user_is_blocked status between 1 and 0 with a ternary opreator
  // 1 = not blocked
  // 0 = blocked
  user_is_blocked = user_is_blocked === "0" ? "1" : "0";

  // Send a request to the api with the updated status, using the user id and then status of user is blocked
  const conn = await fetch(`/api/api-toggle-user-blocked.php?user_id=${user_id}&user_is_blocked=${user_is_blocked}`);

  if (conn.ok) {
    // If the request was sucessfull - the click on the block button went through
    //Update the data attribute with the user_is_blocked status
    button.dataset.userIsBlocked = user_is_blocked;

    //Update button text according to user_is_blocked status
    button.innerHTML = user_is_blocked === "0" ? "unblock" : "block";

    const data = await conn.text();
    console.log(data);
  } else {
    //if request fails, go back to the previous status of the user_is_blocked
    user_is_blocked = user_is_blocked === "1" ? "0" : "1";
    //Output: console log to confirm that the status failed to change
    console.log("Status did not change - user_is_blocked has the same status as before", user_is_blocked);
  }
}

// ########################## PLACE ORDER ##########################
async function place_order() {
  // Get the form
  const frm = event.target;
  console.log(frm, event);

  // Send a asynchronous POST request to the api
  const conn = await fetch("/api/api-place-order.php", {
    method: "POST",
    body: new FormData(frm),
  });

  const data = await conn.text();
  console.log(data);

  // Succesfull pop up with confirmation of your order
  Swal.fire({
    position: "center",
    icon: "success",
    title: "Your order is placed!",
    showConfirmButton: false,
    timer: 1500,
  });

  // Unsuccesfull pop up with error message
  if (!conn.ok) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
      footer: '<a href="">Why do I have this issue?</a>',
    });
    return;
  }
}

// ########################## ORDER PICKED UP ##########################
async function set_order_as_picked_up() {
  // Get the form
  const setOrderAsPendingForm = event.target;
  console.log(setOrderAsPendingForm);

  // Send a asynchronous POST request to the api
  const conn = await fetch("/api/api-set-pending-order.php", {
    method: "POST",
    body: new FormData(setOrderAsPendingForm),
  });
  const response = await conn.text();
  console.log(response);

  // Reload the current page to see the changes imediatly
  location.reload();
}

// ########################## ORDER DILEVERED - EMPLOYEE ##########################
async function set_order_as_delivered() {
  // Get the form
  const setOrderAsDeliveredForm = event.target;
  console.log(setOrderAsDeliveredForm);

  // Send a asynchronous POST request to the api
  const conn = await fetch("/api/api-set-delivered-order.php", {
    method: "POST",
    body: new FormData(setOrderAsDeliveredForm),
  });
  const response = await conn.text();
  console.log(response);

  // Reload the current page to see the changes imediatly
  location.reload();
}

// ########################## SEARCH ORDERS - CUSTOMER, PARTNERS AND EMPLOYEES ##########################
// This function gets called in the function below
// Checks if the input is a number or not, by using a regex.
function validateNumericInput(input) {
  // Regex that says you can only add numbers between 0-9
  const numericPattern = /^[0-9]+$/;
  return numericPattern.test(input);
}

var timer_search_orders = "";

function search_own_orders() {
  // Clears the timeout that delays the query_results
  clearTimeout(timer_search_orders);
  // Sets an timeout with a few miliseconds to delay the displaying of query_results
  timer_search_orders = setTimeout(async function () {
    // Gets the form
    const frm = document.querySelector("#frm_search_own_orders");
    // Gets the attribute with the api url
    const url = frm.getAttribute("data-url");
    // Get the input field and then gets the value of whatever is inside
    const inputField = document.querySelector("#search-field");
    const inputValue = inputField.value;

    // Validates the input by calling a funcion that makes sure that you can only enter numbers
    if (!validateNumericInput(inputValue)) {
      // The input was not a number
      let invalid_input = `<div class="">Please enter number (ID)</div>`;
      // Makes sure the error messages gets displayed in the query_results
      document.querySelector("#query_results").insertAdjacentHTML("afterbegin", invalid_input);
      return;
    }

    // adding the api-search-own-orders.php to the url to fetch
    // Using asynchronous post request to post the input
    const conn = await fetch(`/api/${url}`, {
      method: "POST",
      body: new FormData(frm),
    });
    const data = await conn.json();
    // Clearing the query_results
    document.querySelector("#query_results").innerHTML = "";

    // Checking if there is any results matching the inputs
    if (data.length === 0) {
      let no_order_found = `<div class="">No order found on that ID</div>`;
      document.querySelector("#query_results").insertAdjacentHTML("afterbegin", no_order_found);
    }
    // If there is results matching the input add for each order, the id and created at in the #query_results
    data.forEach((order) => {
      let div_order = `
        <div class="grid grid-cols-[100fr,100fr,50fr] p-2">
            <div class="">Order ID: ${order.order_id}</div>
              <div class="">Order created at: ${order.order_created_at}</div>
        </div>
      `;
      document.querySelector("#query_results").insertAdjacentHTML("afterbegin", div_order);
    });
  }, 500);
}

// ########################## SEARCH FOR ALL DATA - ADMIN ##########################
var timer_search_data = "";

function search_data() {
  clearTimeout(timer_search_data);
  // Delays the execution of the code in the provided function. So search results is delayed a bit.
  timer_search_data = setTimeout(async function () {
    // Get the search form
    const frm = document.querySelector("#frm_search");
    // Getting the attribute data-url which stores the api-search-admin
    const url = frm.getAttribute("data-url");

    try {
      // adding the api-search-admin to the fetching of the url
      // Using POSt because we are posting the input
      const conn = await fetch(`/api/${url}`, {
        method: "POST",
        body: new FormData(frm),
      });

      const data = await conn.json();
      console.log("Server response:", data);

      // This is where the results of the search will show, but first emtpy it
      document.querySelector("#query_results").innerHTML = "";

      // Checking two things. If data is null/undefined and if data is an array or not.
      if (data && Array.isArray(data)) {
        if (data.length === 0) {
          // No results/data from the api
          let noDataFoundMessage = `<div class="">No data found</div>`;
          document.querySelector("#query_results").insertAdjacentHTML("afterbegin", noDataFoundMessage);
        } else {
          // There were results/data from the api (search) display them like this, also the results is viewed as their own object
          data.forEach((result) => {
            let div_data = `<div class="grid grid-cols-[100fr,100fr,50fr] p-2">`;
            // Foreach key (key-value pair in the object) display the value of the key inside the div
            for (const key in result) {
              if (result.hasOwnProperty(key)) {
                div_data += `<div class="">${result[key]}</div>`;
              }
            }

            div_data += `</div>`;
            // The div with the value from the key is then added to the #query_results
            document.querySelector("#query_results").insertAdjacentHTML("afterbegin", div_data);
          });
        }
      } else {
        // Else the data/response from the api were null/undefined or not an array.
        let noDataFoundMessage = `<div class="">No data found</div>`;
        document.querySelector("#query_results").insertAdjacentHTML("afterbegin", noDataFoundMessage);
      }
    } catch (error) {
      console.error("Fetch error:", error);
      let errorDiv = `<div class="">Error fetching data</div>`;
      document.querySelector("#query_results").insertAdjacentHTML("afterbegin", errorDiv);
    }
  }, 500);
}
