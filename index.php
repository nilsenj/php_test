<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/23/2016
 * Time: 11:37 PM
 */
require __DIR__.'/vendor/autoload.php';

use Core\Mail\Mailer;

//Sending the mails predefined in MailComposer Abstract
echo "Send Welcomemail\r\n" . "<br>";

$mail = new Mailer();
$feedback = $mail->doMailByType('Welcomemail', "Welcome email");

//sending dummy mail not predefined in MailComposer Abstract
echo("Send Dummy mail\r\n");
$feedback = $mail->doMail(new \App\MailComposers\DummyMailComposer(), "Voucher");

echo("Send Comebackmail\r\n" . "<br>");
$feedback = $mail->doMailByType("ComebackToUs", "ComebackToUs");


//Check if the sending went OK
if ($feedback['finished'] == true) {
    var_dump($feedback['errors']);
    echo("All mails are sent, I hope...\r\n" . "<br>");
}
//Check if the sending was not going well...
if ($feedback['finished'] == false) {
    echo("Oops, something went wrong when sending mail (I think...)\r\n" . "<br>");
}
echo "done\r\n";
