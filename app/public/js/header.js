// add event listener to login button
if (document.getElementById('login-button')) {
  // add event listener to logout button
  document
    .getElementById('login-button')
    .addEventListener('click', function (e) {
      e.preventDefault();

      window.location.href = '/login';
    });
}

// add event listener to logout button
if (document.getElementById('logout-button')) {
  // add event listener to logout button
  document
    .getElementById('logout-button')
    .addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = '/logout';
    });
}

// add event listener to favorites button
if (document.getElementById('favourites-button')) {
  // add event listener to logout button
  document
    .getElementById('favourites-button')
    .addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = '/favourites';
    });
}

// add event listener to admin button
if (document.getElementById('admin-button')) {
  // add event listener to logout button
  document
    .getElementById('admin-button')
    .addEventListener('click', function (e) {
      e.preventDefault();
      window.location.href = '/admin';
    });
}

// Change nav color on scroll
window.addEventListener('scroll', function () {
  const nav = document.querySelector('nav');

  if (window.scrollY > 0) {
    nav.classList.add('navWhite');
  } else {
    nav.classList.remove('navWhite');
  }
});

// Activate Bootstrap scrollspy on the main nav element
window.addEventListener('DOMContentLoaded', (event) => {
  const mainNav = document.body.querySelector('#mainNav');
  try {
    new bootstrap.ScrollSpy(document.body, {
      target: '#mainNav',
      offset: 74,
    });
  } catch (error) {
    console.log(error);
  }
});
