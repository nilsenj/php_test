<?php

namespace App\MailComposers;

use App\DataLayer\DataLayer;
use Core\Mail\MailComposerAbstract;
use Core\Mail\MailComposerContract;

/**
 * Class WelcomeMailComposer
 * @package App\MailComposers
 */
class WelcomeMailComposer extends MailComposerAbstract implements MailComposerContract
{
    /**
     * @param null $voucher
     * @return array
     * @throws \Exception
     */
    public function make($voucher = null)
    {
        $errorList = [];
        //List all customers
        $customers = DataLayer::ListCustomers();

        //loop through list of new customers
        for ($i = 0; $i < count($customers); $i++) {
            //If the customer is newly registered, one day back in time
            if ($customers[$i]->createdAt > (new \DateTime())->modify('-1 day')) {
                //Add customer to reciever list
                $to = $customers[$i]->email;
                //Add subject
                $subject = "Welcome as a new customer";
                //Send mail from info@cdon.com
                $from = "info@forbytes.com";
                //send mail if debug in config/mail.php set to true we do not send email
                try {
                    $this->sendMail($to, $subject, $from, $view = 'DoEmailWorkTemplate.php', $data = array('email' => $customers[$i]->email, 'voucher' => $voucher));
                } catch (\Exception $e) {
                    // best option would be just log every failed email but not now
                    array_push($errorList, ['email' => $to, 'error' => $e->getMessage(), 'message' => 'Cannot send email', 'code' => $e->getCode()]);
                    continue;
                }
            }
        }
        //All mails are sent! Success!
        return ['finished' => true,'errors' => $errorList];
    }
}