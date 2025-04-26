
<?php
require_once "settings.php";
require_once "secondenhance.php";

// Create the EOI table if it doesn't exist
$createEoiTableSql = "CREATE TABLE IF NOT EXISTS EOI (
  id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ref_number VARCHAR(5) NOT NULL,
  firstname VARCHAR(20) NOT NULL,
  lastname VARCHAR(20) NOT NULL,
  dob DATE NOT NULL,
  gender ENUM('Male', 'Female', 'Unidentified') NOT NULL,
  street_address VARCHAR(40) NOT NULL,
  suburb VARCHAR(40) NOT NULL,
  state ENUM('VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT') NOT NULL,
  postcode VARCHAR(4) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phone_number VARCHAR(12) NOT NULL,
  skill1 ENUM('Yes', 'No') DEFAULT 'No',
  skill2 ENUM('Yes', 'No') DEFAULT 'No',
  skill3 ENUM('Yes', 'No') DEFAULT 'No',
  other_skills ENUM('Yes', 'No') DEFAULT 'No',
  other_skills_text TEXT,
  status ENUM('New', 'Current', 'Final') DEFAULT 'New'
);";

if ($conn) {
    if (!mysqli_query($conn, $createEoiTableSql)) {
        echo "<p>Failed to create table: " . mysqli_error($conn) . "</p>";
        exit;
    }
} else {
    echo "<p>Database connection failure</p>";
    exit;
}

// Function to sanitize inputs
function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values
    $ref_number = sanitise_input($_POST["refnumber"]);
    $firstname = sanitise_input($_POST["firstname"]);
    $lastname = sanitise_input($_POST["lastname"]);
    $dob = sanitise_input($_POST["dob"]);
    $gender = sanitise_input($_POST["gender"]);
    $address = sanitise_input($_POST["address"]);
    $suburb = sanitise_input($_POST["suburb"]);
    $state = sanitise_input($_POST["state"]);
    $postcode = sanitise_input($_POST["postcode"]);
    $email = sanitise_input($_POST["email"]);
    $phone = sanitise_input($_POST["phone"]);

    $skill1 = isset($_POST['skill1']) ? 'Yes' : 'No';
    $skill2 = isset($_POST['skill2']) ? 'Yes' : 'No';
    $skill3 = isset($_POST['skill3']) ? 'Yes' : 'No';
    $other_skills = isset($_POST['skill4']) ? 'Yes' : 'No';
    $other_skills_text = sanitise_input($_POST['otherskills']);

    // ensure every field is filled, give separate message for Other skills checked but text area empty
    if (
        empty($ref_number) || empty($firstname) || empty($lastname) || empty($dob) || empty($gender)
        || empty($address) || empty($suburb) || empty($state) || empty($postcode) || empty($email)
        || empty($phone) || (isset($_POST['skill4']) && empty($other_skills_text))
    ) {
      if (empty($ref_number) || empty($firstname) || empty($lastname) || empty($dob) || empty($gender)
        || empty($address) || empty($suburb) || empty($state) || empty($postcode) || empty($email)
        || empty($phone)) {
        exit('All fields are required.');
    } else {
      exit('The "Other skills" text must be filled if the "Other skills" checkbox is checked.');
    }
    }

    // check ref_number contains exactly 5 alphanumeric chars
    if (!preg_match('/^[a-zA-Z0-9]{5}$/', $ref_number)) {
      echo "<p>Job Reference Number must have exactly 5 alphanumeric characters. <p>";
      exit;
    }

    // check firstname, max 20 alpha chars
    if (!preg_match('/^[a-zA-Z]{1,20}$/', $firstname)) {
      echo "<p>First name must be between 1 and 20 alphabetic characters.</p>";
      exit;
    }

    // check lastname, max 20 alpha chars
    if (!preg_match('/^[a-zA-Z]{1,20}$/', $lastname)) {
      echo "<p>Last name must be between 1 and 20 alphabetic characters.</p>";
      exit;
    }

    // check dob format
    validateDob($dob);

    // ensure gender is selected
    $allowed_gender = array('Male', 'Female', 'Unidentified');
    if (!in_array($gender, $allowed_gender)) {
      echo "<p>Please select correctly one of the options</p>";
      exit;
    }

    // check address, max 40 chars
    if (strlen($address) > 40) {
      echo "<p>Address must be less than 40 characters.</p>";
      exit;
    }

    // check suburb, max 40 chars
    if (strlen($suburb) > 40) {
      echo "<p>Suburb must be less than 40 characters.</p>";
      exit;
    }

    // check state, ensure that it is one of the select options
    $allowed_states = ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"];
    if (!in_array($state, $allowed_states)) {
      echo "<p>Please select a valid state.</p>";
      exit;
    }

    // ensure postcode is exactly 4 digits
    if (!preg_match('/^[0-9]{4}$/', $postcode)) {
      echo "<p>Postcode must be exactly 4 digits.</p>";
      exit;
    }
    // check if the first digit of the postcode matches its state
    postcodeMatchState($postcode, $state);

    // validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<p>Email must be in the correct format.</p>";
      exit;
    }

    // validate phone number format
    if (!preg_match('/^[0-9 ]{8,12}$/', $phone)) {
      echo "<p>Phone number must be between 8 and 12 digits or spaces.</p>";
      exit;
    }

    // Convert date format to YYYY-MM-DD
    $dob = DateTime::createFromFormat('d/m/Y', $_POST["dob"]);
    $dob_formatted = $dob ? $dob->format('Y-m-d') : '';
    

    // Insert into database
    $query = "INSERT INTO EOI (ref_number, firstname, lastname, dob, gender, street_address, suburb, state, postcode, email, phone_number, skill1, skill2, skill3, other_skills, other_skills_text, status) 
                        VALUES ('$ref_number', '$firstname', '$lastname', '$dob_formatted', '$gender', '$address', '$suburb', '$state', '$postcode', '$email', '$phone', '$skill1', '$skill2', '$skill3', '$other_skills', '$other_skills_text', 'New')";

    // Execute query
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "<p>Something is wrong with the query: " . mysqli_error($conn) . "</p>";
    } else {
        // Get the auto-generated EOI number
        $EOInumber = mysqli_insert_id($conn);
        echo "<p>Thank you for your EOI. Your application has been submitted. Your EOI number is $EOInumber.</p>";

        // send confirmation email
        sendConfirmationEmail($email, $EOInumber, $firstname);
       
    }
}

function validateDob($dateString)
{
    // check if the date string matches the expected format
    if (!preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/((19|20)\d{2})$/', $dateString)) {
        die('Invalid date of birth format. Please use the format dd/mm/yyyy.');
    }
    
    // get day, month, and year from the date string
    list($day, $month, $year) = explode('/', $dateString);
    
    // ensure if the date is valid
    if (!checkdate($month, $day, $year)) {
        die('Invalid date of birth.');
    }

    // calc age
    $dob = strtotime("$year-$month-$day");
    $age = date('Y') - date('Y', $dob);
    
    // Check if age is within the desired range
    if ($age < 15 || $age > 80) {
        die('Date of birth must be between 15 and 80 years old.');
    }
}

function postcodeMatchState($postcode, $state) {
  // Define the valid starting digits for each state
  $state_postcode_conn = [
      "VIC" => ['3', '8'],
      "NSW" => ['1', '2'],
      "QLD" => ['4', '9'],
      "NT" => ['0'],
      "WA" => ['6'],
      "SA" => ['5'],
      "TAS" => ['7'],
      "ACT" => ['0']
  ];

  // Extract the first digit of the postcode
  $first_digit = substr($postcode, 0, 1);

  // Check if the first digit matches the allowed digits for the state
  if (!in_array($first_digit, $state_postcode_conn[$state])) {
      die('Invalid postcode for the selected state.');
  }
}




$conn->close();





    
    


?>


</body>
</html>
