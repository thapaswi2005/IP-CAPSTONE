<?php
// Configuration
$smtp_host = 'your_smtp_host';
$smtp_username = 'your_smtp_username';
$smtp_password = 'your_smtp_password';
$from_email = 'your_from_email';
$to_email = 'user_email';

// Get the total price from the JavaScript code
$total_price = $_POST['total_price'];

// Get the user's email from the login system (you need to implement this)
$user_email = $_SESSION['user_email'];

// Send a confirmation email
$subject = 'Order Confirmation - Fresh Home Grocery';
$message = '
<html>
  <body>
    <h2>Order Confirmation</h2>
    <p>Dear ' . $user_email . ',</p>
    <p>Your order has been successfully processed. The total amount is $' . $total_price . '.</p>
    <p>Thank you for shopping with us!</p>
  </body>
</html>
';

$headers = array(
    'From' => $from_email,
    'Reply-To' => $from_email,
    'MIME-Version' => '1.0',
    'Content-Type' => 'text/html; charset=UTF-8'
);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->From = $from_email;
$mail->FromName = 'Fresh Home Grocery';
$mail->AddAddress($to_email, $user_email);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->IsHTML(true);

if (!$mail->Send()) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
} else {
    echo 'Order confirmed! You will receive a confirmation email shortly.';
}

?>