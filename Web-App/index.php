<?php
require_once 'settings.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Home">
    <meta name="keywords" content="Home page, job ad, company information">
    <meta name="author" content="Marcus">
    <title>Index</title>
    <link rel="stylesheet" href="styles/style.css">


</head>

<body class="index" id="homePage">
    <?php include 'navbar.inc'; ?>



    <!--Company description here-->
    <div class="index_desc">
        <h2 class="shadow">Who we are</h2>
        <p>PXZ Institute aims to develop software applications for independent Asian grocery shops in Victoria. As a mid-sized company with
            450 passionate engineers and data scientists, we aim to create the most approachable, user-friendly applications for our clients.</p>
        <p> Our purpose is to bridge the gap between traditional Asian grocery shopping and the digital future. We aim to achieve this by creating innovative and culturally relevant
            for store owners and their respective target audience. Furthermore, our data scientists utilise the latest analytical tools to understand customer
            behaviour and help business owners to decide on the right stock at the right time.</p>

    </div>
    <br>

    <div class="index_desc">
        <h2 class="shadow">What we offer</h2>
        <h3 class="shadow">Multilingual support</h3>
        <p>We aim to cater to your business' core audience, by providing support for multiple Asian languages, helping customers shop with ease.</p>

        <h3 class="shadow">Inventory management</h3>
        <p>Our application automatically tracks the store's available stock, from fresh produce to ready-made food. Our tracking system helps with customer online order, with the simple and efficient UI design. </p>

        <h3 class="shadow">Comprehensive sales report</h3>
        <p>You can gain valuable insights from our sales chart generated bimonthly, in order to improve your business decision-making</p>

        <h3 class="shadow">Customer loyalty campaign</h3>
        <p>Our application provides updates when your store has promotions and special offers, informing your customers in time.</p>

        <h3 class="shadow">We are dedicated to be your long-term partner</h3>
        <p>We care about your success. Our team is always ready to support and assist you to get the most out of your software.</p>

    </div>


    <?php include 'footer.inc'; ?>
</body>


</html>