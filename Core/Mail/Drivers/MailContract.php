<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/24/2016
 * Time: 12:26 AM
 */

namespace Core\Mail\Drivers;


interface MailContract
{
    public function compose($toEmail, $subject, $from, $view, $data, $options);

}