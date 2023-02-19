const favouritesContainer = document.querySelector('#favouritesContainer');
//         <div class="row border-bottom">
//             <div class="col-12 bg-light ">
//                 <div class="row d-flex align-items-center">
//                     <div class="col-4">
//                         <img class="favouritesImage m-3" src="${favourite.ImageUrl}" class="img-fluid" alt="Responsive image">
//                     </div>
//                     <div class="col d-flex justify-content-between align-items-center">
//                         <h2 class="favouriteTitle">${favourite.Title}</h2>
//                         <a href="#" class="buttonRemove">Remove</a>
//                     </div>
//                 </div>
//             </div>
//         </div>


/* TODO:
- Create a function that fetches all the favourites from the api
*/


// get favourites from the user
const getFavourites = async () => {
    const response = await fetch('/api/favourites/getAll');
    const favourites = await response.json();
    console.log(favourites);
    return favourites;
};

const createFavouriteResult = (favourite) => {
    // Create the main container element
    const container = document.createElement('div');
    console.log(favourite.RecipeId);
    container.dataset.recipeId = favourite.RecipeId;
    container.classList.add('row', 'border-bottom');
    container.addEventListener('click', handleFavouriteDiv);

    // Create the inner container element
    const innerContainer = document.createElement('div');
    innerContainer.classList.add('col-12', 'bg-light');

    // Create the row element
    const row = document.createElement('div');
    row.classList.add('row', 'd-flex', 'align-items-center');

    // Create the image container element
    const imageContainer = document.createElement('div');
    imageContainer.classList.add('col-4');

    // Create the image element
    const image = document.createElement('img');
    image.classList.add('favouritesImage', 'm-3');
    image.src = favourite.ImageUrl;
    image.alt = 'Responsive image';

    // Create the text container element
    const textContainer = document.createElement('div');
    textContainer.classList.add('col', 'd-flex', 'justify-content-between', 'align-items-center');

    // Create the title element
    const title = document.createElement('h2');
    title.classList.add('favouriteTitle');
    title.textContent = favourite.Title;

    // Create the button element
    const button = document.createElement('a');
    button.dataset.recipeId = favourite.RecipeId;
    button.href = '';
    button.textContent = 'Remove';
    button.addEventListener('click', handleDeleteButton);

    const author = document.createElement('p');
    author.classList.add('favouriteAuthor');
    author.textContent = favourite.Author;


    // Append all the elements to the DOM
    imageContainer.appendChild(image);
    textContainer.appendChild(title);
    textContainer.appendChild(button);
    row.appendChild(imageContainer);
    row.appendChild(textContainer);
    innerContainer.appendChild(row);
    container.appendChild(innerContainer);

    favouritesContainer.appendChild(container);
};



const fillFavouritesContainer = async (favouriteRecipes) => {
    // Clear the favourites container
    favouritesContainer.innerHTML = '';

    // Loop through the favourite recipes and create a favourite result for each one
    favouriteRecipes.forEach(favourite => {
        createFavouriteResult(favourite);
    });
};

const loadFavourites = async () => {
    const favourites = await getFavourites();
    fillFavouritesContainer(favourites);
}

loadFavourites();


const handleDeleteButton = async (e) => {
    e.preventDefault();
    const recipeId = e.target.dataset.recipeId;
    // console.log(recipeId);

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

  const res = await response.json();
    console.log(res);



    console.log('send post');
  
  loadFavourites();
  console.log('refill');
};

const handleFavouriteDiv = (e) => {
    e.preventDefault();
    const recipeId = e.target.dataset.recipeId;
    console.log(recipeId);
}