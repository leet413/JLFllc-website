<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "jenny@jennyfilkins.com"; // Your email address
    $subject = "New Luxury Real Estate Inquiry";
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    $body = "New Lead Details:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";
    $body .= "Message:\n$message";
    
    $headers = "From: webmaster@jennyfilkins.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    mail($to, $subject, $body, $headers);
}
?>