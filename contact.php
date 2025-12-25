<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "lteodore@techbyteo.com";
    $subject = "New Luxury Real Estate Inquiry";
    
    // YOUR SECRET KEY (Find this in your hCaptcha Dashboard Settings)
    $secret = "ES_0b74ee44eed743cd97800fd795a8d374 ";
    $response = $_POST['h-captcha-response'];

    // Verify the Captcha with hCaptcha Servers
    $verify = file_get_contents("https://hcaptcha.com/siteverify?secret=$secret&response=$response");
    $responseData = json_decode($verify);

    if ($responseData->success) {
        // Captcha Passed - Process the Email
        $name    = strip_tags($_POST['name']);
        $email   = strip_tags($_POST['email']);
        $phone   = strip_tags($_POST['phone']);
        $message = strip_tags($_POST['message']);

        $body = "Lead Details:\n\n";
        $body .= "Name: $name\n";
        $body .= "Email: " . ($email ? $email : "Not provided") . "\n";
        $body .= "Phone: " . ($phone ? $phone : "Not provided") . "\n\n";
        $body .= "Message:\n$message";

        $headers = "From: webmaster@jennyfilkins.com\r\n";
        $headers .= "Reply-To: " . ($email ? $email : "no-reply@jennyfilkins.com") . "\r\n";

        if(mail($to, $subject, $body, $headers)) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    } else {
        // Captcha Failed
        http_response_code(401);
        echo "Captcha verification failed.";
    }
}
?>