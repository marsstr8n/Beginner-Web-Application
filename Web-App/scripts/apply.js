 /*
 * Author: Marcus Tran - 105149160
 * Target: apply.html
 * Purpose: validate the info of user.
 * Created: 21/04/2024
 * Last updated: 21/04/2024
 * Credits: N/A
 */

"use strict";
console.log("apply.js is working");

function validateDob(dobValue) {
    console.log("validateDob is working");
    var dobError = document.getElementById("dobError"); // Get the error message element

    // Create a pattern to ensure the dob matches dd/mm/yyyy
    var dateRegex = /^\d{2}\/\d{2}\/\d{4}$/;

    if (dateRegex.test(dobValue)) {
        var dobData = dobValue.split("/"); // Split the dob into day, month, and year
        var day = parseInt(dobData[0], 10); // Convert the day into an integer
        var month = parseInt(dobData[1], 10) - 1; // Convert the month into an integer
        var year = parseInt(dobData[2], 10); // Convert the year into an integer

        // Check if the input date is a valid date
        var isValidDate = !isNaN(year) && !isNaN(month) && !isNaN(day) && month >= 0 && month < 12 && day > 0 && day <= new Date(year, month + 1, 0).getDate();

        if (isValidDate) {
            // Check if it's a leap year
            var isLeapYear = (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;

            // Validate February for leap years
            if (month === 1 && isLeapYear) {
                isValidDate = day <= 29;
            }

            if (isValidDate) {
                // Create a Date object
                var dobDate = new Date(year, month, day);
                var currentDate = new Date(); // Get the current date

                // Calculate user's age
                var age = currentDate.getFullYear() - dobDate.getFullYear();
                var monthDiff = currentDate.getMonth() - dobDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < dobDate.getDate())) {
                    age--; // if the birthday hasn't occurred yet this year, adjust age
                }

                // Perform a check to see if the user is between 15 and 80 years old
                if (age >= 15 && age <= 80) {
                    dobError.textContent = ""; // Clear the error message
                    return true;
                } else {
                    dobError.textContent = "You must be between 15 and 80 years old to apply"; // Display the age error message
                    return false;
                }
            }
        }
        dobError.textContent = "Please enter a valid date of birth"; // Display the error message for an invalid date
    } else {
        dobError.textContent = "Please enter a valid date of birth in the format dd/mm/yyyy"; // Display the error message for wrong input format
    }
    return false;
}

function validatePostcode() {
    console.log("validatePostcode is working");
    // retrieve the values from the form, mainly: state, postcode, errorPostcode span
    const state = document.getElementById("state").value;
    const postcode = document.getElementById("postcode").value;
    const errorPostcode = document.getElementById("errorPostcode");
    const firstDigit = postcode.charAt(0); // get the first digit of the postcode;

    var postCodeRegex = /^[0-9]{4}$/; // create a regex pattern to check if the postcode is a 4-digit number
    if (!postCodeRegex.test(postcode)) {
        errorPostcode.textContent = "Please enter a valid 4-digit postcode"; // display the error message if the postcode is not a 4-digit number
        return false;
    }


    switch (state) {
        case "vic":
            if (["3", "8"].includes(firstDigit)) { // check if the user selecting VIC has the first digit in postcode starting with 3 or 8
                errorPostcode.textContent = "";
                return true;
            }
            break;
        
        case "nsw":
            if (["1", "2"].includes(firstDigit)) { // check if the user selecting NSW has the first digit in postcode starting with 1 or 2
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "qld":
            if (["4", "9"].includes(firstDigit)) { // check if the user selecting QLD has the first digit in postcode starting with 4 or 9
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "nt":
            if (firstDigit === "0") { // check if the user selecting NT has the first digit in postcode starting with 0
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "wa":
            if (firstDigit === "6") { // check if the user selecting WA has the first digit in postcode starting with 6
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "sa":
            if (firstDigit === "5") { // check if the user selecting SA has the first digit in postcode starting with 5
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "tas":
            if (firstDigit === "7") { // check if the user selecting TAS has the first digit in postcode starting with 7
                errorPostcode.textContent = "";
                return true;
            }
            break;

        case "act":
            if (firstDigit === "0") { // check if the user selecting ACT has the first digit in postcode starting with 0
                errorPostcode.textContent = "";
                return true;
            }
            break;
    }
    errorPostcode.textContent = "The postcode does not match the selected state"; // if none matches, errorPostcode message shown

    return false;

}

/* Other skill functions textarea validation */
function reloadApplyPage() {
    console.log("reloadApplyPage is working");
    window.addEventListener('beforeunload', function() {
        // Get all checkboxes on the page
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      
        // Uncheck all checkboxes
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
      });
}

function checkOtherSkill() {
    var skills = document.getElementById("otherSkill"); // get the other skill checkbox
    var  textAreaOtherSkill = document.getElementById("textAreaOtherSkill"); // get the other skill textarea
    var errorOtherSkill = document.getElementById("errorOtherSkill"); // get the error message for other skill
    skills.addEventListener('change',function() { // add an event listener to the checkbox of 'other skills'
        if (skills.checked) {
            console.log("Textarea is visible");
            textAreaOtherSkill.style.display = "block"; // display the textarea if the checkbox is checked
    }
        else {
            textAreaOtherSkill.style.display= "none";
        }
    });    
}
/* this function ensures textarea is filled if the other skill checkbox is ticked */
function CheckValidOtherSkill() {
    var skills = document.getElementById("otherSkill");
    var  textAreaOtherSkill = document.getElementById("textAreaOtherSkill");
    if (skills.checked && textAreaOtherSkill.value.trim() === '') {
        // add error message here
        errorOtherSkill.textContent = "Please enter your other skills in the text area provided";
        return false; // Prevent form submission
    }
    return true; // Proceed with form submission
}





//Data transfer using Local client-side storage 
// function that deals with "Apply Now" click event in jobs.html
function applyNowClick(event) {
    event.preventDefault(); // stop form submitting, so we can store the data in local storage
    var jobReference = event.target.getAttribute("job-ref"); // retrieve the the value (getAttribute) "job-ref" from the hyperlink <a>. event.target refers to clicking <a>
    localStorage.setItem("jobReference", jobReference); // store the job reference in local storage of the browser
    window.location.href = "apply.html"; // redirect to apply.html, after storing the job reference 

}

function validJobReference() {
    var jobReference = localStorage.getItem('jobReference');
    
    document.getElementById('ref_number').value = jobReference;
    document.getElementById('ref_number').readOnly = true;
}
// register the event listener for applyNowClick function 
var applyLink = document.querySelectorAll('.applyLink') // select all elements class = "applyLink"
applyLink.forEach(function(link) {
    link.addEventListener('click', applyNowClick); // attach event listener to each of them, when clicked, function applyNowClick above is executed.
})


function checkRequiredField() { // ensure for elements are filled before able to submit
    console.log("checkRequiredField is working");
    var form = document.forms[0];
    var isFirstNameEmpty = form.firstname.value.trim() === "";
    var isLastNameEmpty = form.lastname.value.trim() === "";
    var isAddressEmpty = form.address.value.trim() === "";
    var isSuburbEmpty = form.suburb.value.trim() === "";
    var isEmailEmpty = form.email.value.trim() === "";
    var isPhoneEmpty = form.phone.value.trim() === "";

    if (isFirstNameEmpty) {
        document.getElementById('errorFirstName').textContent = "First name is required";
    }
    if (isLastNameEmpty) {
        document.getElementById('errorLastName').textContent = "Last name is required";
    }
    if (isAddressEmpty) {
        document.getElementById('errorAddress').textContent = "Address is required";
    }
    if (isSuburbEmpty) {
        document.getElementById('errorSuburb').textContent = "Suburb is required";
    }
    if (isEmailEmpty) {
        document.getElementById('errorEmail').textContent = "Email is required";
    }
    if (isPhoneEmpty) {
        document.getElementById('errorPhone').textContent = "Phone is required";
    }
    return !isFirstNameEmpty && !isLastNameEmpty && !isAddressEmpty && !isSuburbEmpty && !isEmailEmpty && !isPhoneEmpty;
}





// NEXT TASK
// session storage for form data. 

function seshPrefill() {
    console.log("seshPrefill is working");
    // check whether there is any saved data in session storage, if there are, prefill the form
    if (sessionStorage.getItem('firstname') !== null) {
        var form = document.forms[0];
        form.firstname.value = sessionStorage.getItem('firstname');
        form.lastname.value = sessionStorage.getItem('lastname');
        form.dob.value = sessionStorage.getItem('dob'); 
        form.gender.value = sessionStorage.getItem('gender');
        form.address.value = sessionStorage.getItem('address');
        form.suburb.value = sessionStorage.getItem('suburb');
        form.state.value = sessionStorage.getItem('state');
        form.postcode.value = sessionStorage.getItem('postcode');   
        form.email.value = sessionStorage.getItem('email'); 
        form.phone.value = sessionStorage.getItem('phone');

        const skills = sessionStorage.getItem('skill').split(',');
        skills.forEach(skill => {
            if (skill === 'a' || skill === 'b' || skill === 'c') {
                document.querySelector(`input[name="skill"][value="${skill}"]`).checked = true;
            } else if (skill === 'd') {
                document.getElementById('otherSkill').checked = true;
                document.getElementById('textAreaOtherSkill').style.display = 'block';
                document.getElementById('textAreaOtherSkill').value = sessionStorage.getItem('otherskills');
            }
        });

    }
    
    // event listener
    document.getElementById('application').addEventListener('submit', function(event) {
        event.preventDefault(); // stop form from submitting to store data into session storage first

        // get form data
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        const dob = document.getElementById('dob').value;
        const gender = document.querySelector('input[name="gender"]:checked').value;
        const address = document.getElementById('address').value;
        const suburb = document.getElementById('suburb').value;
        const state = document.getElementById('state').value;
        const postcode = document.getElementById('postcode').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const skills = Array.from(document.querySelectorAll('input[name="skill"]:checked')).map(skill => skill.value);


        
        if (skills.includes('d')) {
            let otherskills = document.getElementById('textAreaOtherSkill').value;
            sessionStorage.setItem('otherskills', otherskills);
        };
    

        // store data in session storage
        sessionStorage.setItem('firstname', firstname);
        sessionStorage.setItem('lastname', lastname);
        sessionStorage.setItem('dob', dob);
        sessionStorage.setItem('gender', gender);
        sessionStorage.setItem('address', address);
        sessionStorage.setItem('suburb', suburb);
        sessionStorage.setItem('state', state); 
        sessionStorage.setItem('postcode', postcode);
        sessionStorage.setItem('email', email);
        sessionStorage.setItem('phone', phone);
        sessionStorage.setItem('skill', skills.join(',')); // join the array of skills into a string
        sessionStorage.setItem('textAreaOtherSkill', textAreaOtherSkill);


        // call the validate functions
        var isPostcodeValid = validatePostcode();
        var isDobValid = validateDob(dob);
        var isOtherSkillValid = CheckValidOtherSkill();
        var isRequiredFieldValid = checkRequiredField();
        // submit form
        if (isPostcodeValid && isDobValid && isOtherSkillValid && isRequiredFieldValid) {
           this.submit(); 
        } else {
            event.preventDefault();
        }
         
}) 
}





function init() {


    var isInApplyPage = document.body.id === 'applyPage'
    var isInJobsPage = document.body.id === 'jobsPage'
    darkMode();
    
    // we can add functions in here to call when the page loads
    if (isInApplyPage) {
        reloadApplyPage(); // this function clears the checkboxes in the form
        validJobReference();
        checkOtherSkill();
        seshPrefill() 
        
        
        var form = document.getElementById("application"); // this gets the form id="application" in the html file
        // form.addEventListener("submit", checkSubmit); // register the event listener

    
    }
}



window.onload = init;



