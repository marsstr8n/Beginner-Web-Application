<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Manager View">
    <meta name="keywords" content="Form page, manager, company information">
    <meta name="author" content="Marcus">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Manager's View</title>

    
</head>
<body>
    <?php include 'navbar.inc'; ?>

    <h1> Manager's View</h1>
    <form method="post" action="manage.php">
        <h2>List all EOIs</h2>
        <input type="submit" name="list_all" value="List all EOIs">
    </form>
    <hr>

    <form method="post" action="manage.php">
        <h2>List EOIs by Job Reference Number</h2>
        <label for="refnumber">Job Reference Number</label>
        <input type="text" id="refnumber" name="refnumber">
        <button type="submit" name="list_by_refnumber">List EOIs</button> 
    </form>
    <hr>
   
    <form method="post" action="manage.php">
        <h2>List EOIs by Name</h2>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname">
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname">
        <button type="submit" name="list_by_name">List EOIs</button>
    </form>
<hr>

    <form method="post" action="manage.php">
        <h2>Delete EOIs by Job Reference Number</h2>
        <label for="refnumber">Job Reference Number:</label>
        <input type="text" id="refnumber" name="refnumber" required>
        <button type="submit" name="delete_by_refnumber">Delete EOIs</button>
    </form>
    <hr>

    <form method="post" action="manage.php">
    <h2>Change Status of an EOI</h2>
    <label for="id">EOI ID:</label>
    <input type="text" id="id" name="id" required>
    <label for="status">New Status:</label>
    <select id="status" name="status" required>
        <option value="New">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
    </select>
    <button type="submit" name="change_status">Change Status</button>
</form>

</body>

</html>


<?php 
require_once "settings.php";
require_once "secondenhance.php";

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sanitise inputs - good practice
function sanitise_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// function to display all EOIs
function displayEOIs($result) {
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Job Reference Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Street Address</th>
            <th>Suburb</th>
            <th>State</th>
            <th>Postcode</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Coding Skill</th>
            <th>Social Skill</th>
            <th>Presentation Skill</th>
            <th>Other Skills</th>
            <th>Other Skills Description</th>
            <th>Status</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["ref_number"] . "</td>
            <td>" . $row["firstname"] . "</td>
            <td>" . $row["lastname"] . "</td>
            <td>" . $row["dob"] . "</td>
            <td>" . $row["gender"] . "</td>
            <td>" . $row["street_address"] . "</td>
            <td>" . $row["suburb"] . "</td>
            <td>" . $row["state"] . "</td>
            <td>" . $row["postcode"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["phone_number"] . "</td>
            <td>" . $row["skill1"] . "</td>
            <td>" . $row["skill2"] . "</td>
            <td>" . $row["skill3"] . "</td>
            <td>" . $row["other_skills"] . "</td>
            <td>" . $row["other_skills_text"] . "</td>
            <td>" . $row["status"] . "</td>
        </tr>";
    } echo "</table>";

}

// Process the form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['list_all'])) {
        $query = "SELECT * FROM EOI";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            displayEOIs($result);
        } else {
            echo "No EOIs found.";
        }
    } elseif (isset($_POST['list_by_refnumber'])) { // for a particular position
        $ref_number = sanitise_input($_POST['refnumber']);
        $query = "SELECT * FROM EOI WHERE ref_number = '$ref_number'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            displayEOIs($result);
        } else {
            echo "<p>No EOIs found based on this position.<p>";
        }
    } elseif (isset($_POST['list_by_name'])) { // list all EOIs for a particular application, given their first name, last name, or both
        $firstname = sanitise_input($_POST["firstname"]);
        $lastname = sanitise_input($_POST["lastname"]);

        if (!empty($firstname) && !empty($lastname)) {
            // both first name and last name are provided
            $query = "SELECT * FROM EOI WHERE firstname = '$firstname' AND lastname = '$lastname'";
        } elseif (!empty($firstname)) {
            // only first name is provided
            $query = "SELECT * FROM EOI WHERE firstname = '$firstname'";
        } elseif (!empty($lastname)) {
            // only last name is provided
            $query = "SELECT * FROM EOI WHERE lastname = '$lastname'";
        } else {
            // neither first name nor last name is provided
            echo "<p>Please provide a first name or a last name.<p>";
            exit;
        }

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            displayEOIs($result);
        } else {
            echo "<p>No EOIs found based on this name.<p>";
        }
    } elseif (isset($_POST['delete_by_refnumber'])) { // delete EOIs based on Job Ref Number
        $ref_number = sanitise_input($_POST['refnumber']);
        $query = "DELETE FROM EOI WHERE ref_number = '$ref_number'";
        if ($conn->query($query) === TRUE) {
            echo "<p>EOIs with Job Reference Number $ref_number deleted successfully.<p>";
        } else {
            echo "<p>Error deleting EOIs: " . $conn->error . "<p>";
        } 
    } elseif (isset($_POST['change_status'])) { // change status of an EOI
        $id = sanitise_input($_POST['id']);

        // modify query to incorporate email and firstname
        $query = "SELECT firstname, email FROM EOI WHERE id = '$id'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // get first name and email here
            $row = $result->fetch_assoc();
            $email = $row['email'];
            $firstname = $row['firstname'];

            // update the status, from this point on, the code is the same as the original
            $new_status = sanitise_input($_POST['status']);
            $query = "UPDATE EOI SET status = '$new_status' WHERE id = '$id'";
            if ($conn->query($query) === TRUE) {
                echo "<p>Status of EOI with ID $id changed to $new_status.<p>";


                // send status update email - enhancement.
                sendStatusUpdate($email, $firstname, $new_status);
            } else {
                echo "<p>Error changing status: " . $conn->error . "<p>";
            }
        }
    }
    

}
$conn->close();


?>
