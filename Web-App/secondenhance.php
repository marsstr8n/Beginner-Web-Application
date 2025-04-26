<?php
require_once "settings.php";

// second technique: Email response

//send a confirmation email to applicant, once they submit the form
function sendConfirmationEmail($email, $EOInumber, $firstname) {
    $subject = "Application Submission Confirmation";
    $message = "Dear $firstname,\n\nThank you for submitting your application. Your EOI number is $EOInumber.\n\nBest regards,\nPXZ Institute";
    $headers = "From: pxzinc@company.com\r\n";
  
    if (mail($email, $subject, $message, $headers)) {
        echo "<p>Confirmation email sent to $email</p>";
    } else {
        echo "<p>Failed to send confirmation email to $email</p>";
    }
  }

// send an email to applicant, once the status of their form is changed
function sendStatusUpdate($email, $firstname, $status) {
    $subject = "Application Status Update";
    $message = "Dear $firstname,\n\nYour application status has been updated to: $status.\n\nBest regards,\nPXZ Institute";
    $headers = "From: pxzinc@company.com\r\n";

    if (mail($email, $subject, $message, $headers)) {
        echo "<p>Status update email sent to $email</p>";
    } else {
        echo "<p>Failed to send status update email to $email</p>";
    }
}
  
?>