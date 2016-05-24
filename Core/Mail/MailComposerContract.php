<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/24/2016
 * Time: 3:56 PM
 */

namespace Core\Mail;


interface MailComposerContract
{
    public function make($voucher);
}