const url = window.location.href;
const recipeId = url.substring(url.lastIndexOf('/') + 1).split('=')[1];
const buttonContainer = document.getElementById('button-container');
const ingredientContainer = document.querySelector('.ingredients-container');
const amountInput = document.getElementById('amountInput');

// check if the user is loggedIn
const checkLoggedIn = async () => {
  const response = await fetch('/api/user/loggedIn');
  const data = await response.json();

  if (data === false) createLoginText();
  else checkFavourite();
};

checkLoggedIn();

const checkFavourite = async () => {
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
};

const createFavouriteButton = () => {
  const button = document.createElement('a');
  button.id = 'favourite-button';
  button.classList.add('rounded-pill', 'btnFavorite', 'btn', 'btn-primary');
  button.textContent = 'Add to favourites';
  button.addEventListener('click', handleFavouriteButton);
  buttonContainer.appendChild(button);
};

const createDeleteButton = () => {
  const deleteButton = document.createElement('a');
  deleteButton.id = 'delete-button';
  deleteButton.classList.add('button', 'btnDelete', 'btn', 'btn-primary');
  deleteButton.textContent = 'Remove from favourites';
  deleteButton.addEventListener('click', handleDeleteButton);
  buttonContainer.appendChild(deleteButton);
};

const createLoginText = () => {
  const text = document.createElement('p');
  text.innerHTML =
    'Make sure you <a class="link-success" href="/login">Login</a> to add to favourites';
  buttonContainer.appendChild(text);
};

const handleFavouriteButton = async () => {
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
};

const handleDeleteButton = async () => {
  console.log(recipeId);

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
};

// INGREDIENTS

// Fetches the ingredients for the given recipe ID from the server
const getIngredients = async () => {
    // Fetch the ingredients from the server
    const response = await fetch(`/api/recipe/ingredients?recipeId=${recipeId}`);
    // If the request failed, throw an error
    if (!response.ok)
        throw new Error('Error fetching ingredients');
    // Otherwise, return the parsed JSON response
    return await response.json();
};


const init = async () => {
  try {
    const ingredients = await getIngredients();
    const newIngredients = calculateIngredients(1, ingredients);
    fillIngredientsContainer(newIngredients);
  } catch (error) {
    console.error('Error:', error);
  }
};
init();

const ingredients = getIngredients();


const fillIngredientsContainer = async (data) => {
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
};

const handleAmountInput = async () => {
  const amount = amountInput.value;
  const ingredientsData = await ingredients;
  calculateIngredients(amount, ingredientsData);
};


  
  const calculateIngredients = (amount, ingredients) => {
    const multipliedIngredients = [];

    for (const ingredient of ingredients) {
      const match = ingredient.match(/^([\d/-]+)?\s*(.+)$/);
          if (match) {
      let multipliedQuantity;

      const [, quantityString, name] = match;
      if (quantityString) {
        if (quantityString.includes('-')) {
          const [integerPart, fractionalPart] = quantityString.split('-');
          const [numerator, denominator] = fractionalPart.split('/').map(Number);
          multipliedQuantity = (Number(integerPart) + numerator / denominator) * amount;
        } else if (quantityString.includes('/')) {
          const [numerator, denominator] = quantityString.split('/').map(Number);
          multipliedQuantity = numerator / denominator * amount;
        } else {
          multipliedQuantity = Number(quantityString) * amount;
        }
      } else {
        multipliedQuantity = amount;
      }

      multipliedIngredients.push(`${multipliedQuantity} ${name}`);
    } else {
      multipliedIngredients.push(ingredient);
    }


      
      // const match = ingredient.match(/(\d+)\s*([-]*\s*[\d\/]*)\s(.*)/);

      // if (match) {
      //   const [, integerPart, fractionalPart, name] = match;

      //   let multipliedQuantity;

      //   if (fractionalPart) {
      //     const [numerator, denominator] = fractionalPart.split('/').map(Number);
      //     multipliedQuantity = (Number(integerPart) + numerator / denominator) * amount;
      //   } else {
      //     multipliedQuantity = Number(integerPart) * amount;
      //   }

      //   multipliedIngredients.push(`${multipliedQuantity} ${name}`);
      // } else {
      //   multipliedIngredients.push(ingredient);
      // }

      // match the regex

      // const matchBigFraction = ingredient.match(/^\d+-\d+\/\d+$/);
      // const matchFraction = ingredient.match(/^\d+\/\d+$/);

      // if (matchBigFraction) {
      //   const [, integerPart, fractionalPart] = matchBigFraction;
      //   const [numerator, denominator] = fractionalPart.split('/').map(Number);
      //   multipliedQuantity = (Number(integerPart) + numerator / denominator) * amount;
      //   } else if (matchFraction) {
      //   const [, fractionalPart] = matchFraction;
      //   const [numerator, denominator] = fractionalPart.split('/').map(Number);
      //   multipliedQuantity = numerator / denominator * amount;
      //   } else {
      //   multipliedQuantity = Number(ingredient) * amount;
      //   }

      //   const nameMatch = ingredient.match(/\s(.*)/);
      //   if (nameMatch) {
      //   const [, name] = nameMatch;
      //   multipliedIngredients.push(${multipliedQuantity} ${name});
      //   } else {
      //   multipliedIngredients.push(ingredient);
      //   }
    }

    

    fillIngredientsContainer(multipliedIngredients);
}

amountInput.addEventListener('change', handleAmountInput);

