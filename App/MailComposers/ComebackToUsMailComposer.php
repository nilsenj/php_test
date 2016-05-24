<?php

namespace App\MailComposers;

use App\DataLayer\DataLayer;
use Core\Mail\MailComposerAbstract;
use Core\Mail\MailComposerContract;

/**
 * Class ComebackToUsMailComposer
 * @package App\MailComposers
 */
class ComebackToUsMailComposer extends MailComposerAbstract implements MailComposerContract
{
    /**
     * make the email campaign
     * @param null $voucher
     * @return array
     * @throws \Exception
     */
    public function make($voucher = null)
    {
        $errorList = [];
        //List all customers
        $customers = DataLayer::ListCustomers();
        //List all orders
        $orders = DataLayer::ListOrders();
        //loop through list of customers
        foreach ($customers as $customer) {
            // We send mail if customer hasn't put an order
            $send = true;
            //loop through list of orders to see if customer don't exist in that list
            foreach ($orders as $order) {
                // Email exists in order list
                if ($customer->email == $order->customerEmail) {
                    //We don't send email to that customer
                    $send = false;
                }
            }
            //Send if customer hasn't put order
            if ($send == true) {
                //Add customer to receiver list
                $to = $customer->email;
                //Add subject
                $subject = "We miss you as a customer";
                //Send mail from info@cdon.com
                $from = "infor@forbytes.com";
                //send mail if debug in config/mail.php set to true we do not send email
                try {
                    //if we throw an error or Exception in the loop the loop will be finished but we don't really want that
                    $this->sendMail($to, $subject, $from, $view = 'ComebackToUsMailTemplate.php', $data = array('email' => $customer->email, 'voucher' => $voucher));

                } catch (\Exception $e) {
                    // best option would be just log every failed email but not now
                    array_push($errorList, ['email' => $to, 'error' => $e->getMessage(), 'message' => 'Cannot send email', 'code' => $e->getCode()]);
                    continue;
                }
            }
        }
        //All mails are sent! Success!
        return ['finished' => true, 'errors' => $errorList];
    }
}