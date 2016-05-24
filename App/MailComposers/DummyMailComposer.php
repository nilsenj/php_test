<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/24/2016
 * Time: 8:04 PM
 */

namespace App\MailComposers;


use Core\Mail\MailComposerAbstract;
use Core\Mail\MailComposerContract;

class DummyMailComposer extends MailComposerAbstract implements MailComposerContract
{
    /** 
     * make the email campaign
     * @param null $voucher
     */
    public function make($voucher = null) {
        // perform the logic

        /*
         * inherited available method
         * $result = $this->sendMail($to, $subject, $from, $view = 'template.php', $data = array());
         */
    }
}