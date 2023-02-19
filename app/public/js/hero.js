
const searchButton = document.getElementById('search-button');
const supriseButton = document.getElementById('suprise-button');

const redirectPage = (e, url) => {
    e.preventDefault();
    window.location.href = url;
}

// logout button event handler
searchButton.addEventListener('click', function (e) {
        redirectPage(e, '#search-section');
    });

// suprise button event handler
supriseButton.addEventListener('click', function (e) {
        const randomNumber = getRandomNumber();
        redirectPage(e, `/recipe?id=${getRandomRecipeId()}`);

});

const recipesIds = ['47746', '35478', '46895', '0fb8f4', 'a723e8'];

const getRandomNumber = (min, max) => Math.floor(Math.random() * (max - min)) + min;

const getRandomRecipeId = () => {
    // get random recipe from randomRecipesIds
    const randomNumber = getRandomNumber(0, recipesIds.length);
    return recipesIds[randomNumber];
}





    

