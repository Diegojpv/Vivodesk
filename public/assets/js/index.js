// ============================ Javascript code to manage the home page ============================
// This JavaScript file contains the logic for visual effects and functionalities on the home page.

// ============================ Visual effects ============================

// ---------------------- Image carousel logic -----------------------

const images = document.querySelectorAll('.background img');
let current = 0;
let slideInterval;
  
// Function to change the image in the carousel
function changeImage() {

  // Let's create a function that assigns a class to images based on the value of current.
  changeCards();
    const currentImage = images[current];

    currentImage.classList.remove("active");
    currentImage.classList.add("exit");

    // We change the value of current to move to the next image without exceeding the image limit. 
    current = (current + 1) % images.length;

    const nextImage = images[current]; 
    nextImage.classList.remove("exit"); 
    nextImage.classList.add("active");

    //setTimeout  Removes the class at the same time as the transition ends
    setTimeout(() => {
  currentImage.classList.remove("exit");
}, 1000);
}

// To prevent the browser from reducing the frequency of setInterval, we will adjust it based on whether the user is on the website or not.

// Function detects whether the carousel is running and, if not, activates the function to change the image every 24 seconds. 
function startSlideShow() {
  if (!slideInterval) {
    slideInterval = setInterval(changeImage, 24000);
  }
} 

// Function to stop the slideshow with clearInterval and we delete the interval ID.
function stopSlideShow() {
  clearInterval(slideInterval);
  slideInterval = null;
}

// Start the slideshow when the page loads
startSlideShow();

// Event listener to detect when the user switches tabs or minimizes the browser
document.addEventListener("visibilitychange", () => {
    if (document.hidden) {
        // If the user leaves, we stop the slideshow
        stopSlideShow();
        console.log("Carousel paused due to inactivity");
    } else {
        // If the user returns, we restart the slideshow
        startSlideShow();
        console.log("Carousel resumed");
    }
});

// ---------------------- Card stack animation logic -----------------------

const stack = document.getElementById('stack');

function changeCards() {
  const cards = stack.querySelectorAll('.text-container__cards');
  const topCard = cards[0];
  const secondCard = cards[1];

  // If the top card is already coming out, we do not repeat the animation.
  if (topCard.classList.contains('fly-out')) return;

  // The second card is prepared as a preview, and the first card starts the exit animation.
  secondCard.classList.add('preview');
  topCard.classList.add('fly-out');

  // When the animation ends, the cards are rearranged in the stack.
  setTimeout(() => {
    topCard.classList.remove('fly-out');
    secondCard.classList.remove('preview');
    stack.appendChild(topCard); // Move the top card to the bottom of the stack
  }, 1000);
};

// ---------------------- Button animation logic -----------------------

const boton = document.querySelector('.hero-content__button');

function animationActive() {
  // If the button is already animated, we do not repeat the animation.
  if (boton.classList.contains('animado')) return;
  // Add the animation class and remove it after 1 second.
  boton.classList.add('animado');
  setTimeout(() => {
    boton.classList.remove('animado');
  }, 1000);
}
// Event listener to trigger the animation on mouse enter
boton.addEventListener('mouseenter', animationActive);

// ============================ Functionalities ============================

// ---------------------- Navigation logic -----------------------

const workdeskLink = document.getElementById('workdesk-link');
const userLink = document.getElementById('user-link');

// Function to navigate to the work desk page with the username as a query parameter
function goToWorkdesk(event) {
  // Recover the username from the text that contains it.
  const username = document.querySelector('.user p').textContent.trim();
  // If the username is empty, prevent navigation and alert the user.
  if (username.length === 0) {
    event.preventDefault();
    alert('Please log in to access the work desk.');
  } else {
    // Navigate to the work desk page with the username as a query parameter.
    window.location.href = `workdesk.php?user=${username}`;
  }
}
// Add event listeners to the links to trigger the navigation function.
workdeskLink.addEventListener('click', goToWorkdesk);
userLink.addEventListener('click', goToWorkdesk);

// ---------------------- Logout logic -----------------------
const logOutLink = document.querySelector('.log-out');

function logOut(event) {
  const username = document.querySelector('.user p').textContent.trim();
  // If the username is empty, prevent logout and alert the user.
  if (username === '') {
    event.preventDefault();
    alert('You are not logged in.');
  } else if (confirm('Are you sure you want to log out?')) {
    window.location.href = '../src/logout.php';
    // If the user confirms, navigate to the logout page.
  }
}
// Add event listener to the logout link to trigger the logout function.
logOutLink.addEventListener('click', logOut);