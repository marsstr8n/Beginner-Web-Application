
// Function to start the countdown
function startCountdown() {
    var countdownElement = document.getElementById('countdown');

    // Get the countdown time from sessionStorage, or set it to 10 minutes if it doesn't exist
    var countdownTime = sessionStorage.getItem('countdownTime') || 600;

    // Update the countdown every second
    var countdownInterval = setInterval(function() {
        // Calculate the minutes and seconds remaining
        var minutes = Math.floor(countdownTime / 60);
        var seconds = countdownTime % 60;

        // Display the remaining time in the countdown element
        countdownElement.innerHTML = minutes + ' minutes ' + seconds + ' seconds'

        // Decrease the countdown time by 1 second
        countdownTime--;

        // Save the countdown time to sessionStorage
        sessionStorage.setItem('countdownTime', countdownTime);

        // Check if the countdown has reached 0
        if (countdownTime < 0) {
            // Stop the countdown
            clearInterval(countdownInterval);

            // Display a message 
            countdownElement.innerHTML = 'Time is up!';

            // Alert the user that time is up
            alert('Time is up!');

            // Redirect the user to the home page
            window.location.href = 'index.html';

            // Reset the countdown time in sessionStorage
            sessionStorage.setItem('countdownTime', 600);
        }
    }, 1000);
}

// Start the countdown when the page loads
window.addEventListener('load', startCountdown);


// reset timer once form submitted
document.getElementById('application').addEventListener('submit', function(event) {
    // Reset the countdown time to 10 minutes (600 seconds)
    sessionStorage.setItem('countdownTime', 600);
});



// Function to create Dark Mode. 

function darkMode() {
    console.log('Dark Mode is working');
    const toggle = document.getElementById('toggle'); 
    const body = document.querySelector('body');

    toggle.addEventListener('click', function() { // once the button is clicked
        this.classList.toggle('bi-moon');
        if (this.classList.toggle('bi-brightness-high-fill')) {
            body.style.backgroundColor = 'white'; // light mode
            body.style.color = 'black';
            body.style.transition = '2s';
        } else {
            body.style.backgroundColor = 'black'; // dark mode
            body.style.color = 'white';
            body.style.transition = '2s';
        }
    })
}


