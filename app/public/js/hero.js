const searchButton = document.getElementById('search-button');
const supriseButton = document.getElementById('suprise-button');

// event listeners
searchButton.addEventListener('click', function (e) {
  redirectPage(e, '#search-section');
});

supriseButton.addEventListener('click', function (e) {
  const randomNumber = getRandomNumber();
  redirectPage(e, `/recipe?id=${getRandomRecipeId()}`);
});

// the random recipe id's
const recipesIds = ['47746', '35478', '46895', '0fb8f4', 'a723e8'];

// redirect to page
function redirectPage(e, url) {
  e.preventDefault();
  window.location.href = url;
}

// suprise button event handler
const getRandomNumber = (min, max) =>
  Math.floor(Math.random() * (max - min)) + min;

// get random recipe from randomRecipesIds
function getRandomRecipeId() {
  const randomNumber = getRandomNumber(0, recipesIds.length);
  return recipesIds[randomNumber];
}
