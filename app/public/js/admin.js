const usersContainer = document.getElementById('usersContainer');
const table = document.getElementById('usersTable');
const tableBody = document.getElementById('tableBody');

// modal
const modal = document.getElementById('updateModal');
const usernameSpan = document.getElementById('usernameSpan');
const idSpan = document.getElementById('idSpan');
const usernameField = document.getElementById('usernameField');
const emailField = document.getElementById('emailField');
const roleField = document.getElementById('roleField');
const modalCloseIcon = document.getElementById('modalCloseIcon');
const modalSaveButton = document.getElementById('modalSaveButton');
const modalCloseButton = document.getElementById('modalCloseButton');
const errorLabel = document.getElementById('errorLabel');

// add event listeners
modalSaveButton.addEventListener('click', handleModalSave);
modalCloseIcon.addEventListener('click', handleModalClose);
modalCloseButton.addEventListener('click', handleModalClose);

// When the user clicks anywhere outside of the modal, close it
document.addEventListener('click', (event) => {
  if (event.target == modal) {
    closeModal();
  }
});

getAllUsers();

// get all users from server
async function getAllUsers() {
  fetch('/api/admin/getAllUsers')
    .then((response) => response.json())
    .then((data) => {
      data.forEach((element) => {
        createTableRow(element);
      });
    });
}

// function for creating tablerows
function createTableRow(user) {
  const row = document.createElement('tr');

  // Create table data elements
  const id = document.createElement('td');
  const username = document.createElement('td');
  const email = document.createElement('td');
  const role = document.createElement('td');

  // edit button
  const edit = document.createElement('td');
  const editLink = document.createElement('a');
  const editIcon = document.createElement('i');
  editIcon.classList.add('bi-wrench-adjustable');
  editLink.classList.add('mouseHover');
  editIcon.dataset.userId = user.Id;
  editLink.addEventListener('click', handleEditClick);
  editLink.appendChild(editIcon);
  edit.appendChild(editLink);

  // delete button
  const deleteButton = document.createElement('td');
  const deleteLink = document.createElement('a');
  const deleteIcon = document.createElement('i');
  deleteIcon.classList.add('bi-trash');
  deleteLink.classList.add('mouseHover');
  deleteLink.appendChild(deleteIcon);
  deleteIcon.dataset.userId = user.Id;
  deleteLink.addEventListener('click', handleDeleteClick);
  deleteButton.appendChild(deleteLink);

  // Set table data values
  id.innerHTML = user.Id;
  username.innerHTML = user.Username;
  email.innerHTML = user.Email;
  role.innerHTML = user.Role == 1 ? 'Admin' : 'User';

  // Append table data to row
  row.appendChild(id);
  row.appendChild(username);
  row.appendChild(email);
  row.appendChild(role);
  row.appendChild(edit);
  row.appendChild(deleteButton);

  // Append row to table body
  tableBody.appendChild(row);
}

// Fill the modal with user info
function fillModal(user) {
  // spans
  usernameSpan.innerHTML = user.Username;
  idSpan.innerHTML = user.Id;

  // fill modal with user data
  usernameField.value = user.Username;
  emailField.value = user.Email;
  roleField.value = user.Role;
}

// handle edit click
function handleEditClick(event) {
  const userId = event.target.dataset.userId;

  fetch(`/api/admin/getUserById`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id: userId }),
  })
    .then((response) => response.json())
    .then((data) => {
      // fill modal with user data
      fillModal(data);
    });

  openModal();
}

// Handle delete click
function handleDeleteClick(event) {
  const userId = event.target.dataset.userId;

  const confirmation = confirm('Are you sure you want to delete this user?');
  if (confirmation) {
    fetch(`/api/admin/deleteUser`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: userId }),
    })
      .then((response) => response.json())
      .then((data) => {
        tableBody.innerHTML = '';
        getAllUsers();
      });
  }
}

// Handle modal close
function handleModalClose() {
  closeModal();
}

// Handle modal save
function handleModalSave() {
  // create updated user object
  const updatedUser = {
    id: idSpan.innerHTML,
    username: usernameField.value,
    email: emailField.value,
    role: roleField.value,
  };

  // check for empty fields
  if (checkEmptyFields(updatedUser)) return;

  // check if username or email already exists
  if (checkUsernameExists(updatedUser)) return;
  if (checkEmailExists(updatedUser)) return;

  // send updated user to server
  fetch(`/api/admin/updateUser`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ user: updatedUser }),
  })
    .then((response) => response.json())
    .then((data) => {
      // clear table body and get all users again
      tableBody.innerHTML = '';
      getAllUsers();
    });
  closeModal();
}

// open modal
function openModal() {
  modal.style.display = 'block';
  createOverlay();
  hideErroLabel();
}

// close modal
function closeModal() {
  modal.style.display = 'none';
  removeOverlay();
}

// create overlay over the document to make the modal pop out
function createOverlay() {
  const overlay = document.createElement('div');
  overlay.id = 'overlay';
  overlay.classList.add('overlay');
  document.body.appendChild(overlay);
}

// remove overlay
function removeOverlay() {
  const overlay = document.querySelector('#overlay');
  overlay.remove();
}

// show error label
function showErroLabel(message) {
  errorLabel.innerHTML = message;
  errorLabel.style.display = 'block';

  // return true to stop the function
  return true;
}

// hide error label
function hideErroLabel() {
  errorLabel.style.display = 'none';
}

// check if any fields are empty
function checkEmptyFields(user) {
  // variable that will be returned
  let isEmpty = false;

  // check for the empty fields
  if (user.username == '') isEmpty = showErroLabel('Username is required');
  if (user.email == '') isEmpty = showErroLabel('Email is required');

  if (user.username == '' && user.email == '')
    isEmpty = showErroLabel('Please enter a username and email');

  return isEmpty;
}

// check if the username entered already exists
function checkUsernameExists(newUser) {
  const oldUser = getUserDataFromTable(
    document.getElementById('idSpan').innerHTML
  );

  // check if username is the same as the old one
  if (newUser.username === oldUser.username) return false;

  // get all usernames from the table
  const usernamesFromTable = Array.from(
    document.querySelectorAll('td:nth-child(2)')
  ).map((td) => td.innerHTML);

  // check if username exists in the table but not the same as the old one
  if (usernamesFromTable.includes(newUser.username)) {
    return showErroLabel('Username already exists');
  }
}

// check if the email entered already exists
function checkEmailExists(newUser) {
  const oldUser = getUserDataFromTable(
    document.getElementById('idSpan').innerHTML
  );

  // check if email is the same as the old one
  if (newUser.email === oldUser.email) return false;

  // get all emails from the table
  const emailsFromTable = Array.from(
    document.querySelectorAll('td:nth-child(3)')
  ).map((td) => td.innerHTML);

  // check if email exists in the table but not the same as the old one
  if (emailsFromTable.includes(newUser.email)) {
    return showErroLabel('Email already exists');
  }
}

// get user data from table
function getUserDataFromTable(id) {
  // create arrow with all rows and remove the first one
  const rows = Array.from(document.querySelectorAll('tr'));
  rows.shift();

  // find the row with the id
  const row = rows.find((row) => row.children[0].innerHTML == id);

  // get the data from the row
  const data = Array.from(row.children).map((td) => td.innerHTML);

  // create user object
  const user = {
    id: data[0],
    username: data[1],
    email: data[2],
    role: data[3] == 'Admin' ? 1 : 0,
  };

  return user;
}
