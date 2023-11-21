//Form so when the user selects "General Information" redirects to a desired file
const form = document.querySelector('form');
const select = document.querySelector('#ranking_criterion');

form.addEventListener('submit', (event) => {
  event.preventDefault();
  const option = select.value;
  const action = (option === 'general') ? 'general_info.php' : 'results.php';
  form.action = action;
  form.submit();
});

//Dark mode toggle
const modeToggle = document.querySelector('#mode-toggle');
const body = document.body;

modeToggle.addEventListener('click', function toggleDarkMode() {
  body.classList.toggle('dark-mode');
});

//Setting the date of the next Olympics (Paris 2024)
const nextOlympicsDate = new Date('2024-07-26T00:00:00Z');
const countdownElement = document.getElementById("countdown");

//Function to update the countdown every second
function updateCountdown() {
  const now = new Date();
  const timeRemaining = nextOlympicsDate - now;

  //Calculating the remaining days, hours, minutes, and seconds
  const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
  const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

  //Updating the countdown element
  countdownElement.textContent = `Next Olympics in Paris, France in ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds`;
}

//Calling the updateCountdown function every second
setInterval(updateCountdown, 1000);

//Images slideshow
const imageUrls = [
  "https://stillmed.olympics.com/media/Images/News/2022/07/25/London/2022-07-25-London-featured.jpg",
  "https://www.hollywoodreporter.com/wp-content/uploads/2011/12/london-2012-olympics_copy.jpg",
  "https://cdn.pixabay.com/photo/2016/05/10/04/28/london-1383064_960_720.jpg",
  "https://cdn.pixabay.com/photo/2019/08/11/15/28/sport-4399175_960_720.jpg",
  "https://cdn.pixabay.com/photo/2016/11/12/20/21/return-1819651_960_720.jpg",
  "https://cdn.pixabay.com/photo/2014/02/08/16/47/sochi-2014-262145_960_720.jpg",
];

const slideshowElement = document.getElementById("slideshow");
let currentImageIndex = 0;

function showNextImage() {
  slideshowElement.style.backgroundImage = `url(${imageUrls[currentImageIndex]})`;

  currentImageIndex++;
  if (currentImageIndex >= imageUrls.length) {
    currentImageIndex = 0;
  }

  setTimeout(showNextImage, 5000);
}

showNextImage();
