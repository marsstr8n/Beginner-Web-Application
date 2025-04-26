<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Apply Now">
    <meta name="keywords" content="Form page, job ad, company information">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Apply Now</title>
</head>

<body id="applyPage">
    <?php include 'navbar.inc'; ?>

    <hr>
    <div id="formContainer">
    <form id="application" method="post" action="processEOI.php" novalidate="novalidate">
        <fieldset>
            <label for="ref_number">Job reference number</label>
            <input type="text" name="refnumber" id="ref_number" required="required" pattern="^[a-zA-Z0-9]{5}$" title="Please enter exactly 5 alphanumeric characters">

            <label for="firstname">First name</label>
            <input type="text" name="firstname" id="firstname" required="required" pattern="^[A-Za-z]{1,20}$" placeholder="John" title="Maximum 20 alphabetic characters">
            <span id="errorFirstName"></span>
            <label for="lastname" >Last name</label>
            <input type="text" name="lastname" id="lastname" required="required" pattern="^[A-Za-z]{1,20}$" placeholder="Smith" title="Maximum 20 alphabetic characters">
            <span id="errorLastName"></span>


            <label for="dob">Date of birth</label>
            <input type="text" name="dob" id="dob" required="required" pattern="^\d{2}/\d{2}/\d{4}$" placeholder="dd/mm/yyyy" title="Enter date of birth in the form of dd/mm/yyyy">
            <br>
            <span id="dobError"></span>

            <fieldset id="f2">
                <legend>Gender</legend>
                <label><input type="radio" name="gender" value="Male" checked="checked">Male</label> 
                <label><input type="radio" name="gender" value="Female">Female</label>
                <label><input type="radio" name="gender" value="Unidentified">Unidentified</label>
            </fieldset>

            <label for="address">Street Address</label>
            <input type="text" name="address" id="address" required="required" maxlength="40" title="Maximum 40 characters">
            <span id="errorAddress"></span>

            <label for="suburb">Suburb</label>
            <input type="text" name="suburb" id="suburb" required="required" maxlength="40" title="Maximum 40 characters">
            <span id="errorSuburb"></span>

            <label for="state">State</label>
            <select name="state" id="state" required="required">
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
            </select>

            <label for="postcode" >Postcode</label>
            <input type="text" name="postcode" id="postcode" pattern="^[0-9]{4}$" required="required" title="Please enter exactly 4 digits">
            <br>
            <span id="errorPostcode"></span>
            <label>Email
                <input type="email" name="email" id="email"
                placeholder="name@domain.com"
                required="required">
            </label>
            <span id="errorEmail"></span>

            <label for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" pattern="^[0-9 ]{8,12}$" required="required" title="{Please enter 8 to 12 digits, or spaces}">
            <span id="errorPhone"></span>
            
            <p>Skill list
                <br>
                <label><input type="checkbox" name="skill1" value="a" checked="checked">Coding</label>
                <label><input type="checkbox" name="skill2" value="b">Social skill</label>
                <label><input type="checkbox" name="skill3" value="c">Presentation skill</label>
                
                
    
                <label><input type="checkbox" id="otherSkill" name="skill4" value="d">Other skills <br>
                <textarea id="textAreaOtherSkill" name="otherskills" rows="6" cols="50" placeholder="List other skills"></textarea>
                <span id="errorOtherSkill"></span>
                </label>
            </p>
            
            

        </fieldset>
        <p>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </p>


    </form>
    </div>
    <div id="notifyTime" class="timer">You have <span id="countdown"></span> left to fill the form</div>

    <?php include 'footer.inc'; ?>
</body>
<script src="scripts/enhancements.js"></script>
<script src="scripts/apply.js"></script>

<!--https://mercury.swin.edu.au/it000000/formtest.php-->
</html>

