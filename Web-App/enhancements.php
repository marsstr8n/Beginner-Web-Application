<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Enhancements">
    <meta name="keywords" content="enhancements, job ad, new style">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">
    <title>Enhancements</title>
</head>

<body>
    <?php include 'navbar.inc'; ?>

    <h2>1. Stylised navigation bar</h2>
    <p>I have incorporated the company and h1 element into a part of the navigation bar.
        This style is common in modern websites, which I attempt to emulate.</p>
    <p>
        The logo and h1 element is on the left, while the hyperlinks are placed on the right.
        I use the gradient syntax, 180 deg to change the colour to having both blue and black color, aiming to make the menu bar easier on the eye. 
        https://www.w3schools.com/css/css3_gradients.asp

    </p>

    <p>When the mouse hovers, each hyperlink's background change color to a light grey, indicating that this 'button' will take the user to the next page.</p>

    <p>I also apply media query, to have the hyperlinks stack vertically when screen becomes smaller</p>
    

    <h2>2. Text-shadow and glow animation</h2>
    <p><a href="index.html">The link to the enhancement</a></p>
    <p>In my second enhancement, I create text-shadow for h2 and h3 elements. I also add keyframes animation, to make the texts glow brighter periodically. When the cursor hovers, the text transforms color, from white to yellow, and become a bit bolder</p>

    <p>With this enhancement, I aim to transform a static webpage into a webpage with some degree of interactivity. I capitalise on the dark background, so that the glow becomes more prominent. https://www.w3schools.com/cssref/css3_pr_text-shadow.php This also helps to bring more focus to the headings, enhancing user experience.</p>


    <?php include 'footer.inc'; ?>
</body>



</html>