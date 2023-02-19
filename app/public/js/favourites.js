const favouritesContainer = document.querySelector('#favouritesContainer');

displayFavourites();

// get favourites from the user
async function getFavourites() {
  const response = await fetch('/api/favourites/getAll');
  const favourites = await response.json();
  return favourites;
}

// create a favourite result
function createFavouriteResult(favourite) {
  // Create the main container element
  const container = document.createElement('div');
  container.classList.add('row', 'border-bottom');

  // Create the inner container element
  const innerContainer = document.createElement('div');
  innerContainer.classList.add('col-12', 'bg-light');

  // Create the row element
  const row = document.createElement('div');
  row.classList.add('row', 'd-flex', 'align-items-center');

  // Create the image container element
  const imageContainer = document.createElement('div');
  imageContainer.classList.add(
    'col-xs-12',
    'col-sm-12',
    'col-md-4',
    'col-lg-4'
  );

  // Create the image element
  const image = document.createElement('img');
  image.classList.add('favouritesImage', 'm-3');
  image.src = favourite.ImageUrl;
  image.alt = 'Responsive image';

  // Create the text container element
  const textContainer = document.createElement('div');
  textContainer.classList.add(
    'col',
    'd-flex',
    'justify-content-between',
    'align-items-center'
  );

  // create A element to link to recipe
  const recipeLink = document.createElement('a');
  recipeLink.classList.add('link-success');
  recipeLink.dataset.recipeId = favourite.RecipeId;
  recipeLink.href = `/recipe?id=${favourite.RecipeId}`;
  recipeLink.addEventListener('click', handleRecipeClick);

  // Create the title element
  const title = document.createElement('h2');
  title.classList.add('favouriteTitle');
  title.textContent = favourite.Title;

  // add the title to the link
  recipeLink.appendChild(title);

  // Create the button element
  const removeButton = document.createElement('a');
  removeButton.classList.add('link-danger');
  removeButton.dataset.recipeId = favourite.RecipeId;
  removeButton.href = '';
  removeButton.textContent = 'Remove';
  removeButton.addEventListener('click', handleDeleteButton);

  // Append all the elements to the DOM
  imageContainer.appendChild(image);
  textContainer.appendChild(recipeLink);
  textContainer.appendChild(removeButton);
  row.appendChild(imageContainer);
  row.appendChild(textContainer);
  innerContainer.appendChild(row);
  container.appendChild(innerContainer);

  // Append the container to the favourites container
  favouritesContainer.appendChild(container);
}

// fill the favourites container
async function fillFavouritesContainer(favouriteRecipes) {
  // Clear the favourites container
  favouritesContainer.innerHTML = '';

  // Check if there are no favourites
  displayEmptyFavourites(favouriteRecipes);

  // Loop through the favourite recipes and create a favourite result for each one
  favouriteRecipes.forEach((favourite) => {
    createFavouriteResult(favourite);
  });
}

// display favourites
async function displayFavourites() {
  const favourites = await getFavourites();
  fillFavouritesContainer(favourites);
}

// delete a favourite
async function handleDeleteButton(e) {
  e.preventDefault();
  const recipeId = e.target.dataset.recipeId;

  try {
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

    // reload the container with the updated variables
    displayFavourites();
  } catch (err) {
    console.log(err);
  }
}

// redirect to recipe page
function handleRecipeClick(e) {
  e.preventDefault();
  const parent = e.target.parentElement;
  const recipeId = parent.dataset.recipeId;
  window.location.href = '/recipe?id=' + recipeId;
}

// display message if there are no favourites
function displayEmptyFavourites(favouriteRecipes) {
  if (favouriteRecipes.errorMessage) {
    favouritesContainer.innerHTML = 'You have no favourites yet';
  }
}
