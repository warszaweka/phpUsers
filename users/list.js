const userFields = [
  "id",
  "first_name",
  "last_name",
  "email",
  "gender",
  "ip_address",
  "total_clicks",
  "total_page_views",
];
const tableColumnsAmount = userFields.length;
const tableOuterPlusHeaderRowHeight = 388;
const tableBodyRowHeight = 32;
const tableBodyRowsAmount = Math.floor((document.documentElement.clientHeight - tableOuterPlusHeaderRowHeight) / tableBodyRowHeight);

const tableBody = document.querySelector("#tableBody");
const navbarNumberButtons = document.querySelectorAll(".navbarNumberButton");
const navbarLeftButton = document.querySelector("#navbarLeftButton");
const navbarRightButton = document.querySelector("#navbarRightButton");
const navbarNumberButtonsAmount = navbarNumberButtons.length;

for (let i = 0; i < tableBodyRowsAmount; ++i) {
  const newRow = tableBody.insertRow();
  for (let j = 0; j < tableColumnsAmount; ++j) {
    newRow.insertCell().innerHTML = "<a><div><span></span></div></a>";
  }
}

const tableBodyRows = document.querySelectorAll("#tableBody > tr");

async function get_users_list(size, page) {
  const response = await fetch(`/users/_list.php?size=${size}&page=${page}`);
  return await response.json();
}

let navbarChosenNumberButton = null;

async function update_users_list(page) {
  const data = await get_users_list(tableBodyRowsAmount, page);
  const length = data.users.length;
  for (let i = 0; i < tableBodyRowsAmount; ++i) {
    if (i < length) {
      tableBodyRows[i].hidden = false;
      for (let j = 0; j < tableColumnsAmount; ++j) {
        tableBodyRows[i].childNodes[j].firstElementChild.firstElementChild.firstElementChild.innerHTML = data.users[i][userFields[j]];
        tableBodyRows[i].childNodes[j].firstElementChild.setAttribute("href", `/users/user.php/${data.users[i].id}`);
      }
    } else {
      tableBodyRows[i].hidden = true;
    }
  }
  if (navbarChosenNumberButton) {
    navbarChosenNumberButton.classList.remove("navbarChosenNumberButton");
  }
  const total = data.total;
  const totalPages = Math.ceil(total / tableBodyRowsAmount);
  let start = 0;
  if (navbarNumberButtonsAmount > totalPages) {
    start = 1;
  } else {
    start = page - ((navbarNumberButtonsAmount - 1) / 2);
    if (start < 1) {
      start = 1;
    } else if ((start + navbarNumberButtonsAmount - 1) > totalPages) {
      start = totalPages - navbarNumberButtonsAmount + 1;
    }
  }
  navbarChosenNumberButton = navbarNumberButtons[page - start];
  navbarChosenNumberButton.classList.add("navbarChosenNumberButton");
  for (let i = 0; i < navbarNumberButtonsAmount; ++i) {
    const j = start + i;
    if (j <= totalPages) {
      navbarNumberButtons[i].disabled = false;
      navbarNumberButtons[i].firstElementChild.firstElementChild.innerHTML = j;
      navbarNumberButtons[i].onclick = navbar_button_cb_gen(j);
    } else {
      navbarNumberButtons[i].disabled = true;
    }
  }
  if (page === 1) {
    navbarLeftButton.disabled = true;
  } else {
    navbarLeftButton.disabled = false;
    navbarLeftButton.onclick = navbar_button_cb_gen(page - 1);
  }
  if (page === totalPages) {
    navbarRightButton.disabled = true;
  } else {
    navbarRightButton.disabled = false;
    navbarRightButton.onclick = navbar_button_cb_gen(page + 1);
  }
}

function navbar_button_cb_gen(page) {
  return () => update_users_list(page);
}

update_users_list(1);
