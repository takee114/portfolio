<?php

// Define the email address where the contact form messages should be sent
$receiving_email_address = 'tekaligngetachew114@gmail.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Initialize the PHP_Email_Form class
$contact = new PHP_Email_Form;
$contact->ajax = true;  // Enable AJAX to avoid page reload

// Set the recipient email address
$contact->to = $receiving_email_address;

// Set the form details using POST data
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment and configure the SMTP settings if you wish to send emails via SMTP
/*
$contact->smtp = array(
  'host' => 'smtp.example.com',
  'username' => 'your_username',
  'password' => 'your_password',
  'port' => '587'
);
*/

// Add the messages from the form fields to be included in the email
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send the email and output the result (success or error)
echo $contact->send();

?>