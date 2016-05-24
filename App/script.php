<?php

namespace App;

use Core\Mail\MailResolver;

$debug = false;

//Call the method that do the work for me, I.E. sending the mails
echo "Send Welcomemail\r\n";
$mail = new MailResolver();
$success = $mail->doMail('Welcomemail');

if ($debug) {
    //Debug mode, always send Comeback mail
    echo("Send Comebackmail\r\n");
    $success = DoEmailWork2($debug, "ComebackToUs");
} else {
    //Every Sunday run Comeback mail
    if (date('D', time()) === 'Mon') {
        echo("Send Comebackmail\r\n");
        $success = DoEmailWork2($debug, "ComebackToUs");
    }
}

//Check if the sending went OK
if ($success == true) {
    echo("All mails are sent, I hope...\r\n");
}
//Check if the sending was not going well...
if ($success == false) {
    echo("Oops, something went wrong when sending mail (I think...)\r\n");
}
echo "done\r\n";