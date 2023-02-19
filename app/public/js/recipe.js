const url = window.location.href;
const recipeId = url.substring(url.lastIndexOf('/') + 1).split('=')[1];
const buttonContainer = document.getElementById('button-container');
const ingredientContainer = document.querySelector('.ingredients-container');
const amountInput = document.getElementById('amountInput');

// event listeners
amountInput.addEventListener('change', handleAmountInput);

// check if the user is logged in
checkLoggedIn();

// get the ingredients from the server
init();
const ingredients = getIngredients();

// check if the user is loggedIn
async function checkLoggedIn() {
  const response = await fetch('/api/user/loggedIn');
  const data = await response.json();

  // if data is false, create login text else check if the recipe is in favourites
  if (data === false) createLoginText();
  else checkFavourite();
}

// check if the recipe is in favourites
async function checkFavourite() {
  // clear button container so there is no button
  buttonContainer.innerHTML = '';

  // create post request to check if recipe is already in favourites
  const response = await fetch('/api/favourites/check', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      recipeId,
    }),
  });

  const data = await response.json();

  // if data is false, create favourite button else create delete button
  if (data === false) createFavouriteButton();
  else createDeleteButton();
}

// handle favourite button click
async function handleFavouriteButton() {
  // create post request to add recipe to favourites
  const response = await fetch('/api/favourites/add', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      recipeId,
    }),
  });

  // check if recipe is in favourites to print the correct button
  checkFavourite();
}

// handle delete button click
async function handleDeleteButton() {
  // create post request
  const response = await fetch('/api/favourites/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      recipeId,
    }),
  });

  // check if recipe is in favourites to print the correct button
  checkFavourite();
}

// INGREDIENTS

// Fetches the ingredients for the given recipe ID from the server
async function getIngredients() {
  const response = await fetch(`/api/recipe/ingredients?recipeId=${recipeId}`);
  if (!response.ok) throw new Error('Error fetching ingredients');

  // Otherwise, return the parsed JSON response
  return await response.json();
}

async function init() {
  try {
    const ingredients = await getIngredients();
    const newIngredients = calculateIngredients(1, ingredients);
    fillIngredientsContainer(newIngredients);
  } catch (error) {
    console.error('Error:', error);
  }
}

async function fillIngredientsContainer(data) {
  try {
    //clear container
    ingredientContainer.innerHTML = '';

    const ingredientsData = await data;

    // fill ingredients container with p elements <p>🍴 $ingredient</p>
    ingredientsData.forEach((ingredient) => {
      const ingredientElement = document.createElement('p');
      ingredientElement.innerHTML = `🍴 ${ingredient}`;
      ingredientContainer.appendChild(ingredientElement);
    });
  } catch (error) {
    console.log(error);
  }
}

// handle amount input change
async function handleAmountInput() {
  const amount = amountInput.value;
  const ingredientsData = await ingredients;
  calculateIngredients(amount, ingredientsData);
}

// calculate the ingredients for the given amount
function calculateIngredients(amount, ingredients) {
  const multipliedIngredients = [];

  for (const ingredient of ingredients) {
    // match the quantity and name of the ingredient
    const match = ingredient.match(/^([\d/-]+)?\s*(.+)$/);

    // if there is a match, multiply the quantity with the amount
    if (match) {
      let multipliedQuantity;

      // destructuring the match array
      const [, quantityString, name] = match;

      // check if the quantity is a fraction or a number
      if (quantityString) {
        // check if the quantity is a fraction
        if (quantityString.includes('-')) {
          // split the quantity string into integer and fraction
          const [integerPart, fractionalPart] = quantityString.split('-');

          // split the fraction into numerator and denominator
          const [numerator, denominator] = fractionalPart
            .split('/')
            .map(Number);
          multipliedQuantity =
            (Number(integerPart) + numerator / denominator) * amount;
        } else if (quantityString.includes('/')) {
          // split the quantity string into numerator and denominator
          const [numerator, denominator] = quantityString
            .split('/')
            .map(Number);
          multipliedQuantity = (numerator / denominator) * amount;
        } else {
          // multiply the quantity with the amount
          multipliedQuantity = Number(quantityString) * amount;
        }
      } else {
        multipliedQuantity = amount;
      }

      // push the multiplied quantity and name to the multipliedIngredients array
      multipliedIngredients.push(`${multipliedQuantity} ${name}`);
    } else {
      multipliedIngredients.push(ingredient);
    }
  }

  // fill the ingredients container with the multiplied ingredients
  fillIngredientsContainer(multipliedIngredients);
}

// FAVOURITES

// create favourite button
function createFavouriteButton() {
  const button = document.createElement('a');
  button.id = 'favourite-button';
  button.classList.add('button', 'btnFavorite', 'btn', 'btn-primary');
  button.textContent = 'Add to favourites';
  button.addEventListener('click', handleFavouriteButton);
  buttonContainer.appendChild(button);
}

// create delete button
function createDeleteButton() {
  const deleteButton = document.createElement('a');
  deleteButton.id = 'delete-button';
  deleteButton.classList.add('button', 'btnDelete', 'btn', 'btn-primary');
  deleteButton.textContent = 'Remove from favourites';
  deleteButton.addEventListener('click', handleDeleteButton);
  buttonContainer.appendChild(deleteButton);
}

// create login text
function createLoginText() {
  const text = document.createElement('p');
  text.innerHTML =
    'Make sure you <a class="link-success" href="/login">Login</a> to add to favourites';
  buttonContainer.appendChild(text);
}
