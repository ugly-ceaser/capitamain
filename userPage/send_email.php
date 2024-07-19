<?php
$name = $_POST['name'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$to = 'support@capitalworldpro.com';
$subject = 'New Contact Form Submission: ' . $subject;
$headers = "From: $name\r\n";
$headers .= "Reply-To: $name\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
  header("location:./index.php?msg=Email sent successfully!");
} else {
  header("location:./index.php?msg=Error sending email. Please try again later.");
}
?>
