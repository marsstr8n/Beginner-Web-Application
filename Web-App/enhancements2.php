<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Enhancements">
    <meta name="keywords" content="enhancements, job ad, new style">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">

    <script src="scripts/enhancements.js"></script>
    <title>Enhancements</title>

</head>

<body>
    <?php include 'navbar.inc'; ?>    

    <h2>1. Timer for apply.html</h2>
    <p> I create a 10-minute timer for the apply page. I incorporate the timer itself to sessionStorage, so the timer still runs unless user removes the browser tab. Timer starts when user opens the Apply Now page. Once the user submits the form, the timer resets back to 10 minutes. When timer runs out, an alert message comes up and redirects the user to home page.</p>

    <li><a href="apply.html">Link here</a></li>

    
    

    <h2>2. Dark mode toggle for apply.html and jobs.html</h2>
    <p> I create dark mode/light mode toggle icon on the menu bar of jobs.html and apply.html. Once user clicks it, the sun icon is light mode, and the moon icon is dark mode. The background and text colour change accordingly. For white mode, the background colour is white, text is black; and vice versa for dark mode. I use Bootstrap for the icon. I aim to make my website for interactive with this feature.</p>

    <li><a href="apply.html">Link here, on the menu bar</a></li>
    <p>Usage of bootstrap icons: <a href="https://icons.getbootstrap.com/">bootstrap icons</a></p>



    <?php include 'footer.inc'; ?>
</body>



</html>