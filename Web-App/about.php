<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="About us">
    <meta name="keywords" content="About us page, job ad, company information">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">

    
    <title>About us</title>
</head>

<body>
    <?php include 'navbar.inc'; ?>

    <hr>
    <div class="center">
        <div class="first">
        <dl>
            
            <dt>My name</dt><dd>Marcus Tran</dd>
        
            <dt>My student number</dt><dd>105149160</dd>
            
            <dt>My tutor's name</dt><dd>Bo Li</dd>
        
            <dt>My course</dt><dd>Master of Data Science</dd>
        

        </dl>
        </div>

        <div class="second">
        <figure class="myphoto">
            <!--Put an image of myself here-->
            <img src="images/myphoto2.jpeg" alt="Marcus Tran">
            <figcaption>Marcus Tran</figcaption>
        </figure>
        </div>  

    </div>

    <!--My swin timetable-->
    <div class="third">
    <table border="1" class="table">
        <tr>
            <th>Time/Day</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
        <tr>
            <td>8:30 - 10:30</td>
            <td>Introduction to Data Science - Tutorial</td>
            <td></td>
            <td>Introduction to Data Science - Online lecture</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>10:30 - 12:30</td>
            <td></td>
            <td>Technology Inquiry Project - Online Lecture</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>12:30 - 14:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>14:30 - 16:30</td>
            <td>Technology Inquiry Project - Tutorial</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>16:30 - 18:30</td>
            <td>Creating Web Application - Online lecture</td>
            <td></td>
            <td>Creating Web Application - Tutorial</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>18:30 - 20:30</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>
    </div>

    <!--mailtolink-->
    <p id="tomail"> My student email: <a href="mailto:105149160@student.swin.edu.au">105149160@student.swin.edu.au</a></p>

    
    <?php include 'footer.inc'; ?>
</body>


</html>